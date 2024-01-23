<?php
require(APPPATH . 'libraries/RestController.php');

require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Project_api extends RestController
{


    function __construct()
    {

        parent::__construct();

        // error_reporting(0);

        // ini_set('display_errors', 0);
        $this->load->model('Comman_model');

    }


    public function projectList_get($user_id)
    {
        // $user_session = $this->session->userdata('user_data');
        $user = $this->Comman_model->get_data_by_id('*', 'users', array('user_id' => $user_id));
        // $this->response($user, RestController::HTTP_OK);

        if(!empty($user)){
            if($user->user_type == '1'){
                $project_data = $this->Comman_model->get_data('*','project');
                $mainArray = array();
                foreach($project_data as $project)
                {
                    $structure_data = $this->Comman_model->get_data('*', 'structure', array('project_id' => $project->project_id));
                    $structureArr = array();
                    foreach($structure_data as $structure)
                    {
                        $stage_data = $this->Comman_model->get_data('*', 'stages', array('structure_id' => $structure->structure_id));
                        
                        $stagesArr = array();
                        foreach($stage_data as $stage)
                        {
                            $unit_data = $this->Comman_model->get_data('*', 'units', array('stage_id' => $stage->stage_id));
                            $unitArr = array();
                            foreach($unit_data as $unit)
                            {
                                $subunit_data = $this->Comman_model->get_data('*', 'subunit', array('unit_id' => $unit->unit_id));
                                $unit->subunit = $subunit_data;
                                $unitArr[] = $unit;
                            }
                            $stage->units = $unitArr;
                            $stagesArr[] = $stage;
                        }
                        $structure->stages = $stagesArr;
                        $structureArr[] = $structure;

                    }

                    $project->structure = $structureArr;
                    array_push($mainArray, $project);
                }
                $observationData = getObservationData();
                $res = array(
                    'success' => TRUE,
                    'message' => 'response available',
                    'result' => array(
                        'project_data' => $mainArray,
                        'observation_data' => $observationData
                    )
                );
                $this->response($res, RestController::HTTP_OK);
                

            }else{

                $join = array($this->db->join('user_project_access b','b.project_id=a.project_id'));			
                $project_data = $this->Comman_model->get_data('a.*, b.*','project a', array('b.user_id' => $user->user_id));
                $mainArray = array();
                foreach($project_data as $project)
                {
                    $structure_data = $this->Comman_model->get_data('*', 'structure', array('project_id' => $project->project_id));
                    $structureArr = array();
                    foreach($structure_data as $structure)
                    {
                        $stage_data = $this->Comman_model->get_data('*', 'stages', array('structure_id' => $structure->structure_id));
                        
                        $stagesArr = array();
                        foreach($stage_data as $stage)
                        {
                            $unit_data = $this->Comman_model->get_data('*', 'units', array('stage_id' => $stage->stage_id));
                            $unitArr = array();
                            foreach($unit_data as $unit)
                            {
                                $subunit_data = $this->Comman_model->get_data('*', 'subunit', array('unit_id' => $unit->unit_id));
                                $unit->subunit = $subunit_data;
                                $unitArr[] = $unit;
                            }
                            $stage->units = $unitArr;
                            $stagesArr[] = $stage;
                        }
                        $structure->stages = $stagesArr;
                        $structureArr[] = $structure;

                    }

                    $project->structure = $structureArr;
                    array_push($mainArray, $project);
                }
            }
            $observationData = getObservationData();
            $res = array(
                'success' => TRUE,
                'message' => 'response available',
                'result' => array(
                    'project_data' => $mainArray,
                    'observation_data' => $observationData
                )
            );
            $this->response($res, RestController::HTTP_OK);
         }else{
            $res = array(
                'success' => FALSE,
                'message' => 'Login to access this resourse OR Invalid user Id',
                'result' => []
            );
            $this->response($res, RestController::HTTP_BAD_REQUEST);

         }
    }


    public function add_project_post($postData=array())
    {
        $postData = $this->post();
        if ($postData) {
            $pramas = array(
                'project_name' => $postData['project_name'],
                'developer_id' => $postData['developer_id'],
                'project_location' => $postData['project_location'],
                'configuration' => $postData['configuration'],
                'project_type' => $postData['project_type'],
                'mr_name' => $postData['mr_name'],
                'email_id' => $postData['email_id'],
                'contact_number' => $postData['contact_number']
            );

            // echo'<pre>';print_r($pramas);exit;
            $res = $this->Comman_model->insert_data('project', $pramas);
            $this->response($res, RestController::HTTP_OK);
        }

    }

    public function edit_project($details = array())
    {

        $pramas = array(
            'developer_id' => $details['developer_id'],
            'project_name' => $details['project_name'],
            'project_location' => $details['project_location'],
            'configuration' => $details['configuration'],
            'project_type' => $details['project_type'],
            'mr_name' => $details['mr_name'],
            'email_id' => $details['email_id'],
            'contact_number' => $details['contact_number']
        );
        $res = $this->Comman_model->update_Data('project', $pramas, array('project_id' => $project_id));

        $this->response($res, RestController::HTTP_OK);

    }


    public function get_structures_by_project_id_post()
    {
        $project_id = $this->post('project_id');
        if ($project_id) {
            $all_structures = $this->Comman_model->get_data('*', 'structure', array('project_id' => $project_id));
            $this->response($all_structures, RestController::HTTP_OK);

        }
    }

    public function get_stages_by_structure_id_post()
    {
        $structure_id = $this->post('structure_id');
        if ($structure_id) {
            $structure = $this->Comman_model->get_data('*', 'stages', array('structure_id' => $structure_id));
            $this->response($structure, RestController::HTTP_OK);

        }
    }

    public function get_units_by_stage_id_post()
    {
        $stage_id = $this->post('stage_id');
        if ($stage_id) {
            $stages = $this->Comman_model->get_data('*', 'units', array('stage_id' => $stage_id));
            $this->response($stages, RestController::HTTP_OK);

        }
    }


}

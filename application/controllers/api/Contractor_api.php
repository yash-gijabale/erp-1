<?php
require(APPPATH.'libraries/RestController.php');

require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;
class Contractor_api extends RestController{


	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    }


    public function getProjectWorkerList_get($user_id)
    {
        $user = $this->Comman_model->get_data_by_id('*', 'users', array('user_id' => $user_id));
            if($user)
            {
    
                $project_data = getAllUserProjects($user->user_id);
               
                foreach($project_data as $project)
                {
                    $workerList = $this->Comman_model->get_data('*', 'workers', array('project_id' => $project->project_id));
                    $project->worker_list = $workerList;
                }
				// $this->session->set_userdata('user_data', $user);
                $res = array(
                    'success' => TRUE,
                    'message' => 'response available',
                    'result' => $project_data
                );
                $this->response($res, RestController::HTTP_OK);
            }else{
                $res = array(
                    'success' => FALSE,
                    'message' => 'Login to access this resourse OR Invalid user Id',
                    'result' => []
                );
                $this->response($res, RestController::HTTP_OK);

            }
    }

    function getProjectMaterialList_get($user_id)
    {
        $user = $this->Comman_model->get_data_by_id('*', 'users', array('user_id' => $user_id));
        if($user)
        {

            $project_data = getAllUserProjects($user->user_id);
           
            foreach($project_data as $project)
            {
                $materialList = $this->Comman_model->get_data('*', 'total_material', array('project_id' => $project->project_id));
                $project->material_list = $materialList;
            }
            // $this->session->set_userdata('user_data', $user);
            $res = array(
                'success' => TRUE,
                'message' => 'response available',
                'result' => $project_data
            );
            $this->response($res, RestController::HTTP_OK);
        }else{
            $res = array(
                'success' => FALSE,
                'message' => 'Login to access this resourse OR Invalid user Id',
                'result' => []
            );
            $this->response($res, RestController::HTTP_OK);

        }
    }


}
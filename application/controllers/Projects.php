<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        error_reporting(0);

        ini_set('display_errors', 0);
        $this->load->model('Comman_model');
    }

    public function add_projects()
    {
        $postData = $this->input->post();
        if ($postData) {
            // echo'<pre>';print_r($postData);exit;

            $pramas = array(
                'project_name' => $postData['project_name'],
                'developer_id' => $postData['developer_id'],
                'project_location' => $postData['region'],
                'gst_number' => $postData['gst_number'],
                'project_type' => $postData['project_type'],
                'mr_name' => $postData['mr_name'],
                'email_id' => $postData['email'],
                'contact_number' => $postData['contact_number'],
                'start_date' => $postData['start_date'],
                'end_date' => $postData['end_date'],
                'address' => $postData['address'],
                'status' => $postData['status']
            );

            // echo'<pre>';print_r($pramas);exit;
            $res = $this->Comman_model->insert_data('project', $pramas);
            if ($res) {
                $data['submit_status'] = TRUE;
                $data['submit_msg'] = 'Project Added successfully';
                foreach($postData['trade_id'] as $tradegroup_id)
                {
                    $pramas2 = array(
                        'project_id' => $res,
                        'tradegroup_id' => $tradegroup_id
                    );
                    $this->Comman_model->insert_data('project_tradegroup_allocation',$pramas2);
                }
            } else {
                $data['submit_status'] = FALSE;
                $data['submit_msg'] = 'Somthing is wrong, please try again!';
            }
        }
        $data['tradeGroups'] = $this->Comman_model->get_data('*','trade_gruop');
        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        // echo'<pre>';print_r($data['all_developers']);exit;
        $data['_view'] = 'project/add_project';
        $this->load->view('template/view', $data);
    }

    public function project_list()
    {
        $data['all_projects'] = $this->Comman_model->get_data('*', 'project');
        // echo'<pre>';print_r($data['all_developers']);exit;
        $data['_view'] = 'project/all_projects';
        $this->load->view('template/view', $data);
    }

    public function edit_project($project_id)
    {

        if ($project_id) {

            $postData = $this->input->post();
            if ($postData) {
                $pramas = array(
                    'developer_id' => $postData['developer_id'],
                    'project_name' => $postData['project_name'],
                    'project_location' => $postData['region'],
                    'gst_number' => $postData['gst_number'],
                    'project_type' => $postData['project_type'],
                    'mr_name' => $postData['mr_name'],
                    'email_id' => $postData['email'],
                    'contact_number' => $postData['contact_number'],
                    'start_date' => $postData['start_date'],
                    'end_date' => $postData['end_date'],
                    'address' => $postData['address'],
                    'status' => $postData['status']
                );
                $this->Comman_model->update_Data('project', $pramas, array('project_id' => $project_id));

                $is_tradegroup = $this->Comman_model->get_data_by_id('*','project_tradegroup_allocation', array('project_id' => $project_id));
                if(!empty($is_tradegroup))
                {
                    $this->Comman_model->permanant_delete('project_tradegroup_allocation', array('project_id'=>$project_id));
                }
                foreach($postData['trade_id'] as $tradegroup_id)
                {
                    $pramas2 = array(
                        'project_id' => $project_id,
                        'tradegroup_id' => $tradegroup_id
                    );
                    $this->Comman_model->insert_data('project_tradegroup_allocation',$pramas2);
                }
            }

            $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
            $data['project'] = $this->Comman_model->get_data_by_id('*', 'project', array('project_id' => $project_id));
            // echo'<pre>';print_r($data['project']);exit;
            $data['tradeGroups'] = $this->Comman_model->get_data('*','trade_gruop');
            $data['_view'] = 'project/edit_project';
            $this->load->view('template/view', $data);
        } else {
            redirect('all-projects');
        }
    }

    public function remove_project($project_id)
    {
        if ($project_id) {
            $this->Comman_model->permanant_delete('project', array('project_id' => $project_id));
            redirect('all-projects');
        }
    }
    public function add_structure()
    {
        // $res = $this->Comman_model->get_data('*','structure');
        //     echo'<pre>';print_r($res);exit;

        // $postData = $this->input->post();
        // if ($postData) {
        //     $pramas = array(
        //         'project_id' => $postData['project_id'],
        //         'structure_name' => $postData['structure_name'],
        //         'structure_area' => $postData['structure_area'],
        //     );
        //     // echo'<pre>';print_r($postData);exit;
        //     $res = $this->Comman_model->insert_data('structure', $pramas);
        //     if ($res) {
        //         redirect('view-structure');
        //     }
        // }

        $structure_name = $this->input->post('structure_name');
        $structure_area = $this->input->post('structure_area');
        $project_id = $this->input->post('project_id');
                // echo json_encode($structure_name);

        // if ($structure_name != '') {
            $pramas = array(
                'project_id' => $project_id,
                'structure_name' => $structure_name,
                'structure_area' => $structure_area,
            );
            // echo'<pre>';print_r($postData);exit;
            $res = $this->Comman_model->insert_data('structure', $pramas);
            if ($res) {
                echo json_encode($pramas);
            }
        // }

    }

    public function edit_structure()
    {
        $structure_name = $this->input->post('structure_name');
        $structure_area = $this->input->post('structure_area');
        $structure_id = $this->input->post('structure_id');
        if ($structure_id) {
            // echo'<pre>';print_r($postData);exit;
            $pramas = array(
                'structure_name' => $structure_name,
                'structure_area' => $structure_area,
            );
            $res = $this->Comman_model->update_data('structure', $pramas, array('structure_id' => $structure_id));
            if ($res) {
                echo json_encode($pramas);
            }
        }
    }

    public function view_structure()
    {
        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        $data['_view'] = 'project/add_structure';
        $this->load->view('template/view', $data);
    }



    public function get_projects_by_dev_id()
    {
        $user = $this->session->userdata('user_data');
        $change_developer = $this->input->post('developer_id');
        if ($change_developer) {
            if($user->user_type == '1'){
                $all_projects = $this->Comman_model->get_data('*', 'project', array('developer_id' => $change_developer));
                echo json_encode($all_projects);
            }else{
                $join = array($this->db->join('user_project_access b', 'a.project_id=b.project_id'));
                $all_projects = $this->Comman_model->get_data('a.*, b.*', 'project a', array('a.developer_id' => $change_developer, 'b.user_id' => $user->user_id));
                echo json_encode($all_projects);
            }
        }
    }

    public function get_structures_by_project_id()
    {
        $project_id = $this->input->post('project_id');
        if ($project_id) {
            $all_structures = $this->Comman_model->get_data('*', 'structure', array('project_id' => $project_id));
            echo json_encode($all_structures);
        }
    }

    public function get_structures_by_structure_id()
    {
        $structure_id = $this->input->post('structure_id');
        if ($structure_id) {
            $structure = $this->Comman_model->get_data_by_id('*', 'structure', array('structure_id' => $structure_id));
            echo json_encode($structure);
        }
    }


    public function add_stage()
    {
        $stage_name = $this->input->post('stage_name');
        $structure_id = $this->input->post('structure_id');
        if ($structure_id) {
            $pramas = array(
                'structure_id' => $structure_id,
                'stage_name' => $stage_name
                // 'structure_area' => $postData['structure_area'],
            );
            // echo'<pre>';print_r($pramas);exit;
            $res = $this->Comman_model->insert_data('stages', $pramas);
            if ($res) {
                echo json_encode($pramas);
            }
        }
    }

    public function edit_stage()
    {
        $stage_id = $this->input->post('stage_id');
        $stage_name = $this->input->post('stage_name');
        if ($stage_id) {
            // echo'<pre>';print_r($postData);exit;
            $pramas = array(
                'stage_name' => $stage_name,
            );
            $res = $this->Comman_model->update_data('stages', $pramas, array('stage_id' => $stage_id));
            if ($res) {
                echo json_encode($pramas);
            }
        }
    }

    public function get_stage_by_stage_id()
    {
        $stage_id = $this->input->post('stage_id');
        if ($stage_id) {
            $stage = $this->Comman_model->get_data_by_id('*', 'stages', array('stage_id' => $stage_id));
            echo json_encode($stage);
        }
    }

    public function get_stages_by_structure_id()
    {
        $structure_id = $this->input->post('structure_id');
        if ($structure_id) {
            $structure = $this->Comman_model->get_data('*', 'stages', array('structure_id' => $structure_id));
            echo json_encode($structure);
        }
    }

    public function add_unit()
    {
        $stage_id = $this->input->post('stage_id');
        $unit_number = $this->input->post('unit_number');
        $unit_type = $this->input->post('unit_type');
        $unit_area = $this->input->post('unit_area');
        if ($stage_id) {
            $pramas = array(
                'stage_id' => $stage_id,
                'unit_type' => $unit_type,
                'unit_area' => $unit_area,
                'unit_code' => $unit_number
                // 'structure_area' => $postData['structure_area'],
            );
            // echo'<pre>';print_r($pramas);exit;
            $res = $this->Comman_model->insert_data('units', $pramas);
            if ($res) {
                echo json_encode($pramas);
            }
        }
    }

    public function get_unit_by_unit_id()
    {
        $unit_id = $this->input->post('unit_id');
        if ($unit_id) {
            $unit = $this->Comman_model->get_data_by_id('*', 'units', array('unit_id' => $unit_id));
            echo json_encode($unit);
        }
    }

    public function edit_unit()
    {
        $unit_id = $this->input->post('unit_id');
        $unit_number = $this->input->post('unit_number');
        $unit_area = $this->input->post('unit_area');
        $unit_type = $this->input->post('unit_type');
        if ($unit_id) {
            // echo'<pre>';print_r($postData);exit;
            $pramas = array(
                'unit_type' => $unit_type,
                'unit_area' => $unit_area,
                'unit_code' => $unit_number
            );
            $res = $this->Comman_model->update_data('units', $pramas, array('unit_id' => $unit_id));
            if ($res) {
                echo json_encode($res);

            }
        }
    }

    public function get_units_by_stage_id()
    {
        $stage_id = $this->input->post('stage_id');
        if ($stage_id) {
            $structure = $this->Comman_model->get_data('*', 'units', array('stage_id' => $stage_id));
            echo json_encode($structure);
        }
    }

    public function add_subunit()
    {
        $postData = $this->input->post();
        if ($postData) {
            $pramas = array(
                'unit_id' => $postData['unit_id'],
                'subunit_name' => $postData['subunit_name'],

                // 'structure_area' => $postData['structure_area'],
            );
            // echo'<pre>';print_r($pramas);exit;
            $res = $this->Comman_model->insert_data('subunit', $pramas);
            if ($res) {
                redirect('view-structure');
            }
        }
    }

    public function get_subunit_by_unit_id()
    {
        $unit_id = $this->input->post('unit_id');
        if ($unit_id) {
            $structure = $this->Comman_model->get_data('*', 'subunit', array('unit_id' => $unit_id));
            echo json_encode($structure);
        }
    }
    public function get_subunit_by_subunit_id()
    {
        $subunit_id = $this->input->post('subunit_id');
        if ($subunit_id) {
            $subunit = $this->Comman_model->get_data_by_id('*', 'subunit', array('subunit_id' => $subunit_id));
            echo json_encode($subunit);
        }
    }

    public function edit_subunit()
    {
        $postData = $this->input->post();
        if ($postData) {
            // echo'<pre>';print_r($postData);exit;
            $pramas = array(
                'subunit_name' => $postData['subunit_name'],
            );
            $res = $this->Comman_model->update_data('subunit', $pramas, array('subunit_id' => $postData['subunit_id']));
            if ($res) {
                redirect('view-structure');
            }
        }
    }

    public function remove_structure()
    {
        $structure = $this->input->post('structures');
        $structures_id = json_decode($structure);
        foreach ($structures_id as $structure) {
            $this->Comman_model->permanant_delete('structure', array('structure_id' => $structure));
        }
    }

    public function remove_stages()
    {
        $stages = $this->input->post('stages');
        $stages_id = json_decode($stages);
        foreach ($stages_id as $stages) {
            $unit_id = $this->Comman_model->get_data_by_id('*', 'units', array('stage_id' => $stages))->unit_id;
            $this->Comman_model->permanant_delete('stages', array('stage_id' => $stages));
            $this->Comman_model->permanant_delete('units', array('stage_id' => $stages));
            $this->Comman_model->permanant_delete('subunit', array('unit_id' => $unit_id));
        }
    }

    public function remove_units()
    {
        $units = $this->input->post('units');
        $units_id = json_decode($units);
        foreach ($units_id as $unit) {
            $del_unit = $this->Comman_model->permanant_delete('units', array('unit_id' => $unit));
            $del_subunits = $this->Comman_model->permanant_delete('subunit', array('unit_id' => $unit));
            echo json_encode($del_subunits);
        }
    }

    public function remove_subunits()
    {
        $subunits = $this->input->post('subunits');
        $subunits_id = json_decode($subunits);
        foreach ($subunits_id as $subunit) {
            $this->Comman_model->permanant_delete('subunit', array('subunit_id' => $subunit));
        }
    }

    public function get_mr_name_by_project_id()
    {
        $project_id = $this->input->post('project_id');
        if ($project_id) {
            $project = $this->Comman_model->get_data('*', 'project', array('project_id' => $project_id));
            if (!empty($project)) {
                echo json_encode($project);
            }

        }

    }


    public function getAllocatedUserByProject()
    {
        $project_id = $this->input->post('project_id');
        $roles = $this->Comman_model->get_data('*', 'roles', array('role_access'=> 0));
        $data = array();
        foreach($roles as $role)
        {
            $join = array($this->db->join('user_project_access b', 'a.user_id=b.user_id'));
            $data[str_replace(' ','',$role->role_title)] = $this->Comman_model->get_data('a.user_id,a.first_name, a.last_name', 'users a', array('b.project_id' => $project_id, 'a.user_type'=> $role->role_id));
        }
        // $userList['responsibles'] = $this->Comman_model->get_data('a.user_id,a.first_name, a.last_name', 'users a', array('b.project_id' => $project_id, 'a.user_type'=> 3));
        // $userList['reviewvers'] = $this->Comman_model->get_data('a.user_id,a.first_name, a.last_name', 'users a', array('b.project_id' => $project_id, 'a.user_type'=> 4));
        // $userList['approvals'] = $this->Comman_model->get_data('a.user_id,a.first_name, a.last_name', 'users a', array('b.project_id' => $project_id, 'a.user_type'=> 5));
        $data['tradeGroups'] = $this->getAllocatedTradegroupByProject($project_id);
        echo json_encode($data);
    }


    public function getAllocatedTradegroupByProject($project_id)
    {
        $join = array($this->db->join('project_tradegroup_allocation b', 'a.tradegroup_id=b.tradegroup_id'));
        $tradeGroups = $this->Comman_model->get_data('a.*, b.*', 'trade_gruop a', array('b.project_id' => $project_id), $join);
        return $tradeGroups;
    }


    public function allocateWBS()
    {
        $postData = $this->input->post();
        if($postData)
        {
            // echo'<pre>';print_r($postData);exit;
            foreach($postData['userlist'] as $user_id)
            {
                $pramas = array(
                    'developer_id' => $postData['developer_id'],
                    'project_id' => $postData['project_id'],
                    'structure_id' => $postData['structure_ckeck'] ? $postData['structure_ckeck'] : '',
                    'stage_id' => $postData['stage_ckeck'] ? $postData['stage_ckeck'] : '',
                    'tradegroup_id' => $postData['tradegroup_id'],
                    'trade_id' => $postData['trade_id'],
                    'allocated_user' => $user_id,
                );
                $this->Comman_model->insert_data('wbs_user_allocation', $pramas);
            }

            redirect('view-structure');
        }
    }




}

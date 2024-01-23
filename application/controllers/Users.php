<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    }
	
	function user_list(){

        $data['users'] = $this->Comman_model->get_data('*','users');
        $data['projects'] = $this->Comman_model->get_data('*', 'project');
        $data['_view'] = 'users/user_list';
        $this->load->view('template/view', $data);
    }
    
    public function create_user(){

        $postData = $this->input->post();
        if($postData){
            // echo'<pre>';print_r($postData);exite;
            $params = array(
                'developer_id' => $postData['developer_id'],
                'project_id' => $postData['project_id'],
                'first_name' => $postData['first_name'],
                'last_name' => $postData['last_name'],
                'password' => base64_encode($postData['password']),
                'contact' => $postData['contact_number'],
                'email' => $postData['email'],
                'user_type' => $postData['user_type']
            );
            $res = $this->Comman_model->insert_data('users', $params);
            if($res){
                redirect('user-list');
            }
        }

        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        $data['_view'] = 'users/new_user';
        $this->load->view('template/view', $data);
    }

    public function edit_user($user_id){

        if($user_id){
            $postData = $this->input->post();
            if($postData){
                $params = array(
                    'developer_id' => $postData['developer_id'],
                    'project_id' => $postData['project_id'],
                    'first_name' => $postData['first_name'],
                    'last_name' => $postData['last_name'],
                    'contact' => $postData['contact_number'],
                    'email' => $postData['email'],
                    'user_type' => $postData['user_type']
                );
                $res = $this->Comman_model->update_data('users', $params, array('user_id' => $user_id));
            }
            $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
            $data['user'] = $this->Comman_model->get_data_by_id('*', 'users', array('user_id'=>$user_id));
            $data['_view'] = 'users/edit_user';
            $this->load->view('template/view', $data);
        }else{

            redirect('user-list');
        }

    }


    public function delete_user($user_id){
        if($user_id){
            $res = $this->Comman_model->permanant_delete('users', array('user_id' => $user_id));
            redirect('user-list');

        }else{
            redirect('user-list');
        }
    }


    public function user_access_control($user_id)
    {
        $postData = $this->input->post();
        if($postData)
        {

            //check for is user already has permisson, if yes then delete all permission
            $isAlready = $this->Comman_model->get_data_by_id('*', 'permission', array('user_id'=> $user_id));
            if($isAlready)
            {
                $this->Comman_model->permanant_delete('permission', array('user_id'=> $user_id));

            }

            $modules = array();
            $submodules = array();
            foreach($postData as $key=>$value)
            {
                if($key == 'module_'.$value){
                    $modules[$key] = $value;
                }else{
                    $submodules[$key] = $value;

                }
            }
            // echo '<pre>';print_r($modules);
            // echo '<pre>';print_r($submodules);exit;

            $finalarr = array();
            foreach($modules as $key=>$value)
            {
                

                $arr = array();
                $subArr = array();
                $submode = $this->Comman_model->get_data('*', 'submodule', array('module_id'=>$value));
                if(!empty($submode)){
                    foreach($submode as $sub)
                    {
                       $str = 'submodule_'.$value.'_'.$sub->submodule_id;
                       if($submodules[$str]){

                           $subArr[] = $submodules[$str];
                       }
                       
                    }
                    $arr['submodule'] = $subArr;
                    $arr['module'] = $value;

                }else{
                    $arr['submodule'] = [];
                    $arr['module'] = $value;

                }
                array_push($finalarr, $arr);
                // echo '<pre>';print_r($finalarr);exit;

            }
             //Inserting to database
                foreach($finalarr as $data)
                {
                    if(!empty($data['submodule']))
                    {

                        foreach($data['submodule'] as $sub)
                        {
                            $param = array(
                                'user_id' => $user_id,
                                'module_id' => $data['module'],
                                'submodule_id' => $sub
                            );
                            $this->Comman_model->insert_data('permission', $param);
                        }

                    }else{
                        $param = array(
                            'user_id' => $user_id,
                            'module_id' => $data['module']
                        );
                        $this->Comman_model->insert_data('permission', $param);
                    }
                }

            // echo '<pre>';print_r($finalarr);exit;

        }
        $data['modules'] = $this->moduleData() ;
        $data['user'] = $user_id ;
        // echo '<pre>';print_r($data['modules']);exit;
        $data['_view'] = 'users/user_access';
        $this->load->view('template/view', $data);   
    }

    public function moduleData()
    {
        $data = array();
        $modules = $this->Comman_model->get_data('*', 'modules');

        foreach($modules as $module)
        {
            $subArray = array();
            $submode = $this->Comman_model->get_data('*', 'submodule', array('module_id'=>$module->module_id));
            $subArray['submodule'] = $submode;
            $subArray['module'] = $module->module_name;
            $subArray['module_id'] = $module->module_id;
            $subArray['module_icon'] = $module->icon;
            $subArray['module_slug'] = $module->slug;
            array_push($data, $subArray);
        }
        
        return $data;
    }


    public function remove_user_access($user_id)
    {
        $this->Comman_model->permanant_delete('permission', array('user_id'=> $user_id));
        redirect('user_access/'.$user_id);
    }


    public function assing_project()
    {
        $postData = $this->input->post();
        if($postData)
        {

            //Check if project is already assign if yes then delete all
            $res = $this->Comman_model->get_data('*','user_project_access', array('user_id'=>$postData['user_id']));
            if(!empty($res))
            {
                $this->Comman_model->permanant_delete('user_project_access', array('user_id'=>$postData['user_id']));

            }

            //insert new data to table
            foreach($postData['project_ids'] as $id)
            {
                $param = array(
                    'user_id' => $postData['user_id'],
                    'project_id' => $id
                );
                $this->Comman_model->insert_data('user_project_access', $param);
            }
            redirect('user-list');
        }
    }

    public function get_all_projects()
    {
        $id = $this->input->post('user_id');
        $projects = $this->Comman_model->get_data('*', 'project');
        $projectArr = array();

        foreach($projects as $project)
        {
            $res = $this->Comman_model->get_data_by_id('*','user_project_access', array('user_id' => $id, 'project_id'=> $project->project_id));
            if(!empty($res))
            {
                $project->assigned = TRUE;
                array_push($projectArr, $project);
            }else{
                $project->assigned = FALSE;
                array_push($projectArr, $project);

            }
        }
        echo json_encode($projectArr);
    }

}

<?php
require(APPPATH . 'libraries/RestController.php');

require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class User_api extends RestController
{


    function __construct()
    {

        parent::__construct();

        error_reporting(0);

        ini_set('display_errors', 0);
        $this->load->model('Comman_model');

    }


    public function userList_get($user_id)
    {
        $user = $this->Comman_model->get_data_by_id('*', 'users', array('user_id' => $user_id));
        if(!empty($user)){
            $join = array($this->db->join('user_project_access b', 'a.project_id=b.project_id'));
            $all_projects = $this->Comman_model->get_data('a.project_id,a.project_name', 'project a', array('b.user_id' => $user_id));

            $userList = array();
            foreach($all_projects as $project)
            {
                $join = array($this->db->join('user_project_access b', 'a.user_id=b.user_id'));
                $user = $this->Comman_model->get_data('a.user_id,a.first_name, a.last_name', 'users a', array('b.project_id' => $project->project_id, 'a.user_type'=> 3), $join);
                $project->responsibleUsers = $user;
                $userList[] = $project;
            }

            $res = array(
                'success' => TRUE,
                'message' => 'response available',
                'result' => $userList
            );
            $this->response($res, RestController::HTTP_OK);
        }else
        {
            $res = array(
                'success' => FALSE,
                'message' => 'Login to access this resourse OR Invalid user Id',
                'result' => []
            );
            $this->response($res, RestController::HTTP_BAD_REQUEST);

        }

    }

}
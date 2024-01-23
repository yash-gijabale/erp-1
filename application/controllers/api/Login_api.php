<?php
require(APPPATH.'libraries/RestController.php');

require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;
class Login_api extends RestController{


	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    }


    public function login_post($postData=array()){
		$postData = $this->post();
			$password = base64_encode($postData['password']);
			$user = $this->Comman_model->get_data_by_id('*','users', array('contact' => $postData['number'], 'password'=>$password));
            if($user)

            {
                $menus = get_menus_for_mobile($user->user_id);
                // $observationData = getObservationData();
                $result = array(
                    'user' => $user,
                    'menus' => $menus
                    // 'observationData' => $observationData
                );
                $res = array(
                    'success' => TRUE,
                    'message' => 'response available',
                    'result' => $result
                );
				// $this->session->set_userdata('user_data', $user);
                $this->response($res, RestController::HTTP_OK);
            }else{
                $res = array(
                    'success' => FALSE,
                    'message' => 'Invalid Credintial',
                    'result' => []
                );
                $this->response($res, RestController::HTTP_OK);

            }

    }

    public function logout_get(){
		// $this->session->unset_userdata('user_data');
        $res = array(
            'success' => TRUE,
            'message' => 'Logged Out'
        );
        $this->response($res, RestController::HTTP_OK);

	}

}


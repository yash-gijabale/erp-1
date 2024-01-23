<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    } 
	
	public function index()
	{
		// $data['_view'] = 'login/user_login';
		if($this->session->has_userdata('user_data')){
			redirect('dashboard');	
		}else{

			$this->load->view('login/user_login');
		}
	}

	public function dashboard()
	{
		$data['graph_data'] = $this->get_graph_data();
		$data['total_developers'] = count($this->Comman_model->get_data('*','developer'));
		$data['total_projects'] = count($this->Comman_model->get_data('*','project'));
		$data['total_structurs'] = count($this->Comman_model->get_data('*','structure'));
		$data['total_observations'] = count($this->Comman_model->get_data('*','observations'));
		// echo'<pre>';print_r($data);exit;
		$data['_view'] = 'admin/dashboard';
		$this->load->view('template/view', $data);
	}

	public function get_graph_data()
	{
		$user = $this->session->userdata('user_data');
		if($user->user_type == '1')
		{
			$project_data = $this->Comman_model->get_data('*','project');
		}else{
			$join = array($this->db->join('user_project_access b','b.project_id=a.project_id'));			
			$project_data = $this->Comman_model->get_data('a.*, b.*','project a', array('b.user_id' => $user->user_id));

		}
		$data = array();
		$projects = array();
		$open_nc = array();
		$inprogress_nc = array();
		$close_nc = array();
		foreach($project_data as $project)
		{
			$obj_data = $this->Comman_model->get_data('status','observations',array('project_id'=>$project->project_id));
			$obj_array = json_decode(json_encode($obj_data), true);
			$statuswise_data = array_count_values(array_column($obj_array, 'status'));
			// array_push($projects, $project->project_name);
			// echo'<pre>';print_r($statuswise_data);exit;

			$open_count = $statuswise_data['0'] ? $statuswise_data['0'] : 0;
			$inprogress_count = $statuswise_data['1'] ? $statuswise_data['1'] : 0;
			$close_count = $statuswise_data['2'] ? $statuswise_data['2'] : 0;
			array_push($open_nc, $open_count);
			array_push($inprogress_nc, $inprogress_count);
			array_push($close_nc, $close_count);
			array_push($projects, $project->project_name);
			// echo'<pre>';print_r($array);print_r($statuswise_data['3']);exit;
		}
		$data['project_list'] = $projects;
		$data['open_nc'] = $open_nc;
		$data['progress_nc'] = $inprogress_nc;
		$data['close_nc'] = $close_nc;
		$json_data = json_encode($data);
		return($json_data);
	}

	public function login(){
		$postData = $this->input->post();
		if($postData){
			$password = base64_encode($postData['password']);
			// $user = $this->Comman_model->get_data('*','users', array('contact' => $postData['number'], 'password'=>$password));
			$user = $this->Comman_model->get_data_by_id('*','users', array('contact' => $postData['number'], 'password'=>$password));
			if($user){
				$this->session->set_userdata('user_data', $user);
				redirect('dashboard');
			}else{
				redirect('welcome/index');

			}
		}
	}

	public function logout(){
		$this->session->unset_userdata('user_data');
		redirect('welcome/index');
	}


	public function test(){
		$data['_view'] = 'admin/test';
		$this->load->view('template/view', $data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trade extends CI_Controller {

	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
		$this->load->library('Csvimport');
        $this->load->helper('file');

    }
	
	public function trade_activity()
	{

        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        $data['trade_groups'] = $this->Comman_model->get_data('*','trade_gruop');
        $data['trades'] = $this->Comman_model->get_data('*','trade');
        $data['subgroups'] = $this->Comman_model->get_data('*','subgroup');
        $data['_view'] = 'trade/trade_activity';
		$this->load->view('template/view', $data);
    }

    public function add_tradegroup(){
        $postData = $this->input->post();
        if($postData){
            $params = array(
                'tradegroup_name' => $postData['tradegroup_name'],
            );
            $res = $this->Comman_model->insert_data('trade_gruop',$params);
            if($res){
                redirect('trade-activity');
            }
        }
    }

    public function add_trade(){
        $postData = $this->input->post();
        if($postData){
            $params = array(
                'tradegroup_id' => $postData['tradegroup_id'],
                'trade_name' => $postData['trade_name']
            );
            $res = $this->Comman_model->insert_data('trade',$params);
            if($res){
                redirect('trade-activity');
            }
        }
    }

    public function add_subgroup(){
        $postData = $this->input->post();
        if($postData){
            $params = array(
                'trade_id' => $postData['trade_id'],
                'subgroup_name' => $postData['subgroup_name'],
                'subgroup_desc' => $postData['subgroup_desc']
            );
            $res = $this->Comman_model->insert_data('subgroup',$params);
            if($res){
                redirect('trade-activity');
            }
        }
    }

    public function all_trade_activity(){
        $data['trade_groups'] = $this->Comman_model->get_data('*','trade_gruop');
        $data['trades'] = $this->Comman_model->get_data('*','trade');
        $data['subgroup'] = $this->Comman_model->get_data('*','subgroup');
        $data['questions'] = $this->Comman_model->get_data('*','questions');
        $data['_view'] = 'trade/all_trade_activity';
		$this->load->view('template/view', $data);
    }


    public function get_trade_by_tradegroup(){
        $tradegrup_id = $this->input->post('tradegroup_id');
        $trades = $this->Comman_model->get_data('*','trade', array('tradegroup_id' => $tradegrup_id));
        echo json_encode($trades);
    }

    public function get_subgruop_by_trade(){
        $trade_id = $this->input->post('trade_id');
        $subgroups = $this->Comman_model->get_data('*','subgroup', array('trade_id' => $trade_id));
        echo json_encode($subgroups);
    }

    public function add_question(){
        $postData = $this->input->post();
        // echo'<pre>';print_r($postData);exit;
        if($postData){
            $params = array(
                'subgroup_id' => $postData['subgroup_id'],
                'question_title' => $postData['question_title'],
                'description' => $postData['question_desc'],
                'question_type' => $postData['type_id'],
                'question_impact' => $postData['severity_id']
            );
            $res = $this->Comman_model->insert_data('questions', $params);
            if($res){
                redirect('trade-activity');
            }
        }
    }

    public function get_tradegroup_by_id(){
        $tradegruop_id = $this->input->post('tradegroup_id');
        $res = $this->Comman_model->get_data_by_id('*', 'trade_gruop', array('tradegroup_id' => $tradegruop_id));
        echo json_encode($res);
    }

    public function edit_tradegroup(){
        $postData = $this->input->post();
        if($postData){
            $params = array(
                'tradegroup_name' => $postData['tradegroup_name'],
            );
           $this->Comman_model->update_data('trade_gruop', $params, array('tradegroup_id'=> $postData['tradegroup_id']));
           redirect('all-trade-activity');
        }
    }

    public function remove_tradegroup($id){
        if($id){
            $this->Comman_model->permanant_delete('trade_gruop', array('tradegroup_id' => $id));
            redirect('all-trade-activity');

        }else{
           redirect('all-trade-activity');

        }
    }

    public function get_trade_by_id(){
        $trade_id = $this->input->post('trade');
        $res = $this->Comman_model->get_data_by_id('*', 'trade', array('trade_id' => $trade_id));
        echo json_encode($res);
    }

    public function edit_trade(){
        $postData = $this->input->post();
        if($postData['trade_id']){
            // echo'<pre>';print_r($postData);
            $param = array(
                'trade_name' => $postData['trade_name'],
                'tradegroup_id' => $postData['tradegroup_id'],
            );
            $this->Comman_model->update_data('trade', $param, array('trade_id' => $postData['trade_id']));
            redirect('all-trade-activity');
        }else{
           redirect('all-trade-activity');

        }
    }

    public function remove_trade($trade_id){
        if($trade_id){
            $this->Comman_model->permanant_delete('trade', array('trade_id' => $trade_id));
            redirect('all-trade-activity');

        }else{
           redirect('all-trade-activity');

        }
    }

    public function  get_subgroup_by_id(){
        $subgroup_id = $this->input->post('subgroup');
        $res = $this->Comman_model->get_data_by_id('*', 'subgroup', array('subgroup_id' => $subgroup_id));
        echo json_encode($res);
    }
    
    public function edit_subgroup(){
        $postData = $this->input->post();
        if($postData['subgroup_id']){
            // echo'<pre>';print_r($postData);
            $param = array(
                'subgroup_name' => $postData['subgroup_name'],
                'subgroup_desc' => $postData['subgroup_desc'],
                'trade_id' => $postData['trade_id'],
            );
            $this->Comman_model->update_data('subgroup', $param, array('subgroup_id' => $postData['subgroup_id']));
            redirect('all-trade-activity');
        }else{
           redirect('all-trade-activity');

        }
    }

    public function remove_subgroup($id){
        if($id){
            $this->Comman_model->permanant_delete('subgroup', array('subgroup_id' => $id));
            redirect('all-trade-activity');

        }else{
           redirect('all-trade-activity');

        }
    }


    public function edit_question($id){
        $postData = $this->input->post();
        if($postData){
            // echo'<pre>';print_r($postData);exit;
            $params = array(
                'question_title' => $postData['question_title'],
                'description' => $postData['question_desc'],
                'question_type' => $postData['type_id'],
                'question_impact' => $postData['severity_id'],
                'subgroup_id' => $postData['subgroup_id']
            );
            $this->Comman_model->update_data('questions', $params, array('question_id' => $id));
        }
        $data['subgroups'] = $this->Comman_model->get_data('*','subgroup');
        $data['question'] = $this->Comman_model->get_data_by_id('*', 'questions', array('question_id' => $id));
        $data['_view'] = 'trade/edit_question';
		$this->load->view('template/view', $data);
    }


    public function  import_question()
    {
		$file_data = $this->csvimport->get_array($_FILES["importfile"]["tmp_name"]);
        echo'<pre>';print_r($file_data);
        if(!empty($file_data))
        {
            
        }
        
        exit;
    }
}

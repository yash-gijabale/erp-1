<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developers extends CI_Controller {

	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    }
	
	public function add_developers()
	{
        $postData = $this->input->post();
        if($postData){
            // echo'<pre>';print_r($postData);exit;
            $params = array(
                'developer_name' => $postData['developer_name'],
                'gst_number' => $postData['developer_gst'],
                'mr_name' => $postData['mr_name'],
                'email_id' => $postData['email'],
                'contact_number' => $postData['contact_number'],
                'address' => $postData['address'],
                'owner_name' => $postData['owner_name'],
                'owner_number' => $postData['owner_number'],
                'region' => $postData['region'],
            );
            $res = $this->Comman_model->insert_data('developer', $params);
            if($res){
                $data['submit_status'] = TRUE;
                $data['submit_msg'] = 'Developer Added successfully';
            }else{
                $data['submit_status'] = FALSE;
                $data['submit_msg'] = 'Failed to add  dev';
            }
        }
		$data['_view'] = 'developers/add_developers';
		$this->load->view('template/view', $data);
	}

    public function all_developers()
	{
        $data['all_developers'] = $this->Comman_model->get_data('*','developer');
        // print_r($data['all_developers']);exit;
		$data['_view'] = 'developers/developer_list';
		$this->load->view('template/view', $data);
	}

    public function get_developer_by_id(){
        $developer_id = $this->input->post('developer_id');
        $res = $this->Comman_model->get_Data_by_id('*', 'developer', array('developer_id' => $developer_id));
        echo json_encode($res);
    }

    public function edit_developer(){

        $postData = $this->input->post();
        if($postData){
            // echo'<pre>';print_r($postData);exit;
            if($postData['developer_id']){
                $param = array(
                    'developer_name' => $postData['developer_name'],
                    'mr_name' => $postData['mr_name'],
                    'email_id' => $postData['email'],
                    'contact_number' => $postData['contact_number'],
                    'address' => $postData['address'],
                    'owner_name' => $postData['owner_name'],
                    'owner_number' => $postData['owner_number'],
                    'region' => $postData['region'],
                );
                
                $res = $this->Comman_model->update_data('developer', $param, array('developer_id' => $postData['developer_id']));
                redirect('all-developers');
           
            }else{
                redirect('all-developers');
            }
        }
    }

    

    public function remove_developer($dev_id){
        if($dev_id){
            $this->Comman_model->permanant_delete('developer', array('developer_id' => $dev_id));
            redirect('all-developers');
        }else{
            redirect('all-developers');

        }
    }
}

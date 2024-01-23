<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    }
	
	public function generate_report(){

        $postData = $this->input->post();
        if($postData){
            // echo'<pre>';print_r($postData);exit;
            $where = array(
                'client_id' => $postData['developer_id'],
                'project_id' => $postData['project_id'],
                'tradegroup_id' => $postData['tradegroup_id'],
                'observation_date' => $postData['attempt_date']
            );
            $observation = $this->Comman_model->get_data('*','observations',$where);
            $final_report = array();
            foreach($observation as $obj){
                $obj_arr = array();
                $images = array();
                $images['obserservation_image'] = $this->Comman_model->get_data('*','observation_images', array('observation_id'=>$obj->observation_id, 'image_type'=>'0'));
                $images['recommended_image'] = $this->Comman_model->get_data('*','observation_images', array('observation_id'=>$obj->observation_id, 'image_type'=>'1'));
                $obj_arr['obj_id'] = $obj->observation_id;
                $obj_arr['developer'] = get_developer_by_id($obj->client_id);
                $obj_arr['project'] = get_projectname_by_id($obj->project_id);
                $obj_arr['trade_group'] = get_tradegroup_by_id($obj->tradegroup_id);
                $obj_arr['remark'] = $obj->remark;
                $obj_arr['reference'] = $obj->reference;
                $obj_arr['description'] = $obj->description;
                $obj_arr['location'] = $obj->location;
                $obj_arr['floors'] = json_decode($obj->floors);
                $obj_arr['obj_number'] = $obj->observation_number;
                $obj_arr['attempt_date'] = $obj->observation_date;
                $obj_arr['target_date'] = $obj->target_date;
                $obj_arr['site_representative'] = $obj->site_representative;
                $obj_arr['images'] = $images;

                // array_push($obj, $obj_arr);
                array_push($final_report, $obj_arr);
            }
            $data['form_data'] = $postData;
            // echo'<pre>';print_r($data['form_data']);exit;
            $data['report_data'] = $final_report;
        }

        $data['all_tradegroup'] = $this->Comman_model->get_data('*', 'trade_gruop');
        $data['_view'] = 'reports/report';
		$this->load->view('template/view', $data);

    }

}

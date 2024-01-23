<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {

	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    }
	

    public function check_list($checklist_id)
    {

        
        $postData = $this->input->post();
        if($postData)
        {
            if($postData['question_form'])
            {
                // echo'<pre>';print_r($postData);exit;
             if($postData['question_check'])
             {
                foreach($postData['question_check'] as $question)
                {
                    $param = array('is_check' => '1');
                    $this->Comman_model->update_data('questions', $param, array('question_id' => $question));
                    $param2 = array(
                        'checklist_id' => $checklist_id,
                        'subgroup_id' => $postData['subgroup_id'],
                        'question_id' => $question
                    );
                    $res = $this->Comman_model->insert_data('checklist_questions',$param2);
                }
             }

            }

            if($postData['uncheck_question_form'])
            {
                if($postData['question_check'])
                {
                    foreach($postData['question_check'] as $question)
                    {
                        $param = array('is_check' => '0');
                        $this->Comman_model->update_data('questions', $param, array('question_id' => $question));

                        $where = array(
                            'checklist_id' => $checklist_id,
                            'subgroup_id' => $postData['subgroup_id'],
                            'question_id' => $question
                        );
                         $res = $this->Comman_model->permanant_delete('checklist_questions',$where);

                    }
                }
            }
            $data['pre_data'] = $postData;
            $data['question_list'] = $this->Comman_model->get_data('*', 'questions', array('subgroup_id' => $postData['subgroup_id'], 'is_check' => '0'));
            // $data['checked_question_list'] = $this->Comman_model->get_data('*', 'questions', array('subgroup_id' => $postData['subgroup_id'], 'is_check' => '1'));
            $join = array($this->db->join('checklist_questions b','b.question_id=a.question_id'));
            $data['checked_question_list'] = $this->Comman_model->get_data('a.*, b.*','questions a', array('b.checklist_id' => $checklist_id, 'b.subgroup_id' => $postData['subgroup_id'] ), $join);
           
            // echo'<pre>';print_r(json_encode($data['question_list']));exit;
        }

        $join = array($this->db->join('checklist_subgroup b','b.subgroup_id=a.subgroup_id'));
        $data['subgroups'] = $this->Comman_model->get_data('a.*, b.*','subgroup a', array('b.checklist_id' => $checklist_id));
        $data['checklist_id'] = $checklist_id;
        $data['_view'] = 'checklist/check_list';
		$this->load->view('template/view', $data);
    }
	

    public function checklist_group_master()
    {
        $postData = $this->input->post();
        if($postData)
        {
            // echo'<pre>';print_r($postData);exit;
            $param = array(
                'checklist_group_name' => $postData['group_name'],
                'sequence' => $postData['sequence'],
                'persentage_cost' => $postData['persentage'],
            );

            $res = $this->Comman_model->insert_data('checklist_group', $param);

        }
        $data['checklist_group'] = $this->Comman_model->get_data('*','checklist_group');
        $data['_view'] = 'checklist/checklist_group_master';
		$this->load->view('template/view', $data);
    }


    public function get_checklist_data()
    {
        $checklist_id = $this->input->post('checklist_id');
        $res = $this->Comman_model->get_data_by_id('*', 'checklist_group', array('checklist_group_id' => $checklist_id));
        echo json_encode($res);
    }

    public function edit_checklist_group()
    {
        $postData = $this->input->post();
        if($postData)
        {
            $param = array(
                'checklist_group_name' => $postData['group_name'],
                'sequence' => $postData['sequence'],
                'persentage_cost' => $postData['persentage'],
            );
            $res = $this->Comman_model->update_data('checklist_group', $param, array('checklist_group_id' => $postData['checklist_group_id']));
            if($res)
            {
                redirect('checklist-group-master');
            }

        }
    }

    public function remove_checklist_group($id)
    {
        if($id)
        {
            $this->Comman_model->permanant_delete('checklist_group', array('checklist_group_id' => $id));
            redirect('checklist-group-master');
            
        }
    }

    public function get_all_checklistdata()
    {
        $checklist = $this->Comman_model->get_data('*','checklist');
        echo json_encode($checklist);
        

    }


    public function checklist_master()
    {
        $postData = $this->input->post();
        if($postData)
        {
            // echo'<pre>';print_r($postData);exit;
            $param = array (
                'checklist_name' => $postData['checklist_name'],
                'checklist_group_id' => $postData['checklist_group'],
                'status' => $postData['checklist_status'] ? $postData['checklist_status'] : '0'
            );
            $res = $this->Comman_model->insert_data('checklist', $param);
        }
        $data['checklist_group'] = $this->Comman_model->get_data('*','checklist_group');
        $data['checklist'] = $this->Comman_model->get_data('*','checklist');
        $data['subgroups'] = $this->Comman_model->get_data('*','subgroup');
        // print_r($data);exit;
        $data['_view'] = 'checklist/checklist_master';
		$this->load->view('template/view', $data);
    }

    public function edit_checklist_master()
    {
        $postData = $this->input->post();
        if($postData)
        {
        // print_r($postData);exit;

            $param = array (
                'checklist_name' => $postData['checklist_name'],
                'checklist_group_id' => $postData['checklist_group'],
                'status' => $postData['checklist_status']  ? '1' : '0'
            );
            $res = $this->Comman_model->update_data('checklist', $param, array('checklist_id' => $postData['checklist_id']));
            redirect('checklist-master');

        }
    }
    public function get_checklist()
    {
        $checklist_id = $this->input->post('checklist_id');
        $res = $this->Comman_model->get_data_by_id('*', 'checklist', array('checklist_id' => $checklist_id));
        echo json_encode($res);
    }

    public function remove_checklist($id)
    {
        if($id)
        {
            $this->Comman_model->permanant_delete('checklist', array('checklist_id' => $id));
            redirect('checklist-master');
        }
    }

    public function add_subgroup_to_checklist()
    {
        $postData = $this->input->post();
        if($postData)
        {
            // echo'<pre>';print_r($postData);exit;
            $param = array(
                'checklist_id' => $postData['checklist_id'],
                'subgroup_id' => $postData['subgroup_id']
            );

            $res = $this->Comman_model->insert_data('checklist_subgroup', $param);
            redirect('checklist-master');

        }
    }

    public function get_checklist_subgroups()
    {
        $id = $this->input->post('checklist_id');
        $join = array($this->db->join('checklist_subgroup b','b.subgroup_id=a.subgroup_id'));
        $res = $this->Comman_model->get_data('a.*, b.*','subgroup a', array('b.checklist_id' => $id));

        $subgroupRes = $this->Comman_model->get_data('*','subgroup');
        $subgroup = array();
        foreach($subgroupRes as $group)
        {
            $res2 = $this->Comman_model->get_data_by_id('*', 'checklist_subgroup', array('subgroup_id' => $group->subgroup_id, 'checklist_id'=>$id));
            if(empty($res2))
            {
                array_push($subgroup, $group);
            }
        }
        
        $data['subgroups'] = $subgroup;
        $data['subgroupList'] = $res;
        echo json_encode($data);


    }
}

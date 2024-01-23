<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChecklistAllocation extends CI_Controller {

	function __construct()

    {

        parent::__construct();

		error_reporting(0);

        ini_set('display_errors', 0);
		$this->load->model('Comman_model');
    }
	

    public function checklistAllocation()
    {
        $postData = $this->input->post();
        if($postData)
        {
            //Check is checklits allocation is already done then update else create new
            $where = array(
                'client_id' => $postData['developer_id'],
                'project_id' => $postData['project_id'],
                'structure_id' => $postData['structure_id'],
                'checklist_id' => $postData['checklist_id'],
                'subgroup_id' => $postData['subgroup_id'],
            );
            $isAllocated = $this->Comman_model->get_data_by_id('*', 'checklist_allocation', $where);

            if(!empty($isAllocated))
            {
                $param2 = array(
                    'client_id' => $postData['developer_id'],
                    'project_id' => $postData['project_id'],
                    'structure_id' => $postData['structure_id'],
                    'checklist_id' => $postData['checklist_id'],
                    'subgroup_id' => $postData['subgroup_id'],
                    'questions' => json_encode($postData['questions'])
                );
                    $res = $this->Comman_model->update_data('checklist_allocation', $param2, array('allocation_id' => $isAllocated->allocation_id));
            }else{
                
            $param = array(
                'client_id' => $postData['developer_id'],
                'project_id' => $postData['project_id'],
                'structure_id' => $postData['structure_id'],
                'checklist_id' => $postData['checklist_id'],
                'subgroup_id' => $postData['subgroup_id'],
                'questions' => json_encode($postData['questions'])
            );
                $res = $this->Comman_model->insert_data('checklist_allocation', $param);
            }
        }
        $data['checkList'] = $this->Comman_model->get_data('*', 'checklist');
        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        $data['_view'] = 'checklistAllocation/checklistAllocation';
		$this->load->view('template/view', $data);
    }

    public function get_subgroup_by_checklist_id()
    {
        $checklist_id = $this->input->post('checklist_id');
        $join = array($this->db->join('checklist_subgroup b','b.subgroup_id=a.subgroup_id'));
        $subgroups = $this->Comman_model->get_data('a.*, b.*','subgroup a', array('b.checklist_id' => $checklist_id));
        
        echo json_encode($subgroups);
    }

    public function get_checklist_questions_by_checklist_subgroup()
    {
        $checklist_id = $this->input->post('checklist_id');
        $subgroup_id = $this->input->post('subgroup_id');
        $developer_id = $this->input->post('developer_id');
        $project_id = $this->input->post('project_id');
        $structure_id = $this->input->post('structure_id');

        //check is questions already allocated

        //get question list fromo allocation table
        $where = array(
            'client_id' => $developer_id,
            'project_id' => $project_id,
            'structure_id' => $structure_id,
            'checklist_id' => $checklist_id,
            'subgroup_id' => $subgroup_id,
        );
        $allocated_q = $this->Comman_model->get_data_by_id('*', 'checklist_allocation', $where);

        if($allocated_q)
        {
            $allocated_questions = json_decode($allocated_q->questions);
            $join2 = array($this->db->join('checklist_questions b','b.question_id=a.question_id'));
            $questionid_list = $this->Comman_model->get_data('a.*, b.*', 'questions a', array('b.checklist_id'=>$checklist_id, 'b.subgroup_id'=>$subgroup_id));
            foreach($questionid_list as $question)
            {
                // $isPresent = array_search(strval($question->question_id), $allocated_questions);
                foreach($allocated_questions as $val)
                {
                    if($val == $question->question_id){
                        $question->isAllocated = TRUE;
                        break;

                    }else{
                        $question->isAllocated = FALSE;
                    }

                }
                
            }
       
        }else{

            $join2 = array($this->db->join('checklist_questions b','b.question_id=a.question_id'));
            $questionid_list = $this->Comman_model->get_data('a.*, b.*', 'questions a', array('b.checklist_id'=>$checklist_id, 'b.subgroup_id'=>$subgroup_id));
            foreach($questionid_list as $question)
            {
                $question->isAllocated = FALSE;
            
            }
        }
        echo json_encode($questionid_list);

    }
    
}

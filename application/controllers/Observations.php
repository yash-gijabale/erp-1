<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Observations extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        error_reporting(0);

        ini_set('display_errors', 0);
        $this->load->model('Comman_model');
        $this->load->library('upload');
    }

    public function new_observation()
    {
        $user = $this->session->userdata('user_data');
        $postData = $this->input->post();
        if ($postData) {

            $observation_param = array(
                'client_id' => $postData['developer_id'],
                'project_id' => $postData['project_id'],
                'structure_id' => $postData['structure_id'],
                'floors' => json_encode($postData['stages_id']),
                'tradegroup_id' => $postData['trade_group'],
                'activity_id' => $postData['activity_id'],
                'observation_number' => $postData['observation_number'],
                'observation_category' => $postData['category_id'],
                'observation_type' => $postData['observation_Type_id'],
                'location' => $postData['location'],
                'description' => $postData['decsription'] ? $postData['decsription'] : '',
                'remark' => $postData['remark'],
                'reference' => $postData['reference'] ? $postData['reference'] : '',
                'observation_severity' => $postData['severity_id'],
                'site_representative' => $postData['site_representative'],
                'status' => $postData['status'],
                'closed_by' => $postData['allocate_to'],
                'observation_date' => $postData['observation_date'],
                'target_date' => $postData['target_date'],
                'created_by' => $user->user_id
            );
            // echo'<pre>';print_r($observation_param);exit;
            $observation_id = $this->Comman_model->insert_data('observations', $observation_param);
            $history_param = array
            (
                'observation_id' => $observation_id,
                'user_id' => $postData['user_id'],
                'role_id' => $postData['role_id'],
                'comment' => $postData['remark'],
            );
            $history_id = $this->Comman_model->insert_data('observation_history', $history_param);

            //Adding new observation to reviwer table
            $paramRview = array
            (
                'observation_id' => $observation_id,
                'obj_history_id' => $history_id,
                'added_By' => $user->user_id,
                'assigned_to' => $user->user_id,
                'comment' => '',
                'is_approved' => '0',
            );
            
            $ress = $this->Comman_model->insert_data('responsible_history', $paramRview);
            $resss = $this->Comman_model->insert_data('site_enginner_history', $paramRview);

            if ($observation_id) {
                $image_name[] = $_FILES['observation_image'];
                $image_name[] = $_FILES['recommended_image'];
                // echo'<pre>';print_r($image_name);exit;
                foreach ($image_name as $imgkey => $imgval) {
                    $pcount = count($imgval['name']);

                    for ($i = 0; $i < $pcount; $i++) {
                        if (($imgval['size'][$i] != 0) || ($imgval['size'][$i] != '')) {
                            $pdata = array();
                            $filenm = '';
                            $config['upload_path'] = UPLOAD_OBSERVATION;
                            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
                            $this->upload->initialize($config);
                            //echo $_FILES[$image_name]['name'][$i];
                            $newName = 'observation' . '_' . str_replace(' ', '', $imgval['name'][$i]);
                            // echo'<pre>';print_r($newName);exit;
                            $_FILES['userfile']['name'] = $newName;
                            $_FILES['userfile']['type'] = $imgval['type'][$i];
                            $_FILES['userfile']['tmp_name'] = $imgval['tmp_name'][$i];
                            $_FILES['userfile']['error'] = $imgval['error'][$i];
                            $_FILES['userfile']['size'] = $imgval['size'][$i];
                            if (!$this->upload->do_upload('userfile')) {
                                $filenm = '';

                            } else {
                                $fname = $this->upload->data();
                                $filenm = UPLOAD_OBSERVATION . $fname['file_name'];

                            }
                            if ($filenm != '') {
                                $image_param = array(
                                    'observation_id' => $observation_id,
                                    'image_path' => $filenm,
                                    'obj_history_id' => $history_id,
                                    'image_type' => $imgkey
                                );
                                $this->Comman_model->insert_data('observation_images', $image_param);

                            }

                        }
                    }


                }
            }

            // exit;
        }

        $data['all_tradesgroup'] = $this->Comman_model->get_data('*', 'trade_gruop');
        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        $data['observation_type'] = $this->Comman_model->get_data('*', 'observation_type');
        $data['observation_severity'] = $this->Comman_model->get_data('*', 'observation_severity');
        $data['observation_category'] = $this->Comman_model->get_data('*', 'categories');
        $data['_view'] = 'observations/new_observation';
        $this->load->view('template/view', $data);
    }

    public function observation_list()
    {
        $user_type = $this->session->userdata('user_data')->user_type;
        $user_id = $this->session->userdata('user_data')->user_id;
        if ($user_type == '1') {
            $data['all_observations'] = $this->Comman_model->get_data('*', 'observations');

            // echo'<pre>';print_r($data['all_observations']);exit;
        } else {
            $table = get_history_table_by_role_id($user_type);
            $allow_projects = $this->Comman_model->get_data('*', 'user_project_access', array('user_id' => $user_id));
            $wbs_allocation = $this->Comman_model->get_data_by_id('*','wbs_user_allocation',array('allocated_user'=>$user_id));
            // echo'<pre>';print_r($wbs_allocation);exit;
            $objects = array();
            foreach ($allow_projects as $userAccess) {
                $join = array($this->db->join($table . ' b', 'a.observation_id=b.observation_id'));
                $obj = $this->Comman_model->get_data('a.*,b.*', 'observations a', 
                array('a.project_id' => $userAccess->project_id, 'a.structure_id'=>$wbs_allocation->structure_id), 
                $join);
                if ($obj) {
                    array_push($objects, $obj);
                }
            }
            $data['all_observations'] = array_merge(...$objects);
        }
        // echo'<pre>';print_r(array_merge(...$objects));exit;
        $data['_view'] = 'observations/observation_list';
        $this->load->view('template/view', $data);
    }

    public function edit_view_observation($observation_id)
    {

        $user = $this->session->userdata('user_data');

        $postData = $this->input->post();
        if ($postData) {
            //   print_r($table);exit;
            if ($postData['role_id'] == '1') {
                $observation_param = array(
                    'client_id' => $postData['developer_id'],
                    'project_id' => $postData['project_id'],
                    'structure_id' => $postData['structure_id'],
                    'floors' => json_encode($postData['stages_id']),
                    'tradegroup_id' => $postData['trade_group'],
                    'activity_id' => $postData['activity_id'],
                    'observation_category' => $postData['category_id'],
                    'observation_type' => $postData['observation_Type_id'],
                    'location' => $postData['location'],
                    'description' => $postData['decsription'],
                    'remark' => $postData['remark'],
                    'reference' => $postData['reference'],
                    'observation_severity' => $postData['severity_id'],
                    'site_representative' => $postData['site_representative'],
                    'status' => $postData['status'],
                    'observation_date' => $postData['observation_date'],
                    'target_date' => $postData['target_date'],
                    'created_by' => $user->user_id
                );
            } else {
                $observation_param = array
                (
                    'location' => $postData['location'],
                    'description' => $postData['decsription'],
                    'remark' => $postData['remark'],
                    'status' => '1',


                );
            }

            $update_res = $this->Comman_model->update_data('observations', $observation_param, array('observation_id' => $observation_id));
            $data['is_updated'] = $update_res;
            $history_param = array
            (
                'observation_id' => $observation_id,
                'user_id' => $postData['user_id'],
                'role_id' => $postData['role_id'],
                'comment' => $postData['remark'],
            );
            $history_id = $this->Comman_model->insert_data('observation_history', $history_param);

            if($user->user_type != '1'){
                $user_param = array
                (
                    'observation_id' => $observation_id,
                    'obj_history_id' => $history_id,
                    'added_by' => $postData['user_id'],
                    'assigned_to' => $postData['user_id'],
                );
                $table = get_history_table_by_role_id($postData['role_id']);
                $is_exist = $this->Comman_model->get_data_by_id('*', $table, array('observation_id' => $observation_id));
                if (empty($is_exist)) {
                    $user_history = $this->Comman_model->insert_data($table, $user_param);
                } else {
                    $user_param = array
                    (
                        'obj_history_id' => $history_id
                    );
                    $user_history = $this->Comman_model->update_data($table, $user_param, array('observation_id' => $observation_id));
                }
            }

            // echo'<pre>';print_r('3');exit;


            $image_name[] = $_FILES['observation_image'];
            if ($_FILES['recommended_image']) {
                $image_name[] = $_FILES['recommended_image'];
            }

            if (!empty($image_name[0]['name'][0]) || !empty($image_name[1]['name'][1])) {
                // echo'<pre>';print_r($image_name);exit;
                foreach ($image_name as $imgkey => $imgval) {
                    $pcount = count($imgval['name']);

                    for ($i = 0; $i < $pcount; $i++) {
                        if (($imgval['size'][$i] != 0) || ($imgval['size'][$i] != '')) {
                            $pdata = array();
                            $filenm = '';
                            $config['upload_path'] = UPLOAD_OBSERVATION;
                            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
                            $this->upload->initialize($config);
                            //echo $_FILES[$image_name]['name'][$i];
                            $newName = 'observation' . '_' . str_replace(' ', '', $imgval['name'][$i]);
                            // echo'<pre>';print_r($newName);exit;
                            $_FILES['userfile']['name'] = $newName;
                            $_FILES['userfile']['type'] = $imgval['type'][$i];
                            $_FILES['userfile']['tmp_name'] = $imgval['tmp_name'][$i];
                            $_FILES['userfile']['error'] = $imgval['error'][$i];
                            $_FILES['userfile']['size'] = $imgval['size'][$i];
                            if (!$this->upload->do_upload('userfile')) {
                                $filenm = '';

                            } else {
                                $fname = $this->upload->data();
                                $filenm = UPLOAD_OBSERVATION . $fname['file_name'];

                            }
                            if ($filenm != '') {
                                $image_param = array(
                                    'observation_id' => $observation_id,
                                    'image_path' => $filenm,
                                    'image_type' => $imgkey,
                                    'obj_history_id' => $history_id
                                );
                                // echo'<pre>';print_r($image_param);exit;

                                $this->Comman_model->insert_data('observation_images', $image_param);

                            }

                        }
                    }

                }
            }
        }

        $data['is_updated'] = '0';
        $data['observation'] = $this->Comman_model->get_data_by_id('*', 'observations', array('observation_id' => $observation_id));
        $data['observation_image'] = $this->Comman_model->get_data('*', 'observation_images', array('observation_id' => $observation_id, 'image_type' => '0'));
        $data['recommendation_image'] = $this->Comman_model->get_data('*', 'observation_images', array('observation_id' => $observation_id, 'image_type' => '1'));
        $data['floors'] = get_floors_by_structure_id($data['observation']->structure_id);
        // echo'<pre>';print_r($data['floors']);exit;
        $data['all_tradesgroup'] = $this->Comman_model->get_data('*', 'trade_gruop');
        $data['all_developers'] = $this->Comman_model->get_data('*', 'developer');
        $data['observation_type'] = $this->Comman_model->get_data('*', 'observation_type');
        $data['observation_severity'] = $this->Comman_model->get_data('*', 'observation_severity');
        $data['observation_category'] = $this->Comman_model->get_data('*', 'categories');
        $data['_view'] = 'observations/edit_view_observation';
        $this->load->view('template/view', $data);
    }


    public function remove_observation($id)
    {
        if ($id) {
            $this->Comman_model->permanant_delete('observations', array('observation_id' => $id));
            $this->Comman_model->permanant_delete('observation_images', array('observation_id' => $id));
            redirect('observation-list');
        }

    }

    public function delete_image($id, $obj_id)
    {
        if ($id) {
            $this->Comman_model->permanant_delete('observation_images', array('image_id' => $id));
            redirect('edit-view-observation/' . $obj_id);
        }
    }

    // public function send_for_approval(){
    //     $user_id = $this->input->post('user_id');
    //     $obj_id = $this->input->post('observation_id');
    //     $user_type = $this->input->post('user_type');
    //     if($obj_id){
    //         $observations = $this->Comman_model->get_data('*', 'responsible_history', array('added_by'=>$user_id, 'observation_id'=>$obj_id),$join=false,$orderclm='history_id', $order='DESC');
    //         echo json_encode($observations[0]);
    //         if($observations){
    //             $obj = $observations[0];
    //             if($user_type == '2'){
    //                 $param = array
    //                 (
    //                     'observation_id' => $obj->observation_id,
    //                     'obj_history_id' => $obj->obj_history_id,
    //                     'added_by' => $obj->added_by,
    //                     'assigned_to' => $obj->added_by,
    //                 );
    //                 $res = $this->Comman_model->insert_data('site_enginner_history', $param);
    //                 echo $res;
    //             }
    //         }
    //     }
    // }

    public function get_approval_list()
    {
        $user_data = $this->session->userdata('user_data');
        $user_type = $this->session->userdata('user_data')->user_type;
        $table = get_history_table_by_role_id($user_type);
        $approvals = $this->Comman_model->get_data('*', $table);
        // echo'<pre>';print_r($approvals);exit;

        $all_approval = array();
        foreach ($approvals as $approval) {
            $obj = $this->Comman_model->get_data_by_id('*', 'observations', array('observation_id' => $approval->observation_id));
            array_push($all_approval, $obj);
        }
        // echo'<pre>';print_r($all_approval);exit;
        $data['all_observations'] = $all_approval;
        $data['_view'] = 'observations/approvals';
        $this->load->view('template/view', $data);
    }

    public function get_remark_history()
    {
        $id = $this->input->post('observation_id');
        $row_history = $this->Comman_model->get_data('*', 'observation_history', array('observation_id' => $id));
        $finalData = array();
        foreach ($row_history as $history) {
            $history_arr = array();
            $history_arr['userName'] = get_username_by_id($history->user_id);
            $history_arr['role'] = get_role_of_user($history->role_id);
            $history_arr['comment'] = $history->comment;
            $history_arr['created_date'] = date('d-M-Y h:i:A', strtotime($history->cretated_at));
            $history_arr['images'] = $this->Comman_model->get_data('*', 'observation_images', array('observation_id' => $id, 'obj_history_id' => $history->obj_history_id));

            array_push($finalData, $history_arr);
        }
        // echo'<pre>';print_r($finalData);
        $data['finalData'] = $finalData;
        $res = $this->load->view('observations/history_card', $data);
        echo json_encode($res);
    }

    public function send_for_approval()
    {
        $user_type = $this->session->userdata('user_data')->user_type;
        $obj_id = $this->input->post('observation_id');
        $table = get_history_table_by_role_id($user_type);
        $latest_obj = $this->Comman_model->get_data('*', $table, array('observation_id' => $obj_id), $join = false, $orderclm = 'history_id', $order = 'DESC', $limit = false, $groupby = false);
        if ($latest_obj) {
            // echo json_encode($latest_obj[0]);

            //CHECK FOR EXTING RECORD
            $tables = get_table_combiniation($user_type);
            $is_exist = $this->Comman_model->get_data_by_id('*', $tables[1], array('observation_id' => $latest_obj[0]->observation_id));
            if (empty($is_exist)) {
                $param = array
                (
                    'observation_id' => $latest_obj[0]->observation_id,
                    'obj_history_id' => $latest_obj[0]->obj_history_id,
                    'added_By' => $latest_obj[0]->added_by,
                    'assigned_to' => $latest_obj[0]->assigned_to,
                    'comment' => '',
                    'is_approved' => '0',
                );
                $res = $this->Comman_model->insert_data($tables[1], $param);
                $res = $this->Comman_model->update_data($tables[0], array('inner_status' => '1'), array('observation_id' => $latest_obj[0]->observation_id));


            } else {
                $param = array
                (
                    'obj_history_id' => $latest_obj[0]->obj_history_id,
                    'is_approved' => '0',
                    'inner_status' => '0'
                );
                $res = $this->Comman_model->update_data($tables[1], $param, array('observation_id' => $latest_obj[0]->observation_id));
                $res = $this->Comman_model->update_data($tables[0], array('inner_status' => '1'), array('observation_id' => $latest_obj[0]->observation_id));
            }
        }
    }

    public function reject_approval()
    {
        $user_type = $this->session->userdata('user_data')->user_type;
        $obj_id = $this->input->post('observation_id');
        $table = get_history_table_by_role_id($user_type);
        $latest_obj = $this->Comman_model->get_data('*', $table, array('observation_id' => $obj_id), $join = false, $orderclm = 'history_id', $order = 'DESC', $limit = false, $groupby = false);
        if ($latest_obj) {
            $tables = get_table_combiniation_for_reject($user_type);
            // print_r($tables[1]);
            $is_exist = $this->Comman_model->get_data_by_id('*', $tables[0], array('observation_id' => $latest_obj[0]->observation_id));
            if ($is_exist) {
                $param = array
                (
                    'inner_status' => '2',
                    'is_approved' => '1'

                );
                $res = $this->Comman_model->update_data($tables[1], $param, array('observation_id' => $latest_obj[0]->observation_id));
                $res = $this->Comman_model->update_data($tables[0], $param, array('observation_id' => $latest_obj[0]->observation_id));
            }
        }
    }

    public function close_observation()
    {
        $user_type = $this->session->userdata('user_data')->user_type;
        $obj_id = $this->input->post('observation_id');
        $is_exist_obj = $this->Comman_model->get_data_by_id('*', 'observations', array('observation_id' => $obj_id));
        if ($is_exist_obj) {
            $this->Comman_model->update_data('observations', array('status' => '2'), array('observation_id' => $obj_id));
        }

        $is_exist_in_site_engeenir = $this->Comman_model->get_data_by_id('*', 'site_enginner_history', array('observation_id' => $obj_id));
        if ($is_exist_in_site_engeenir) {
            $this->Comman_model->update_data('site_enginner_history', array('inner_status' => '3'), array('observation_id' => $obj_id));
        }

        $is_exist_in_responsible = $this->Comman_model->get_data_by_id('*', 'responsible_history', array('observation_id' => $obj_id));
        if ($is_exist_in_responsible) {
            $this->Comman_model->update_data('responsible_history', array('inner_status' => '3'), array('observation_id' => $obj_id));
        }

        $is_exist_in_reviwver = $this->Comman_model->get_data_by_id('*', 'reviewer_history', array('observation_id' => $obj_id));
        if ($is_exist_in_reviwver) {
            $this->Comman_model->update_data('reviewer_history', array('inner_status' => '3'), array('observation_id' => $obj_id));
        }

        $is_exist_in_site_approval = $this->Comman_model->get_data_by_id('*', 'approval_history', array('observation_id' => $obj_id));
        if ($is_exist_in_site_approval) {
            $this->Comman_model->update_data('approval_history', array('inner_status' => '3'), array('observation_id' => $obj_id));
        }

    }

}

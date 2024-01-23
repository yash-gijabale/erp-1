<?php
class User_model extends CI_model
{
   function getUserData()
    {
        $this->load->database();
        $q = $this->db->query("SELECT * FROM users");
        return $q->result_array();
       
    }

    function is_user_valid($formdata)
    {
        $q = $this->db->where(['contact'=>$formdata['number'], 'password'=>$formdata['password']])
                 ->get('users');
                
        if($q->num_rows()){
            return TRUE;
        }else
        {
            return FALSE;
        }
            
    }

    function change_password($formdata)
    {
        $q = $this->db->where(['id'=>$formdata['user_id'], 'password'=>$formdata['old_pass']])
                 ->get('admin');
                
        if($q->num_rows()){
            return TRUE;
        }else
        {
            return FALSE;
        }
            
    }
}


?>
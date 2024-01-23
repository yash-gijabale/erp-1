<?php

class Comman_model extends CI_Model{

    function __construct()

    {        parent::__construct();    }

	function insert_data($table,$data)

	{

		$this->db->insert($table,$data);

		if($this->db->affected_rows()==1)

		{			return $this->db->insert_id();

		}else{			return FALSE;

		}

	}

	public function get_data($select,$table,$where=false,$join=false,$orderclm=false, $order=false,$limit=false,$groupby=false)

	{

		$this->db->select($select);

		$this->db->from($table);

		if($where){

			$this->db->where($where);

		}

		if($join){

			$join;

		}

		$this->db->order_by($orderclm,$order);

		if($limit){			$this->db->limit($limit);

		}				if($groupby){			$this->db->group_by($groupby); 		}

		$query= $this->db->get();

		$data = $query->result();

		return $data;		

	}

	public function get_data_by_id($select,$table,$where=false,$like=false,$join=false)

	{

		$this->db->select($select);

		$this->db->from($table);

		if($where){

			$this->db->where($where);

		}

		if($like){

			$like;

		}		if($join){			$join;		}

		$query = $this->db->get();

		$data = $query->row();				

		return $data;		

	}	

	public function get_data_array($queryArr)	

	{		

		$this->db->select($queryArr['select']);		

		$this->db->from($queryArr['table']);		

		if($queryArr['where']){			

		$this->db->where($queryArr['where']);		

		}		

		if($queryArr['join']){			

		$queryArr['join'];		

		}				

		if(isset($queryArr['orderclm']) && isset($queryArr['order']))		

		{			

			$this->db->order_by($queryArr['orderclm'],$queryArr['order']);		

		}		

		$this->db->limit($queryArr['length'],$queryArr['start']);				

		if($queryArr['groupby']){			

			$this->db->group_by($queryArr['groupby']); 		

		}		

		$query= $this->db->get();		

		$data = $query->result();				

		return $data;			

	}

	

	function update_data($table,$data,$where)

	{

		$this->db->where($where);

		$this->db->update($table,$data);

		if($this->db->affected_rows()==1)

		{

			return TRUE;

		}else{	
			return FALSE;

		}

	}

	function insert_bulk_data($data,$table)	{

		$this->db->insert_batch($table, $data);

	}
	

	function permanant_delete($table,$where=false)

	{

		if($where){

			$this->db->where($where);

		}

		$this->db->delete($table);

	}



	public function get_data_by_array($select,$table,$where=false,$join=false,$orderclm=false, $order=false,$limit=false,$groupby=false)

	{

		$this->db->select($select);

		$this->db->from($table);

		if($where){

			$this->db->where($where);

		}

		if($join){

			$join;

		}

		$this->db->order_by($orderclm,$order);

		if($limit){			$this->db->limit($limit);

		}				if($groupby){			$this->db->group_by($groupby); 		}

		$query= $this->db->get();

		$data = $query->result_array();

		return $data;		

	}

}


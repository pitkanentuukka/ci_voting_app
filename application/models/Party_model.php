<?php

class Party_model extends CI_Model {
	public function __construct() 
	{
		$this->load->database();
	}



	public function get_parties() 
	{
		$query = $this->db->get('party');
		return $query->result_array();
	}
	
	public function add_party() 
	{
		$data = array(
			'name' => $this->input->post('party'),
			'link' => $this->generateLink()
			);
		$this->db->insert('party', $data);
		return $this->db->insert_id();
	}
	public function getById($id)
	{
		//$query = $this->db->get_where('party', array('id', $id));
		/*$query = $this->db->get('party');
		$this->db->where('id', $id);
	
		var_dump($query);*/
		
		//$query = $this->db->query('select * from party where id = $id');
		//$query = $this->db->get_where('party', array('id', $id));
		$this->db->select('*');
		$this->db->from('party');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		
		return $query->row();
		
	}
	
	private function generateLink()
	{
		return sha1(uniqid());
		
	}
}

<?php
class District_model extends CI_Model {

	public function __construct() 
	{
		$this->load->database();
	}



	public function get_districts() 
	{
		$query = $this->db->get('district');
		return $query->result_array();
	}

	public function add_district() 
	{
		$data = array(
			'district' => $this->input->post('district')
			);
		return $this->db->insert('district', $data);
	}
}

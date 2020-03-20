<?php

class Candidate_model extends CI_Model {
	public function __construct() 
	{
		$this->load->database();
	}

	public function add_candidate($party_id)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'number' => $this->input->post('number'),
			'district_id' => $this->input->post('district'),
			'party_id' => $party_id
		);
		$this->db->insert('party', $data);
		return $this->db->insert_id();
	}


}

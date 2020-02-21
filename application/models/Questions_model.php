<?php
class Questions_model extends CI_Model {

	public function __construct() 
	{
		$this->load->database();
	}



	public function get_questions() 
	{
		$query = $this->db->get('question');
		return $query->result_array();
	}


}

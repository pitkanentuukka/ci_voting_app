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

	public function add_question() 
	{
		$data = array(
			'question' => $this->input->post('question')
			);
		 $this->db->insert('question', $data);
		 return $this->db->insert_id();
	}
	
	public function remove_question($id)
	{
		//$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('question');
		
	}
			
}

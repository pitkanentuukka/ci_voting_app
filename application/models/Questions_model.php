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
		$this->db->where('id', $id);
		$this->db->delete('question');
		
	}
	public function update()
	{
		$this->db->set('question', $this->input->post('question'));
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('question');
	}	
}

<?php
class Candidate extends CI_Controller {


	public function __construct() 
	{

		parent::__construct();
		$this->load->model('district_model');
		$this->load->model('party_model');
		$this->load->model('candidate_model');
		$this->load->helper('url_helper');
	}
	
	public function new($link)
	{
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$party = $this->party_model->getByLink($link);
////	var_dump($party);
		if ($party !== NULL) {
			$data['partyname'] = $party->name;
			$data['partyid'] = $party->id;
			$districts = $this->district_model->get_districts();
			$data['districts'] = $districts;
			//var_dump($districts);
			$this->form_validation->set_rules('name', 'name', 'required');

			$this->form_validation->set_rules('number', 'number', 'required');
			$this->form_validation->set_rules('district', 'district', 'required');
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('candidate/new', $data);

				
				
			} else {
				$this->candidate_model->add_candidate($party->id);
				$this->load->view('candidate_added');
				// this is where we could show the questions

			
			
		   }
			
			
		} else {
			$this->load->view('candidate/invalid_link');
		}
		
		
		
	}
}

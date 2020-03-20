<?php
class District extends CI_Controller {


	public function __construct() 
	{

		parent::__construct();
		$this->load->model('district_model');
		$this->load->helper('url_helper');
	}

	public function index() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$data['districts'] = $this->district_model->get_districts();
		$data['title'] = "Voting districts";
		$data['h1'] = "Voting Districts";
		$this->load->view('templates/header', $data);
		$this->load->view('district/home', $data);
		$this->load->view('district/add', $data);

		$this->load->view('templates/footer', $data);
	
	}
	
	public function add()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = "Add a district";
		$data['h1'] = "Add a district";
		$this->form_validation->set_rules('district', 'district', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('district/add', $data);
			$this->load->view('templates/footer');
		} else {
			$this->district_model->add_district();
			$data['title'] = "district added";
			$data['district'] = $this->input->post('district');
			$this->load->view('templates/header', $data);
			$this->load->view('district/success', $data);
		}
	}
}

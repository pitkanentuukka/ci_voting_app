<?php
class Party extends CI_Controller {


	public function __construct() 
	{

		parent::__construct();
		$this->load->model('party_model');
		$this->load->helper('url_helper');
	}

	public function index() 
	{
		$data['parties'] = $this->party_model->get_parties();
		$data['title'] = "Parties and links";
		$data['h1'] = "parties";
		$this->load->view('templates/header', $data);
		$this->load->view('party/home', $data);
		$this->load->view('templates/footer', $data);
	
	}



	public function view($page = 'home') 
	{
		if (! file_exists(APPPATH.'views/party/'.$page.'.php'))
			show_404();
		$data['parties'] = $this->party_model->get_parties();

		$data['title'] = ucfirst($page);
		$data['h1'] = "parties";
		$this->load->view('templates/header', $data);
		$this->load->view('party/'.$page, $data);
		$this->load->view('templates/footer', $data);

	}
	
	public function add()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = "Add a party";
		$data['h1'] = "Add a party";
		$this->form_validation->set_rules('party', 'party', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('party/add', $data);
			$this->load->view('templates/footer');
		} else {
			$insert_id = $this->party_model->add_party();
			$data['title'] = "party added";
			$data['h1'] = "party added";
			$partydata = $this->party_model->getById($insert_id);
			
			$data['partyname'] = $partydata->name;
			$data['link'] = $partydata->link;
			$this->load->view('templates/header', $data);
			$this->load->view('party/success', $data);
		}
	}
}

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
				$this->load->helper('form');
		$this->load->library('form_validation');

		$parties = $this->party_model->get_parties();
		$data['parties'] = $parties;
		$data['linkurl'] =  base_url() . "candidate/add/";

	/*	foreach ($parties as $party) 
		{	
			//$party['wholelink'] = $this->assembleLink($party['link']);
			$data['parties']['wholelink'] =  $this->assembleLink($party['link']);
		}
		//var_dump($data);
		//$data['parties'] = $parties;
		*/
		$data['title'] = "Parties and links";
		$data['h1'] = "parties";
		$this->load->view('templates/header', $data);
		$this->load->view('party/home', $data);
		
		$this->load->view('party/add');

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
			//$whole_link = base_url() . "candidate/add/" . $partydata->link;
			$data['link'] = $this->assembleLink($partydata->link);
			$this->load->view('templates/header', $data);
			$this->load->view('party/success', $data);
		}
	}
	protected function assembleLink($link)
	{
		return base_url() . "candidate/add/" . $link;
	}
		
}

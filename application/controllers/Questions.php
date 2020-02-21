<?php
class Questions extends CI_Controller {


	public function __construct() 
	{

		parent::__construct();
		$this->load->model('questions_model');
		$this->load->helper('url_helper');
	}

	public function index() 
	{
		$data['questions'] = $this->questions_model->get_questions();
	}



	public function view($page = 'home') 
	{
		if (! file_exists(APPPATH.'views/questions/'.$page.'.php'))
			show_404();
		$data['questions'] = $this->questions_model->get_questions();

		$data['title'] = ucfirst($page);
		$data['h1'] = "this is a headline";
		$this->load->view('templates/header', $data);
		$this->load->view('questions/'.$page, $data);
		$this->load->view('templates/footer', $data);

	}
}

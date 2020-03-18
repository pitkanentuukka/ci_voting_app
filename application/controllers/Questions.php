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
		
		$data['title'] = "Questions";
		$data['h1'] = "Questions";
		$this->load->view('templates/header', $data);
		$this->load->view('questions/home', $data);
		$this->load->view('templates/footer', $data);

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
	
	public function add()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = "Add a question";
		$data['h1'] = "Add a question";
		$this->form_validation->set_rules('question', 'question', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('questions/add', $data);
			$this->load->view('templates/footer');
		} else {
			$this->questions_model->add_question();
			$data['title'] = "question added";
			$this->load->view('templates/header', $data);
			$this->load->view('questions/success', $data);
		}
	}
}

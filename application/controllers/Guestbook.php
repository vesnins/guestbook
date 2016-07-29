<?php defined('BASEPATH') OR exit('No direct script access allowed');

class guestbook extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->model('Guestbook_model');
		$data['comments'] = $this->Guestbook_model->getAllComments();
		$this->load->view('guestbook/main', $data);
	}

	public function addComments()
	{
		$this->load->model('Guestbook_model');
		$this->Guestbook_model->addComments($_POST);
	}

	public function addAnswerComment()
	{
		$this->load->model('Guestbook_model');
		$this->Guestbook_model->addAnswerComment($_POST);
	}
}

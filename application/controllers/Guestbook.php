<?php defined('BASEPATH') OR exit('No direct script access allowed');

class guestbook extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$this->load->model('Guestbook_model');
		$this->Guestbook_model->getAllComments();
		$this->load->view('guestbook/main');
	}
}

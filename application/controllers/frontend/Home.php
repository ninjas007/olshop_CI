<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/home');
		$this->load->view('frontend/includes/footer');
	}

	public function get()
	{
		$this->load->model('produk_model');

		$data = $this->produk_model->getProduk();

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

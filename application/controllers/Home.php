<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('cart');

		$data['total_items'] = $this->cart->total_items();

		$this->load->view('frontend/includes/header', $data);
		$this->load->view('frontend/home');
		// $this->load->view('frontend/includes/footer');
	}
}

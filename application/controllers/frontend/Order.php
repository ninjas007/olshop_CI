<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		//Do your magic here
	}

	public function pembayaran()
	{
		$this->load->library('cart');

		echo '<pre>';
		var_dump($this->cart->contents());
	}

	
}

/* End of file Order.php */
/* Location: ./application/controllers/frontend/Order.php */
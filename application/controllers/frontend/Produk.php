<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
	}

	public function index()
	{
		$data['query'] = htmlentities($this->input->post('search'));
		$data['status'] = '';
		$data['data'] = [];
		$start = 0;

		if ($data['query'] == "")
		{
			$data['query'] = 'All Products';
			$data['data'] = $this->produk_model->get_produk_by_category();
		}
		else
		{
			$result = $this->produk_model->get_produk_by_category($data['query'], $start);

			if (count($result) <= 0)
			{
				$data['status'] = 404;
			}
			else
			{
				$data['status'] = 200;
				$data['data'] = $result;
			}
		}

		$this->load->library('cart');

		$total['total_items'] = $this->cart->total_items();
		$page['title'] = 'Produk';

		$this->load->view('frontend/__main/header', $page);
		$this->load->view('frontend/__header/produk', $page);
		$this->load->view('frontend/__main/navbar', $total);
		$this->load->view('frontend/produk', $data);
		$this->load->view('frontend/__footer/produk');
		$this->load->view('frontend/__main/footer');
	}
}

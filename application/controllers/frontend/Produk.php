<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
	}
	
	public function cart()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/cart');
	}

	public function add_to_cart()
	{
		$data = [
            'id' => $this->input->post('id'), 
            'name' => $this->input->post('nama'), 
            'price' => $this->input->post('harga'), 
            'qty' => $this->input->post('qty'),
            'image' => $this->input->post('gambar'), 
        ];

		$this->cart->insert($data);
		$this->show_cart();
	}

	public function show_cart()
	{
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$output .= '
				<tr>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="remove-cart btn btn-danger btn-sm">Cancel</td>
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">Rp. '.number_format($this->cart->total()).'</th>
			</tr>
		';

		return $output;
	}

	public function load_cart()
	{
		echo $this->show_cart();
	}

}

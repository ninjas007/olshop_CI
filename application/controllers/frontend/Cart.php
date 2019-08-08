<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller { 

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}

	public function index()
	{
		$data['load'] = $this->view();
		$total['total_items'] = $this->cart->total_items();
		$page['title'] = 'Cart';

		$this->load->view('frontend/__main/header', $page);
		$this->load->view('frontend/__header/cart', $page);
		$this->load->view('frontend/__main/navbar', $total);
		$this->load->view('frontend/cart', $data);
		$this->load->view('frontend/__footer/cart');
		$this->load->view('frontend/__main/footer');
	}

	public function add_to_cart()
	{
		$item = [
			'id' => $this->input->post('id_produk'),
			'qty' => $this->input->post('qty'),
			'price' => $this->input->post('price'), // masih dikeranjang
			'name' => $this->input->post('name'),
			'options' => [
				'unit_id' => $this->input->post('id_unit'),
			]
		];

		$this->cart->insert($item);

		echo $this->cart->total_items();
	}

	public function view()
	{
		$output = '';
		
		// table head
		$output .= '
			<thead>
			  <tr>
			    <th width="10">No</th>
			    <th>Nama Produk</th>
			    <th>Satuan</th>
			    <th width="70">Qty</th>
			    <th>Total</th>
			    <th align="right">Batal</th>
			  </tr>
			</thead>
			<tbody>
		';

		// data cart
		$no = 1;
		foreach ($this->cart->contents() as $items) {
			$output .= '
				<tr>
					<td>'.$no++.'</td>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal']).'</td>
					<td>
						<button type="button" id="'.$items['rowid'].'" class="remove-cart btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
					</td>
				</tr>
			';
		}

		// total harga
		$output .= '
			<tr>
				<th colspan="3">Total Harga</th>
				<th colspan="3">Rp. '.number_format($this->cart->total()).'</th>
			</tr>
		';

		// tutup table body
		$output .= '</tbody>';
		
		

		$output .= '
			<tfoot>
				<tr>
					<td colspan="6"><button type="submit" class="btn btn-primary btn-sm float-right" >Proses Pembayaran</button></td>
				</tr>
			</tfoot>
		';

		// jika cart kosong
		if (count($this->cart->contents()) <= 0) {
			$output = '
				<tr>
					<td colspan="6" align="center">Cart is Empty</td>
				</tr>
			';
		}

		return $output;
	}

	public function total_cart()
	{
		return $this->cart->total();
	}

	public function delete()
	{
		$data['status'] = '';

		if ($this->cart->remove($this->input->post('id_row')))
		{
			$data['status'] = 200;
		}
		else
		{
			$data['status'] = 404;
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

}
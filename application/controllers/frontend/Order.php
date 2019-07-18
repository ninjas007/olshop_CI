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

		$items = $this->cart->contents();


		$namaCustomer = $this->input->post('nama');
		$alamatCustomer = $this->input->post('alamat');
		$nohpCustomer = $this->input->post('nohp');
		$bankCustomer = $this->input->post('bank');
		$kurirCustomer = $this->input->post('kurir');

		$codeOrder = date('Y:m:d:H:i:s');

		$dataPembayaran = [
			'code_order' => $codeOrder,
			'tgl_order' => date('Y-m-d H:i:s'),
			'total' => $this->cart->total(),
			'kurir' => $this->input->post('kurir'),
			'bank' => $this->input->post('bank'),
		];

		$tambahTblDetail = $this->order_model->tambahDetailOrder($dataPembayaran);

		if ($tambahTblDetail > 0)
		{
			$dataOrder = [];
			foreach ($this->cart->contents() as $items)
			{
				array_push($dataOrder, [
					'produk_id' => $items['id'],
					'unit_id' => $items['options']['unit_id'],
					'qty' => $items['qty'],
					'status' => 1,
					'user_id' => $items['options']['user_id'],
					'code_order_id' => $codeOrder
				]);
			}

			if ($this->order_model->tambahOrder($dataOrder) > 0)
			{
				$this->cart->remove($this->input->post('id_row'));		
			}

		}




	}

	
}

/* End of file Order.php */
/* Location: ./application/controllers/frontend/Order.php */
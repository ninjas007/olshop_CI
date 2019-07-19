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

		$data['message'] = '';
		$data['status'] = 200;


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

			foreach ($items as $item)
			{
				array_push($dataOrder, [
					'produk_id' => $item['id'],
					'unit_id' => $item['options']['unit_id'],
					'qty' => $item['qty'],
					'status' => 1,
					'user_id' => $item['options']['user_id'],
					'code_order_id' => $codeOrder
				]);
			}

			if ($this->order_model->tambahOrder($dataOrder) > 0)
			{
				foreach ($this->cart->contents() as $value)
				{
					$resultHapusCart = $this->cart->remove($value['rowid']);
				}

				if ($resultHapusCart == true)
				{
					$data['message'] = 'Berhasil, silahkan selesaikan transaksi di menu pesanan';
					$data['status'] = 200;
				}
				else
				{
					$data['message'] = 'Gagal menghapus cart, silahkan close browser dan lanjutkan transaksi di menu pesanan';
					$data['status'] = 404;
				}
			}
			else
			{
				$data['message'] = 'Gagal menambah pesanan, silahkan kontak admin';
				$data['status'] = 404;
			}

		}
		else
		{
			$data['message'] = 'Gagal menginput data pemesan, silakan kontak admin';
			$data['status'] = 404;
		}
		
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));

	}

	
}

/* End of file Order.php */
/* Location: ./application/controllers/frontend/Order.php */
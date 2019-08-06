<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'login')
		{
			redirect('login');	
		}
		$this->load->model('order_model');
		$this->load->library('cart');

	}

	public function index()
	{
		$orders = $this->order_model->ambil_data_order_user_login($this->session->userdata('id_user_login'));
		$codeOrder = $this->order_model->ambil_code_order_user_login($this->session->userdata('id_user_login'));

		$data = [];
		// $data['code'];
		foreach ($codeOrder as $key => $code)
		{
			foreach ($orders as $order)
			{
				if ($code['code_order_id'] == $order['code_order_id'])
				{
					$data['orders'][$order['code_order_id']][] = [
						'nama_produk' => $order['nama_produk'],
						'warna' => $order['warna'],
						'ukuran' => $order['ukuran'],
						'berat_produk' => $order['berat_produk'],
						'qty' => $order['qty'],
						'harga_produk' => $order['harga_produk'],
						'total' => $order['harga_produk'] * $order['qty']
					];
					
				}	
			}
		}
		$data['total_items'] = $this->cart->total_items();
		$page['title'] = 'Checkout';

		$this->load->view('frontend/log_order', $data);
	}

	public function add()
	{
		$dataOrder = [];
		$codeOrder = date('YmdHis') . $this->session->userdata('id_user_login');
		$items = $this->cart->contents();

		foreach ($items as $item)
		{
			array_push($dataOrder, [
				'produk_id' => $item['id'],
				'unit_id' => $item['options']['unit_id'],
				'qty' => $item['qty'],
				'status' => 1,
				'user_id' => $this->session->userdata('id_user_login'),
				'code_order_id' => $codeOrder
			]);
		}

		if ($this->order_model->tambah_order($dataOrder) > 0)
		{
			foreach ($items as $value)
			{
				$resultHapusCart = $this->cart->remove($value['rowid']);
			}

			if ($resultHapusCart == true)
			{
				$this->session
				->set_flashdata('alert', '<div class="alert alert-success" role="alert">Berhasil, silahkan konfirmasi pembayaran di <a href="#">menu pembayaran.</a></div>');
			}
			else
			{
				$this->session
				->set_flashdata('alert', '<div class="alert alert-warning" role="alert">Gagal menghapus cart, silahkan clear history browser dan lanjutkan transaksi di menu konfirmasi</div>');
			}
		}
		else
		{
			$this->session
			->set_flashdata('alert', '<div class="alert alert-warning" role="alert">Gagal menambah konfirmasi, silahkan kontak admin</div>');
		}
		
		redirect('order');
	}

	public function pembayaran()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required',
	        array('required' => 'You must provide a %s.')
	    );
	    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
	    $this->form_validation->set_rules('email', 'Email', 'required');

	    if ($this->form_validation->run() == FALSE)
	    {
	       $this->load->view('myform');
	    }
	    else
	    {
	        // $this->load->view('formsuccess');
			$this->load->view('frontend/pembayaran');
	    }

	}

}

/* End of file Order.php */
/* Location: ./application/controllers/frontend/Order.php */
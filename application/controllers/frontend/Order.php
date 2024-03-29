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
		$this->load->library(['cart','form_validation']);

	}

	public function index()
	{
		$orders = $this->order_model->ambil_data_order_checkout($this->session->userdata('id_user_login'));

		$data = [];
		$data['orders'] =  [];

		if (count($orders) > 0)
		{
			foreach ($orders as $order)
			{
				$data['orders'][] = [
					'id_order' => $order['id_order'],
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

		$data['total_items'] = $this->cart->total_items();
		$page['title'] = 'Checkout';

		$this->load->view('frontend/__main/header', $page);
		$this->load->view('frontend/__header/order');
		$this->load->view('frontend/order', $data);
		$this->load->view('frontend/__footer/order');
		$this->load->view('frontend/__main/footer');
	}

	public function add()
	{
		$dataOrder = [];
		$items = $this->cart->contents();

		foreach ($items as $item)
		{
			array_push($dataOrder, [
				'produk_id' => $item['id'],
				'unit_id' => $item['options']['unit_id'],
				'qty' => $item['qty'],
				'status' => 1,
				'user_id' => $this->session->userdata('id_user_login'),
				'code_order_id' => NULL
			]);
		}

		if ($this->order_model->tambah_order($dataOrder) == TRUE)
		{
			foreach ($items as $value)
			{
				$resultHapusCart = $this->cart->remove($value['rowid']);
			}

			if ($resultHapusCart == true)
			{
				$this->session
				->set_flashdata('alert', '<div class="alert alert-success" role="alert">Silahkan proses pemesanan dengan mengisi data berikut</div>');
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

	public function checkout()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
	    $this->form_validation->set_rules('nohp', 'No Hp', 'required|trim|numeric|max_length[15]|min_length[9]');
	    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
	    $this->form_validation->set_rules('kota', 'Kota', 'required');
	    $this->form_validation->set_rules('kurir', 'Kurir', 'required');
	    $this->form_validation->set_rules('layanan', 'Layanan', 'required');
	    $this->form_validation->set_rules('bank', 'Bank', 'required');

	    if ($this->form_validation->run() == FALSE)
	    {
	    	$this->index();
	    }
	    else
	    {
	    	$this->load->library('session');
	    	$codeOrder = substr($this->input->post('nohp'), 6, 8) . $this->session->userdata('id_user_login') . date('mHdis');
	    	$data = [
	    		'nama_penerima' => $this->input->post('nama'),
	    		'nohp_penerima' => $this->input->post('nohp'),
	    		'alamat_penerima' => $this->input->post('alamat'),
	    		'code_order' => $codeOrder,
	    		'tgl_order' => date('Y-m-d H:i:s'),
	    		'subtotal' => $this->session->userdata('subtotal'),
	    		'kurir' => $this->input->post('kurir') . ' ' . $this->input->post('layanan'),
	    		'ongkir' => str_replace(',', '', $this->session->userdata('ongkir')),
	    		'kodepos' => $this->input->post('kodepos'),
	    		'total' => str_replace(',', '', $this->session->userdata('total')),
	    		'bank' => $this->input->post('bank'),
	    		'bukti_transfer' => NULL,
	    		'status_transfer' => 0
	    	];

	    	if ($this->order_model->add_detail_order_and_update_order($data, $codeOrder, $this->input->post('id_order')) == TRUE)
	    	{
	    		$this->session
	    		->set_flashdata('alert', '<div class="alert alert-success" role="alert">Silahkan upload bukti transfer disini</div>');
	    		redirect('konfirmasi');
	    	}
	    	else
	    	{
	    		$this->session
	    		->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Gagal memproses, silahkan coba lagi atau hubungi admin</div>');
   				redirect('order');
	    	}
	    }
	    

	}

	public function batal()
	{
		$idOrder = $this->input->post('id_order');
		$data['message'] = '';

		if ($this->order_model->delete($idOrder) > 0)
		{
			$data['message'] = 'Berhasil membatalkan order';	
		}
		else
		{
			$data['message'] = 'Gagal membatalkan order';	
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/frontend/Order.php */
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'login')
		{
			redirect('login');	
		}
	}

	
	public function index()
	{
		$this->load->model('konfirmasi_model');

		$data['orders'] = $this->konfirmasi_model->ambil_data_order_user_login($this->session->userdata('id_user_login'));

		$data['subtotal'] = 0;

		foreach ($data['orders'] as $orders) {
			$data['subtotal'] += $orders['subtotal'];
		}

		$this->load->view('frontend/konfirmasi', $data);
	}

}

/* End of file Pesanan.php */
/* Location: ./application/controllers/frontend/Pesanan.php */

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'login')
		{
			redirect('login');	
		}

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$this->load->library('cart');

		$data['total_items'] = $this->cart->total_items();
		$page['title'] = 'Pembayaran';

		$this->load->view('frontend/includes/header', $page);
		$this->load->view('frontend/pembayaran');
	}

	public function pembayaran()
	{
		$this->load->model('order_model');

		$dataPembayaran = [
			'nama_penerima' => $this->input->post('nama'),
			'nohp_penerima' => $this->input->post('nohp'),
			'alamat_penerima' => $this->input->post('alamat'),
			'code_order' => $this->input->post('code_order'),
			'tgl_order' => date('Y-m-d H:i:s'),
			'subtotal' => $this->input->post('subtotal'),
			'kurir' => $this->input->post('kurir'),
			'ongkir' => $this->input->post('ongkir'),
			'kodepos' => $this->input->post('kodepos'),
			'total' => intval($this->input->post('subtotal')) + intval($this->input->post('ongkir')),
			'bank' => $this->input->post('bank'),
		];

		$tambahTblDetail = $this->order_model->tambah_detail_order($dataPembayaran);

		
		redirect('pembayaran');

	}
}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/frontend/Pembayaran.php */

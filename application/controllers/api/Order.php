<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'login')
		{
			redirect('login');	
		}

	}

	public function pembayaran()
	{
		$this->load->library('form_validation');
		$this->load->model('order_model');

		// rules validation
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('nohp', 'No Hp', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('bank', 'Bank', 'required|trim');
		$this->form_validation->set_rules('ongkir', 'Ongkir', 'required|trim');
		$this->form_validation->set_rules('kodepos', 'Kode Pos', 'required|trim');
		$this->form_validation->set_rules('kurir', 'Kurir', 'required|trim');

		if ($this->form_validation->run() == FALSE)
        {
            return 	$this->output
					->set_content_type('application/json')
					->set_output(json_encode(['message' => validation_errors('', '')]));
        }
        else
        {
            $subtotal = intval(str_replace('.', '', $this->input->post('subtotal')));
            $data['message'] = '';
            $dataPembayaran = [
            	'nama_penerima' => $this->input->post('nama'),
            	'nohp_penerima' => $this->input->post('nohp'),
            	'alamat_penerima' => $this->input->post('alamat'),
            	'code_order' => $this->input->post('code'),
            	'tgl_order' => date('Y-m-d H:i:s'),
            	'subtotal' => $subtotal,
            	'kurir' => $this->input->post('kurir'),
            	'ongkir' => $this->input->post('ongkir'),
            	'kodepos' => $this->input->post('kodepos'),
            	'total' => $subtotal + intval($this->input->post('ongkir')),
            	'bank' => $this->input->post('bank'),
            ];

            if ($this->order_model->tambah_detail_order($dataPembayaran) > 0)
            {
            	$data['message'] = 'Berhasil, Silahkan lakukan konfirmasi pembayaran';
            	$data['status'] = 200;
            }
            else
            {
            	$data['message'] = 'Gagal, coba ulangi atau contact admin';
            	$data['status'] = 404;
            }
            
            return 	$this->output
            		->set_content_type('application/json')
            		->set_output(json_encode($data));
        }
		
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/api/Order.php */

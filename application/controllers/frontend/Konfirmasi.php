<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('konfirmasi_model');

	}

	// List all your items
	public function index()
	{
		$this->load->model('toko_model');
		$this->load->library('cart');

		$data['detail_order'] = $this->konfirmasi_model->ambil_code_order_user_login($this->session->userdata('id_user_login'));
		$data['orders'] = $this->konfirmasi_model->ambil_data_order_invoice($this->session->userdata('id_user_login'));
		$data['toko'] = $this->toko_model->ambil_data_toko();

		$page['title'] = 'Konfirmasi Pembayaran';
		
		$this->load->view('frontend/__main/header', $page);
		$this->load->view('frontend/__header/konfirmasi', $page);
		// $this->load->view('frontend/__main/navbar', $total);
		$this->load->view('frontend/konfirmasi', $data);
		$this->load->view('frontend/__footer/konfirmasi');
		$this->load->view('frontend/__main/footer');
	}


	public function bukti_transfer()
	{
		$config['upload_path']		= './assets/img/bukti_transfer/';
        $config['allowed_types']    = 'jpeg|jpg|png';
        $config['max_size']         = 1024;
        $config['file_name']		= sha1(date('YmdHis'));	

        $this->load->library('upload', $config);
        $code_order = $this->input->post('code_order');

        if ( ! $this->upload->do_upload('image'))
        {
            $error = ['error' => $this->upload->display_errors()];
            
            $this->session
            ->set_flashdata('alert', '<div class="alert alert-danger" role="alert">' . $error['error'] . '</div>');
        }
        else
        {
            $data = ['upload_data' => $this->upload->data()];
        	$tbl_detail_order = $this->db->get_where('tbl_detail_order', ['code_order' => $code_order])->row_array();
            $result = $this->konfirmasi_model->update_foto_detail_order($data['upload_data']['file_name'], $code_order);

            if ($result > 0) 
            {
            	unlink(FCPATH.'/assets/img/bukti_transfer/'.$tbl_detail_order['bukti_transfer']);
            	$this->session
            	->set_flashdata('alert', '<div class="alert alert-success" role="alert">Berhasil mengupload bukti transfer, pesanan segera diproses</div>');
            }
            else
            {
            	$this->session
            	->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Gagal mengupload, clear browser atau hubungi admin</div>');
            }

        }
        
        redirect('konfirmasi');
	}

}

/* End of file Konfirmasi.php */
/* Location: ./application/controllers/frontend/Konfirmasi.php */

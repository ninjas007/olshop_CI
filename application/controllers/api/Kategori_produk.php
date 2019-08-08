<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function get()
	{
		$this->load->model('kategori_produk_model', 'kategori');

		$results = $this->kategori->get_kategori($this->input->get('length'));
		$totalData = count($results);
		$data = [];
		
		if ($totalData > 0) {

			foreach ($results as $category)
			{
				$data['category'][] = [
					'id_category' => $category['id_kategori'],
					'name_category' => $category['nama_kategori'],
					'img_category' => $category['img_kategori']
				];
			}
		}

		$data['total_data'] = $totalData;
		$data['category'] = array_chunk($data['category'], 4);
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

/* End of file Kategori_produk.php */
/* Location: ./application/controllers/api/Kategori_produk.php */
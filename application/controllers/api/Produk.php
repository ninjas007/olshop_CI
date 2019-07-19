<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
	}
	
	public function get()
	{

		$results = $this->produk_model->get_produk_unit();
		$data = [];
		
		foreach ($results as $product)
		{
			$data[] = [
				'product' => [
					'id_produk' => $product['id_produk'],
					'nama_produk' => $product['nama_produk'],
					'deskripsi_produk' => $product['deskripsi_produk'],
					'product_unit' => [
						'id_unit' => $product['id_unit'],
						'kode_produk' => $product['kode_produk'],
						'warna' => $product['warna'],
					],
					'product_kategori' => [
						'id_kategori' => $product['id_kategori'],
						'nama_kategori' => $product['nama_kategori'],
					]
				],
			];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_produk_limit()
	{
		$search = htmlentities($this->input->post('search'));
		$start = $this->input->post('last_id');
		$data['data'] = [];

		if ($search == 'All Products') {
			$search = '';
		}

		$result = $this->produk_model->get_produk_by_category($search, $start);
		$data['last_id'] = end($result)['id_produk'];
		$data['total_data'] = count($result);

		if (!empty($result))
		{
			$data['status'] = 200;
			$data['data'] = $result;
		}
		else
		{
			$data['status'] = 404;
			$data['data'] = 'Semua produk telah tampil';
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function detail()
	{
		$idProduk = $this->input->post('id_produk');
		$data['data'] = [];
		$data['data']['unit'] = [];
		$data['status'] = 404;

		if ($idProduk)
		{
			$results = $this->produk_model->detail_produk($idProduk);

			if (!empty($results))
			{
				foreach ($results as $produk)
				{
					$data['data']['produk'] = [
						'kategori' => [
							'id' => $produk['id_kategori'],
							'nama' => $produk['nama_kategori'] 
						],
						'produk' => [
							'id' => $produk['id_produk'],
							'nama' => $produk['nama_produk'],
							'harga' => $produk['harga_produk'],
							'berat' => $produk['berat_produk'],
							'gambar' => $produk['gambar_produk'],
							'deskripsi' => $produk['deskripsi_produk']
						],
					];

					$data['data']['unit'][] = [
						'id' => $produk['id_unit'],
						'kode' => $produk['kode_produk'],
						'warna' => $produk['warna'],
						'ukuran' => $produk['ukuran'],
						'harga' => $produk['harga'],
						'gambar' => $produk['gambar_unit']
					];
				}		
			}

			$data['status'] = 200;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

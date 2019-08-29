<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('orders_model');

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$orders = $this->orders_model->ambil_data_order();
		$output = '';

		foreach ($orders as $no => $order)
		{
			$output .= ' <tr>
                            <td>' .++$no. '<input type="hidden" value="' .$order['code_order']. '" class="code-order"></td>
                            <td><a href="#" class="text-white status-p bg-secondary" title="Detail Order" onclick="lihat_detail(' .$order['id_detail_order']. ')">' .$order['code_order']. '</a></td>
                            <td>' .$order['nama_penerima']. ' <br> ' .$order['nohp_penerima']. '</td>
                            <td>' .$order['tgl_order']. '</td>
                            <td>' .$order['total']. '</td>
                            <td>' .$this->__background_status($order['status_transfer']). '</td>
                            <td><a href="#" class="text-primary" title="Cek Pembayaran"><input type="checkbox" class="checkSingle" name="' .$order['code_order']. '" value="' .$order['status_transfer']. '"></a></td>
                            <td><a href="#" class="text-secondary" data-toggle="modal" data-target="#editOrder" title="Edit Order">
                                    	<i class="fa fa-edit"></i></a></td>
                        </tr>';
		}

		$this->output->set_content_type('application/json')->set_output($output);

	}

	// orderan lunas
	public function order_paid()
	{
		$orders = $this->orders_model->ambil_data_order_lunas();
		$output = '';

		foreach ($orders as $no => $order)
		{
			$output .= ' <tr>
                            <td>' .++$no. '</td>
                            <td><a href="#" class="text-primary status-p bg-secondary" title="Detail Order" onclick="lihat_detail(' .$order['id_detail_order']. ')" style="color: white !important">' .$order['code_order']. '</a></td>
                            <td>' .$order['nama_penerima']. ' <br> ' .$order['nohp_penerima']. '</td>
                            <td>' .$order['tgl_order']. '</td>
                            <td>' .$order['total']. '</td>
                            <td><input type="checkbox" value="' .$order['code_order']. '"></td>
                            <td><a href="#" class="text-secondary" data-toggle="modal" data-target="#editOrder" title="Edit Order">
                                    	<i class="fa fa-edit"></i></a></td>
                        </tr>';
		}

		$this->output->set_content_type('application/json')->set_output($output);

	}

	// lihat detail
	public function lihat_detail()
	{
		$data['status'] = 404;
		$order = $this->db->get_where('tbl_detail_order', ['id_detail_order' => $this->input->post('id_order')])->row_array();

		if ($order != NULL)
		{
			$data['status'] = 200;
			$data['data'] = $order;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function cek_konfirmasi()
	{
		$data['status'] = 404;
		$codeOrders = $this->input->post('code_orders');

		if ($codeOrders != NULL)
		{
			if($this->orders_model->update_status_order($codeOrders) > 0)
			{
				$data['status'] = 200;
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	// change background color status
	private function __background_status($status)
	{
		if ($status == 0)
		{
			return '<span class="status-p bg-danger">UNPAID</span>';
		}
		if ($status == 1)
		{
			return '<span class="status-p bg-primary">PROCESS</span>';
		}
		if ($status == 2)
		{
			return '<span class="status-p bg-success">PAID</span>';
		}
	}

}

/* End of file Orders.php */
/* Location: ./application/controllers/api_backend/Orders.php */
 ?>
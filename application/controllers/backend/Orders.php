<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$page['page'] = 'Orders';

		$this->load->view('backend/__main/header', $page);
		$this->load->view('backend/orders');
		$this->load->view('backend/__main/footer', $page);
	}

	public function paid()
	{
		$page['page'] = 'Order-Paid';

		$this->load->view('backend/__main/header', $page);
		$this->load->view('backend/order-paid');
		$this->load->view('backend/__main/footer', $page);
	}

	public function ubah_status_tranfser()
	{
		$this->load->model('orders_model');

		$statusTransfer = $this->input->post('status_transfer');

		if ($statusTransfer != NULL)
		{
			$result = $this->orders_model->update_status_transfer($statusTransfer, $this->input->post('code_order'));
			if ($result == TRUE)
			{
				$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">Berhasil mengubah status transfer</div>');
				redirect('orders');
			}
			else
			{
				$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Kesalahan update, silahkan refresh halaman dan ulang mengupdate</div>');
			}
		}
	}

	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Orders.php */
/* Location: ./application/controllers/backend/Orders.php */

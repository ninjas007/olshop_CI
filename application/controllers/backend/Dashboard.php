<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$page['page'] = 'Dashboard';

		$this->load->view('backend/__main/header', $page);
		$this->load->view('backend/dashboard');
		$this->load->view('backend/__main/footer', $page);
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

/* End of file Dashboard.php */
/* Location: ./application/controllers/backend/Dashboard.php */

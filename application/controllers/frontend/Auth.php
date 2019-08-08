<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('frontend/auth/login');
	}

	public function register()
	{
		if (!isset($_POST['register']))
		{
			$this->load->view('frontend/auth/register');
		} 
		else
		{
			// rules
			$this->form_validation->set_rules('username', 'Username', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]', ['is_unique' => 'Email sudah terdaftar']);
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]',['min_length' => 'Password terlalu pendek']);

			// jika ada yang tidak valid
			if ($this->form_validation->run() ==  FALSE)
			{
				$this->load->view('frontend/auth/register');
			} 
			else
			{
				$data = [
					'name' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'image' => 'default.jpg',
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'role_id' => 2,
					'is_active' => 1,
					'date_created' => time(),
				];

				$this->db->insert('tbl_user', $data);
				$this->session
				->set_flashdata('alert', '<div class="alert alert-success" role="alert">Akun berhasil dibuat! Silahkan login</div>');
				redirect('login');
			}
		}
	}

	public function process_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();
		// user already
		if ($user) {
			// user active
			if ($user['is_active'] == 1)
			{
				//check password
				if (password_verify($password, $user['password']))
				{
					// simpan data sessionnya
					$data = [
						'status' => 'login',
						'id_user_login' => $user['id_user'],
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);

					if ($user['role_id'] == 2) {
						redirect('home');
					}
				}
				else
				{	
					$this->session
					->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Password salah</div>');
					redirect('login');
				}
			}
			else
			{	
				$this->session
				->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Email belum teraktivasi</div>');
				redirect('login');
			}
		}
		else
		{
			$this->session
			->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Akun belum terdaftar</div>');
			redirect('login');
		}
	}

}

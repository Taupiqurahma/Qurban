<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('akses')=='1') {
			redirect(base_url(''));
		}elseif ($this->session->userdata('akses')=='2') {
			redirect(base_url('C_dashboard'));
		}
		$this->load->library('form_validation');		
		$this->load->model('M_login'); 
	
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('V_login');
		}else{
			//validasi
			$this->aksi_login();
		}
	}

	public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->M_login->cek_login("admin",$where)->num_rows();
		$this->session->set_userdata('masuk',TRUE);
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
			);

			$this->session->set_userdata($data_session);
			$this->session->set_userdata('akses','2');
			redirect(base_url("C_dashboard"));

		}else{
			$this->session->set_flashdata('message', '<div role="alert">password salah ! </div>');
			redirect('admin');
		}
	}

	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('admin'));
	}
}




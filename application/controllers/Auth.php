<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('loginmodel');
	}

	public function index() {
		$this->load->view('login');
	}

	public function cek_login() {
		$data = array(
				'username' => $this->input->post('username', TRUE),
				'password' => md5($this->input->post('password', TRUE))
			);

		$hasil = $this->loginmodel->cek_user($data);

		if ($hasil) {
			$sess_data['logged_in']	= 'Sudah Loggin';
			$sess_data['id']		= $hasil->id;
			$sess_data['fullname']	= $hasil->fullname;
			$sess_data['username']	= $hasil->username;
			$sess_data['level']		= $hasil->level;

			// $this->session->set_userdata($sess_data);

			$this->session->set_userdata($sess_data);
			$this->session->set_flashdata('info', 'Success');
			redirect('/');
		}
		else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('auth');
	}

}

?>

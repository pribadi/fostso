<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('usermodel');
	}

	public function search()
	{
		// Data dari model
		$data['data'] = $this->usermodel->getData()->result_array();
	
		$data['content'] = 'user/search';
		$this->load->view('layout', $data);
	}

	// public function read($id)
	// {
	// 	$data['data'] = $this->db->get_where('user', array('id' => $id))->row();

	// 	$data['content'] = 'user/read';
	// 	$this->load->view('layout', $data);
	// }

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('fullname', 'Full name', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('level', 'Level', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'user/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = date('YmdHis');

				if (!empty($_FILES['photo']['name'])) {
					$config['upload_path']          = './assets/upload/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 2048000;
					$config['max_width']            = 10240;
					$config['max_height']           = 76888;
					$config['file_name'] 			= $tanggal.'-'.$_FILES['photo']['name'];

			 
					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload('photo')){
						$data['error'] = array('error' => $this->upload->display_errors());
						$data['content'] = 'user/create';
						$this->load->view('layout', $data);
					}
				}

				$datas = array(
					'fullname'	=> $this->input->post('fullname'),
					'username'	=> $this->input->post('username'),
					'level'		=> $this->input->post('level'),
					'photo'		=> $tanggal.'-'.$_FILES['photo']['name'],
					'password'	=> md5($this->input->post('password'))
				);

				$query = $this->usermodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('user/search');
				}
			}
		}
		else
		{
			$data['content'] = 'user/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idUser)
	{
		$id = $idUser;

		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('fullname', 'Full name', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('level', 'Level', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('user', array('id' => $id))->row();

				$data['content'] = 'user/update';
				$this->load->view('layout', $data);
			}
			else
			{
				if (!empty($_FILES['photo']['name'])) {
					$tanggal = date('YmdHis');
					$namaFoto = $tanggal.'-'.$_FILES['photo']['name'];
				} else {
					$cariFoto = $this->db->select('*')->where('id = '.$id)->get('user')->result_array();
					$namaFoto = $cariFoto[0]['photo']; 
				}


				if (!empty($_FILES['photo']['name'])) {
					$config['upload_path']          = './assets/upload/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 2048000;
					$config['max_width']            = 10240;
					$config['max_height']           = 76888;
					$config['file_name'] 			= $namaFoto;

					$this->load->library('upload', $config);

					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload('photo')){

						$data['error'] = array('error' => $this->upload->display_errors());

						$data['content'] = 'user/update/'.$id;
						$this->load->view('layout', $data);
						// redirect('user/read/'.$id);
					}
				}

				$datas = array(
					'fullname'	=> $this->input->post('fullname'),
					'username'	=> $this->input->post('username'),
					'level'		=> $this->input->post('level'),
					'photo'		=> $namaFoto,
					'password'	=> md5($this->input->post('password'))
				);

				// melempar data ke model
				$this->usermodel->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('user/update/'.$id);
				} else {
					$this->session->set_flashdata('info', 'Success');
					redirect('user/update/'.$id);
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('user', array('id' => $id))->row();

			$data['content'] = 'user/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idUser)
	{
		$id = $idUser;
		$this->usermodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('user/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('user/search');	
		}
	}
}

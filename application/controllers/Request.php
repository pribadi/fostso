<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('requestmodel');
	}

	public function index()
	{
		// Data dari model
		$data['data'] = $this->requestmodel->getData()->result_array();
	
		$data['content'] = 'request/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		// dd($this->input->post());

		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('subject', 'Subject', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'request/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$pic 	= "Admin Ganteng";
				$status = "Pending";

				$datas = array(
    					'pic'			=> $pic,
    					'subject'		=> $this->input->post('subject'),
    					'description'	=> $this->input->post('description'),
    					'status'		=> $status
					);

				$query = $this->requestmodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('request');
				}
			}
		}
		else
		{
			$data['content'] = 'request/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idRequest)
	{
		// dd($this->input->post());	
		$id = $idRequest;

		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('subject', 'Subject', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('request', array('id' => $id))->row();

				$data['content'] = 'request/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$pic 	= "Admin Ganteng";

				$datas = array(
    					'pic'			=> $pic,
    					'subject'		=> $this->input->post('subject'),
    					'description'	=> $this->input->post('description'),
    					'status'		=> $this->input->post('status')
					);

				// melempar data ke model
				$this->requestmodel->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('request');
				}
				else 
				{
					redirect('request');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('request', array('id' => $id))->row();

			$data['content'] = 'request/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idRequest)
	{
		$id = $idRequest;
		$this->requestmodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('request');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('request');	
		}
	}
}

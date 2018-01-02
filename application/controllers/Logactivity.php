<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logactivity extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('logactivitymodel');
	}

	public function search()
	{
		// Data dari model
		$data['data'] = $this->logactivitymodel->getData()->result_array();
	
		// $data['content'] = 'logactivity/search';
		$this->load->view('logactivity/search', $data);
	}

	public function create()
	{
		// dd($this->input->post());
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_log', 'Date', 'trim|required');
			$this->form_validation->set_rules('time_log', 'Time', 'trim|required');
			$this->form_validation->set_rules('activity', 'Activity', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'logactivity/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_log').' '.$this->input->post('time_log');
				$datetimeLog = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_log'	=> $datetimeLog->format('Y-m-d H:i'),
    					'activity'		=> $this->input->post('activity'),
    					'issue'			=> $this->input->post('issue'),
    					'remark'		=> $this->input->post('remark')
					);

				$query = $this->logactivitymodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('logactivity/search');
				}
			}
		}
		else
		{
			$data['content'] = 'logactivity/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idLog)
	{
		// dd($this->input->post());
		$id = $idLog;


		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_log', 'Date', 'trim|required');
			$this->form_validation->set_rules('time_log', 'Time', 'trim|required');
			$this->form_validation->set_rules('activity', 'Activity', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('logactivity', array('id' => $id))->row();

				$data['content'] = 'logactivity/update';
				$this->load->view('layout', $data);
			}
			else
			{
				// Change date format
				$tanggal = $this->input->post('date_log').' '.$this->input->post('time_log');
				$datetimeLog = DateTime::createFromFormat('d/m/Y H:i', $tanggal);
				
				$datas = array(
						'datetime_log'	=> $datetimeLog->format('Y-m-d H:i'),
    					'activity'		=> $this->input->post('activity'),
    					'issue'			=> $this->input->post('issue'),
    					'remark'		=> $this->input->post('remark')
					);

				// melempar data ke model
				$this->logactivitymodel->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('logactivity/search');
				}
				else 
				{
					redirect('logactivity/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('logactivity', array('id' => $id))->row();

			$data['content'] = 'logactivity/update';
			$this->load->view('layout', $data);
		}
	}

	public function delete($idLog)
	{
		$id = $idLog;
		$this->logactivitymodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('logactivity/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('logactivity/search');	
		}
	}

	
}

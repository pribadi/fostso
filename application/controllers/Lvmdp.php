<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lvmdp extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('lvmdpmodel');
	}

	public function search()
	{
		$month = date('n');
		$year = date('Y');
		if ($this->input->post()) {
			$month = $this->input->post('month');
			$year = $this->input->post('year');
		}

		// Data dari model
		$data['data'] = $this->lvmdpmodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		$data['content'] = 'lvmdp/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_lvmdp', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_lvmdp', 'Time', 'trim|required');
			$this->form_validation->set_rules('rs', 'RS', 'trim|required');
			$this->form_validation->set_rules('st', 'ST', 'trim|required');
			$this->form_validation->set_rules('tr', 'TR', 'trim|required');
			$this->form_validation->set_rules('rn', 'RN', 'trim|required');
			$this->form_validation->set_rules('sn', 'SN', 'trim|required');
			$this->form_validation->set_rules('tn', 'TN', 'trim|required');
			$this->form_validation->set_rules('r', 'R', 'trim|required');
			$this->form_validation->set_rules('s', 'S', 'trim|required');
			$this->form_validation->set_rules('t', 'T', 'trim|required');
			$this->form_validation->set_rules('freq', 'freq', 'trim|required');
			$this->form_validation->set_rules('kva', 'kva', 'trim|required');
			$this->form_validation->set_rules('pf', 'pf', 'trim|required');
			$this->form_validation->set_rules('remark', 'remark', 'trim');
			$this->form_validation->set_rules('fs_name', 'fs_name', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'lvmdp/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_lvmdp').' '.$this->input->post('time_lvmdp');
				$datetimeLvmdp = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_lvmdp'=> $datetimeLvmdp->format('Y-m-d H:i'),
    					'shift'			=> $this->input->post('shift'),
    					'rs'			=> $this->input->post('rs'),
    					'st'			=> $this->input->post('st'),
    					'tr'			=> $this->input->post('tr'),
    					'rn'			=> $this->input->post('rn'),
    					'sn'			=> $this->input->post('sn'),
    					'tn'			=> $this->input->post('tn'),
    					'r'				=> $this->input->post('r'),
    					's'				=> $this->input->post('s'),
    					't'				=> $this->input->post('t'),
    					'freq'			=> $this->input->post('freq'),
    					'kva'			=> $this->input->post('kva'),
    					'pf'			=> $this->input->post('pf'),
    					'remark'		=> $this->input->post('remark'),
    					'fs_name'		=> $this->input->post('fs_name')
					);

				$query = $this->lvmdpmodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('lvmdp/search');
				}
			}
		}
		else
		{
			$data['content'] = 'lvmdp/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idLvmdp)
	{
		$id = $idLvmdp;


		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_lvmdp', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_lvmdp', 'Time', 'trim|required');
			$this->form_validation->set_rules('rs', 'RS', 'trim|required');
			$this->form_validation->set_rules('st', 'ST', 'trim|required');
			$this->form_validation->set_rules('tr', 'TR', 'trim|required');
			$this->form_validation->set_rules('rn', 'RN', 'trim|required');
			$this->form_validation->set_rules('sn', 'SN', 'trim|required');
			$this->form_validation->set_rules('tn', 'TN', 'trim|required');
			$this->form_validation->set_rules('r', 'R', 'trim|required');
			$this->form_validation->set_rules('s', 'S', 'trim|required');
			$this->form_validation->set_rules('t', 'T', 'trim|required');
			$this->form_validation->set_rules('freq', 'freq', 'trim|required');
			$this->form_validation->set_rules('kva', 'kva', 'trim|required');
			$this->form_validation->set_rules('pf', 'pf', 'trim|required');
			$this->form_validation->set_rules('remark', 'remark', 'trim');
			$this->form_validation->set_rules('fs_name', 'fs_name', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('lvmdp', array('id' => $id))->row();

				$data['content'] = 'lvmdp/update';
				$this->load->view('layout', $data);
			}
			else
			{
				// Change date format
				$tanggal = $this->input->post('date_lvmdp').' '.$this->input->post('time_lvmdp');
				$datetimeLvmdp = DateTime::createFromFormat('d/m/Y H:i', $tanggal);
				
				$datas = array(
						'datetime_lvmdp'=> $datetimeLvmdp->format('Y-m-d H:i'),
    					'shift'			=> $this->input->post('shift'),
    					'rs'			=> $this->input->post('rs'),
    					'st'			=> $this->input->post('st'),
    					'tr'			=> $this->input->post('tr'),
    					'rn'			=> $this->input->post('rn'),
    					'sn'			=> $this->input->post('sn'),
    					'tn'			=> $this->input->post('tn'),
    					'r'				=> $this->input->post('r'),
    					's'				=> $this->input->post('s'),
    					't'				=> $this->input->post('t'),
    					'freq'			=> $this->input->post('freq'),
    					'kva'			=> $this->input->post('kva'),
    					'pf'			=> $this->input->post('pf'),
    					'remark'		=> $this->input->post('remark'),
    					'fs_name'		=> $this->input->post('fs_name')
					);

				// melempar data ke model
				$this->lvmdpmodel->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('lvmdp/search');
				}
				else 
				{
					redirect('lvmdp/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('lvmdp', array('id' => $id))->row();

			$data['content'] = 'lvmdp/update';
			$this->load->view('layout', $data);
		}
	}

	public function delete($idLvmdp)
	{
		$id = $idLvmdp;
		$this->lvmdpmodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('lvmdp/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('lvmdp/search');	
		}
	}
}

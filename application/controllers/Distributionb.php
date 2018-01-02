<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributionb extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('distributionbmodel');
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
		$data['data'] = $this->distributionbmodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		// dd($data);
		$data['content'] = 'distributionb/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{

		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_distributionb', 'Date', 'trim|required');
			$this->form_validation->set_rules('time_distributionb', 'Time', 'trim|required');

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
				$data['content'] = 'distributionb/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_distributionb').' '.$this->input->post('time_distributionb');
				$datetimeDistributionb = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_distributionb'	=> $datetimeDistributionb->format('Y-m-d H:i'),
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

				$query = $this->distributionbmodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('distributionb/search');
				}
			}
		}
		else
		{
			$data['content'] = 'distributionb/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idDistributionb)
	{
		$id = $idDistributionb;


		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_distributionb', 'Date', 'trim|required');
			$this->form_validation->set_rules('time_distributionb', 'Time', 'trim|required');

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
				$data['editdata'] = $this->db->get_where('distributionb', array('id' => $id))->row();

				$data['content'] = 'distributionb/update';
				$this->load->view('layout', $data);
			}
			else
			{
				// Change date format
				$tanggal = $this->input->post('date_distributionb').' '.$this->input->post('time_distributionb');
				$datetimeDistributionb = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_distributionb'=> $datetimeDistributionb->format('Y-m-d H:i'),
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
				$this->distributionbmodel->update($id,$datas);

				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('distributionb/search');
				}
				else 
				{
					$this->session->set_flashdata('info', 'Failed');
					redirect('distributionb/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('distributionb', array('id' => $id))->row();

			$data['content'] = 'distributionb/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idDistributionb)
	{
		$id = $idDistributionb;
		$this->distributionbmodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('distributionb/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('distributionb/search');	
		}
	}
}

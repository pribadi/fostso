<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upsa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('upsamodel');
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
		$data['data'] = $this->upsamodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		$data['content'] = 'upsa/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_upsa', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_upsa', 'Time', 'trim|required');
			$this->form_validation->set_rules('rs', 'RS', 'trim|required');
			$this->form_validation->set_rules('st', 'ST', 'trim|required');
			$this->form_validation->set_rules('tr', 'TR', 'trim|required');
			$this->form_validation->set_rules('freq', 'freq', 'trim|required');
			$this->form_validation->set_rules('current_amp_r', 'Current Amp R', 'trim|required');
			$this->form_validation->set_rules('current_amp_s', 'Current Amp S', 'trim|required');
			$this->form_validation->set_rules('current_amp_t', 'Current Amp T', 'trim|required');
			$this->form_validation->set_rules('current_persen_r', 'Current % R', 'trim|required');
			$this->form_validation->set_rules('current_persen_s', 'Current % S', 'trim|required');
			$this->form_validation->set_rules('current_persen_t', 'Current % T', 'trim|required');
			$this->form_validation->set_rules('load_kva', 'Load KVA', 'trim|required');
			$this->form_validation->set_rules('load_persen', 'Load %', 'trim|required');
			$this->form_validation->set_rules('auto_minutes', 'Auto (Min)', 'trim|required');
			$this->form_validation->set_rules('battery', 'Battery', 'trim|required');
			$this->form_validation->set_rules('remark', 'remark', 'trim');
			$this->form_validation->set_rules('fs_name', 'fs_name', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'upsa/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_upsa').' '.$this->input->post('time_upsa');
				$datetimeUpsa = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_upsa'		=> $datetimeUpsa->format('Y-m-d H:i'),
    					'shift'				=> $this->input->post('shift'),
    					'rs'				=> $this->input->post('rs'),
    					'st'				=> $this->input->post('st'),
    					'tr'				=> $this->input->post('tr'),
    					'freq'				=> $this->input->post('freq'),
    					'current_amp_r'		=> $this->input->post('current_amp_r'),
    					'current_amp_s'		=> $this->input->post('current_amp_s'),
    					'current_amp_t'		=> $this->input->post('current_amp_t'),
    					'current_persen_r'	=> $this->input->post('current_persen_r'),
    					'current_persen_s'	=> $this->input->post('current_persen_s'),
    					'current_persen_t'	=> $this->input->post('current_persen_t'),
    					'load_kva'			=> $this->input->post('load_kva'),
    					'load_persen'		=> $this->input->post('load_persen'),
    					'auto_minutes'		=> $this->input->post('auto_minutes'),
    					'battery'			=> $this->input->post('battery'),
    					'remark'			=> $this->input->post('remark'),
    					'fs_name'			=> $this->input->post('fs_name')
					);

				$query = $this->upsamodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('upsa/search');
				}
			}
		}
		else
		{
			$data['content'] = 'upsa/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idUpsa)
	{
		$id = $idUpsa;


		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_upsa', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_upsa', 'Time', 'trim|required');
			$this->form_validation->set_rules('rs', 'RS', 'trim|required');
			$this->form_validation->set_rules('st', 'ST', 'trim|required');
			$this->form_validation->set_rules('tr', 'TR', 'trim|required');
			$this->form_validation->set_rules('freq', 'freq', 'trim|required');
			$this->form_validation->set_rules('current_amp_r', 'Current Amp R', 'trim|required');
			$this->form_validation->set_rules('current_amp_s', 'Current Amp S', 'trim|required');
			$this->form_validation->set_rules('current_amp_t', 'Current Amp T', 'trim|required');
			$this->form_validation->set_rules('current_persen_r', 'Current % R', 'trim|required');
			$this->form_validation->set_rules('current_persen_s', 'Current % S', 'trim|required');
			$this->form_validation->set_rules('current_persen_t', 'Current % T', 'trim|required');
			$this->form_validation->set_rules('load_kva', 'Load KVA', 'trim|required');
			$this->form_validation->set_rules('load_persen', 'Load %', 'trim|required');
			$this->form_validation->set_rules('auto_minutes', 'Auto (Min)', 'trim|required');
			$this->form_validation->set_rules('battery', 'Battery', 'trim|required');
			$this->form_validation->set_rules('remark', 'remark', 'trim');
			$this->form_validation->set_rules('fs_name', 'fs_name', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('upsa', array('id' => $id))->row();

				$data['content'] = 'upsa/update';
				$this->load->view('layout', $data);
			}
			else
			{
				// Change date format
				$tanggal = $this->input->post('date_upsa').' '.$this->input->post('time_upsa');
				$datetimeUpsa = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_upsa'		=> $datetimeUpsa->format('Y-m-d H:i'),
    					'shift'				=> $this->input->post('shift'),
    					'rs'				=> $this->input->post('rs'),
    					'st'				=> $this->input->post('st'),
    					'tr'				=> $this->input->post('tr'),
    					'freq'				=> $this->input->post('freq'),
    					'current_amp_r'		=> $this->input->post('current_amp_r'),
    					'current_amp_s'		=> $this->input->post('current_amp_s'),
    					'current_amp_t'		=> $this->input->post('current_amp_t'),
    					'current_persen_r'	=> $this->input->post('current_persen_r'),
    					'current_persen_s'	=> $this->input->post('current_persen_s'),
    					'current_persen_t'	=> $this->input->post('current_persen_t'),
    					'load_kva'			=> $this->input->post('load_kva'),
    					'load_persen'		=> $this->input->post('load_persen'),
    					'auto_minutes'		=> $this->input->post('auto_minutes'),
    					'battery'			=> $this->input->post('battery'),
    					'remark'			=> $this->input->post('remark'),
    					'fs_name'			=> $this->input->post('fs_name')
					);

				// melempar data ke model
				$this->upsamodel->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('upsa/search');
				}
				else 
				{
					redirect('upsa/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('upsa', array('id' => $id))->row();

			$data['content'] = 'upsa/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idUpsa)
	{
		$id = $idUpsa;
		$this->upsamodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('upsa/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('upsa/search');	
		}
	}
}

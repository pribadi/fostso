<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genset extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('gensetmodel');
	}

	public function search()
	{
		$month = date('n');
		$year = date('Y');
		if ($this->input->post()) {
			$month = $this->input->post('month');
			$year = $this->input->post('year');
		}

		// // Data dari model
		$data['data'] = $this->gensetmodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		$data['content'] = 'genset/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			// Validasi
			$this->form_validation->set_rules('date_genset', 'Date', 'trim|required');
			$this->form_validation->set_rules('time_genset', 'Time', 'trim|required');
			$this->form_validation->set_rules('start', 'Start', 'trim|required');
			$this->form_validation->set_rules('runtime_hour', 'Hour', 'trim|required');
			$this->form_validation->set_rules('runtime_minute', 'Minute', 'trim|required');
			$this->form_validation->set_rules('battery_voltage', 'Battery Voltage', 'trim|required');
			$this->form_validation->set_rules('solar_harian', 'Solar Harian', 'trim|required');
			$this->form_validation->set_rules('solar_cadangan', 'Solar Cadangan', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'genset/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_genset').' '.$this->input->post('time_genset');
				$datetimeGenset = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$engine_runtime = $this->input->post('hour').' H '.$this->input->post('minute').' m';

				$datas = array(
						'datetime_genset'	=> $datetimeGenset->format('Y-m-d H:i'),
    					'start'				=> $this->input->post('start'),
    					'runtime_hour'		=> $this->input->post('runtime_hour'),
    					'runtime_minute'	=> $this->input->post('runtime_minute'),
    					'battery_voltage'	=> $this->input->post('battery_voltage'),
    					'solar_harian'		=> $this->input->post('solar_harian'),
    					'solar_cadangan'	=> $this->input->post('solar_cadangan'),
    					'remark'			=> $this->input->post('remark')
					);

				$query = $this->gensetmodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('genset/search');
				}
			}
		}
		else
		{
			$data['content'] = 'genset/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idGenset)
	{
		$id = $idGenset;

		if ($this->input->post()) 
		{
			// Validasi
			$this->form_validation->set_rules('date_genset', 'Date', 'trim|required');
			$this->form_validation->set_rules('time_genset', 'Time', 'trim|required');
			$this->form_validation->set_rules('start', 'Start', 'trim|required');
			$this->form_validation->set_rules('runtime_hour', 'Hour', 'trim|required');
			$this->form_validation->set_rules('runtime_minute', 'Minute', 'trim|required');
			$this->form_validation->set_rules('battery_voltage', 'Battery Voltage', 'trim|required');
			$this->form_validation->set_rules('solar_harian', 'Solar Harian', 'trim|required');
			$this->form_validation->set_rules('solar_cadangan', 'Solar Cadangan', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('genset', array('id' => $id))->row();

				$data['content'] = 'genset/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$tanggal = $this->input->post('date_genset').' '.$this->input->post('time_genset');
				$datetimeGenset = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_genset'	=> $datetimeGenset->format('Y-m-d H:i'),
    					'start'				=> $this->input->post('start'),
    					'runtime_hour'		=> $this->input->post('runtime_hour'),
    					'runtime_minute'	=> $this->input->post('runtime_minute'),
    					'battery_voltage'	=> $this->input->post('battery_voltage'),
    					'solar_harian'		=> $this->input->post('solar_harian'),
    					'solar_cadangan'	=> $this->input->post('solar_cadangan'),
    					'remark'			=> $this->input->post('remark')
					);

				// melempar data ke model
				$this->gensetmodel->update($id,$datas);

				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('genset/search');
				}
				else 
				{
					redirect('genset/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('genset', array('id' => $id))->row();

			$data['content'] = 'genset/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idGenset)
	{
		$id = $idGenset;
		$this->gensetmodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('genset/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('genset/search');	
		}
	}
}

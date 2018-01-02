<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Wiring extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('wiringmodel');
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
		$data['data'] = $this->wiringmodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		// dd($data);
		$data['content'] = 'wiring/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post())
		{
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			// $this->form_validation->set_rules('date_wiring', 'Date', 'trim|required');
			// $this->form_validation->set_rules('time_wiring', 'Time', 'trim|required');
			$this->form_validation->set_rules('floor', 'Floor', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE)
			{
				$data['content'] = 'wiring/create';
				$this->load->view('layout', $data);
			}
			else
			{
				// $bulan  = date('m');
				// $year   = date('Y');
				$datetimeWiring  = date('Y-m-d H:i');

				// $tanggal = $this->input->post('date_wiring').' '.$this->input->post('time_wiring');
				// $datetimeWiring = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
					'shift'						=> $this->input->post('shift'),
					'datetime_wiring'	=> $datetimeWiring,
					'floor'						=> $this->input->post('floor'),
					'cooling'					=> $this->input->post('cooling'),
					'status'					=> $this->input->post('status'),
					'temperature'			=> $this->input->post('temperature'),
					'ping'						=> $this->input->post('ping'),
					'downlink'				=> $this->input->post('downlink'),
					'uplink'					=> $this->input->post('uplink'),
					'hardware_condition'=> $this->input->post('hardware_condition'),
					'remark'					=> $this->input->post('remark'),
				);

				$query = $this->wiringmodel->insert($datas);

				if ($query)
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('wiring/search');
				}
			}
		}
		else
		{
			$data['content'] = 'wiring/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idwiring)
	{
		$id = $idwiring;

		if ($this->input->post())
		{
			// validasi
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			// $this->form_validation->set_rules('date_wiring', 'Date', 'trim|required');
			// $this->form_validation->set_rules('time_wiring', 'Time', 'trim|required');
			$this->form_validation->set_rules('floor', 'Floor', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE)
			{
				$data['editdata'] = $this->db->get_where('wiring', array('id' => $id))->row();

				$data['content'] = 'wiring/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$datetimeWiring  = date('Y-m-d H:i');

				// $tanggal = $this->input->post('date_wiring').' '.$this->input->post('time_wiring');
				// $datetimeWiring = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
					'shift'				=> $this->input->post('shift'),
					'datetime_wiring'	=> $datetimeWiring,
					'floor'				=> $this->input->post('floor'),
					'cooling'			=> $this->input->post('cooling'),
					'status'			=> $this->input->post('status'),
					'temperature'		=> $this->input->post('temperature'),
					'ping'				=> $this->input->post('ping'),
					'downlink'			=> $this->input->post('downlink'),
					'uplink'			=> $this->input->post('uplink'),
					'hardware_condition'=> $this->input->post('hardware_condition'),
					'remark'			=> $this->input->post('remark'),
				);

				// melempar data ke model
				$this->wiringmodel->update($id,$datas);

				if ($this->db->affected_rows())
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('wiring/search');
				}
				else
				{
					$this->session->set_flashdata('info', 'Failed');
					redirect('wiring/search');
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('wiring', array('id' => $id))->row();

			$data['content'] = 'wiring/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idwiring)
	{
		$id = $idwiring;
		$this->wiringmodel->delete($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('wiring/search');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('wiring/search');
		}
	}
}

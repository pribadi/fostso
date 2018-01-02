<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Batteryacrac2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('batteryacrac2model');
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
		$data['data'] = $this->batteryacrac2model->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		// dd($data);
		$data['content'] = 'batteryacrac2/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_batteryacrac2', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_batteryacrac2', 'Time', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');
			$this->form_validation->set_rules('humidity', 'Humidity', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'batteryacrac2/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_batteryacrac2').' '.$this->input->post('time_batteryacrac2');
				$datetimeBatteryacrac2 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_batteryacrac2'=> $datetimeBatteryacrac2->format('Y-m-d H:i'),
						'shift'			=> $this->input->post('shift'),
    					'temperature'			=> $this->input->post('temperature'),
    					'humidity'				=> $this->input->post('humidity'),
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				$query = $this->batteryacrac2model->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('batteryacrac2/search');
				}
			}
		}
		else
		{
			$data['content'] = 'batteryacrac2/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idbatteryacrac2)
	{
		$id = $idbatteryacrac2;

		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_batteryacrac2', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_batteryacrac2', 'Time', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');
			$this->form_validation->set_rules('humidity', 'Humidity', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('batteryacrac2', array('id' => $id))->row();

				$data['content'] = 'batteryacrac2/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$tanggal = $this->input->post('date_batteryacrac2').' '.$this->input->post('time_batteryacrac2');
				$datetimeBatteryacrac2 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_batteryacrac2'=> $datetimeBatteryacrac2->format('Y-m-d H:i'),
						'shift'			=> $this->input->post('shift'),
    					'temperature'			=> $this->input->post('temperature'),
    					'humidity'				=> $this->input->post('humidity'),
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				// melempar data ke model
				$this->batteryacrac2model->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('batteryacrac2/search');
				}
				else 
				{
					redirect('batteryacrac2/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('batteryacrac2', array('id' => $id))->row();

			$data['content'] = 'batteryacrac2/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idbatteryacrac2)
	{
		$id = $idbatteryacrac2;
		$this->batteryacrac2model->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('batteryacrac2/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('batteryacrac2/search');	
		}
	}
}

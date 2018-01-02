<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Batterybcrac1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('batterybcrac1model');
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
		$data['data'] = $this->batterybcrac1model->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		// dd($data);
		$data['content'] = 'batterybcrac1/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_batterybcrac1', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_batterybcrac1', 'Time', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');
			$this->form_validation->set_rules('humidity', 'Humidity', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'batterybcrac1/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_batterybcrac1').' '.$this->input->post('time_batterybcrac1');
				$datetimeBatterybcrac1 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_batterybcrac1'=> $datetimeBatterybcrac1->format('Y-m-d H:i'),
						'shift'			=> $this->input->post('shift'),
    					'temperature'			=> $this->input->post('temperature'),
    					'humidity'				=> $this->input->post('humidity'),
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				$query = $this->batterybcrac1model->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('batterybcrac1/search');
				}
			}
		}
		else
		{
			$data['content'] = 'batterybcrac1/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idbatterybcrac1)
	{
		$id = $idbatterybcrac1;

		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_batterybcrac1', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_batterybcrac1', 'Time', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');
			$this->form_validation->set_rules('humidity', 'Humidity', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('batterybcrac1', array('id' => $id))->row();

				$data['content'] = 'batterybcrac1/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$tanggal = $this->input->post('date_batterybcrac1').' '.$this->input->post('time_batterybcrac1');
				$datetimeBatterybcrac1 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_batterybcrac1'=> $datetimeBatterybcrac1->format('Y-m-d H:i'),
						'shift'			=> $this->input->post('shift'),
    					'temperature'			=> $this->input->post('temperature'),
    					'humidity'				=> $this->input->post('humidity'),
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				// melempar data ke model
				$this->batterybcrac1model->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('batterybcrac1/search');
				}
				else 
				{
					redirect('batterybcrac1/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('batterybcrac1', array('id' => $id))->row();

			$data['content'] = 'batterybcrac1/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idbatterybcrac1)
	{
		$id = $idbatterybcrac1;
		$this->batterybcrac1model->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('batterybcrac1/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('batterybcrac1/search');	
		}
	}
}

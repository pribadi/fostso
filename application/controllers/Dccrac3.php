<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dccrac3 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('dccrac3model');
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
		$data['data'] = $this->dccrac3model->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		// dd($data);
		$data['content'] = 'dccrac3/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post())
		{
			$this->form_validation->set_rules('date_dccrac3', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_dccrac3', 'Time', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');
			$this->form_validation->set_rules('humidity', 'Humidity', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE)
			{
				$data['content'] = 'dccrac3/create';
				$this->load->view('layout', $data);
			}
			else
			{
				$tanggal = $this->input->post('date_dccrac3').' '.$this->input->post('time_dccrac3');
				$datetimedccrac3 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_dccrac3'=> $datetimedccrac3->format('Y-m-d H:i'),
						'shift'			=> $this->input->post('shift'),
    					'temperature'			=> $this->input->post('temperature'),
    					'humidity'				=> $this->input->post('humidity'),
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				$query = $this->dccrac3model->insert($datas);

				if ($query)
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('dccrac3/search');
				}
			}
		}
		else
		{
			$data['content'] = 'dccrac3/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($iddccrac3)
	{
		$id = $iddccrac3;

		if ($this->input->post())
		{
			// validasi
			$this->form_validation->set_rules('date_dccrac3', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_dccrac3', 'Time', 'trim|required');
			$this->form_validation->set_rules('temperature', 'Temperature', 'trim|required');
			$this->form_validation->set_rules('humidity', 'Humidity', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE)
			{
				$data['editdata'] = $this->db->get_where('dccrac3', array('id' => $id))->row();

				$data['content'] = 'dccrac3/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$tanggal = $this->input->post('date_dccrac3').' '.$this->input->post('time_dccrac3');
				$datetimedccrac3 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_dccrac3'=> $datetimedccrac3->format('Y-m-d H:i'),
						'shift'			=> $this->input->post('shift'),
    					'temperature'			=> $this->input->post('temperature'),
    					'humidity'				=> $this->input->post('humidity'),
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				// melempar data ke model
				$this->dccrac3model->update($id,$datas);

				if ($this->db->affected_rows())
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('dccrac3/search');
				}
				else
				{
					redirect('dccrac3/search');
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('dccrac3', array('id' => $id))->row();

			$data['content'] = 'dccrac3/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($iddccrac3)
	{
		$id = $iddccrac3;
		$this->dccrac3model->delete($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('dccrac3/search');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('dccrac3/search');
		}
	}
}

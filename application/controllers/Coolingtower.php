<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coolingtower extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('coolingtowermodel');
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
		$data['data'] = $this->coolingtowermodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		// dd($data);
		$data['content'] = 'coolingtower/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_coolingtower', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_coolingtower', 'Time', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'coolingtower/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_coolingtower').' '.$this->input->post('time_coolingtower');
				$datetimeCoolingtower = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_coolingtower'	=> $datetimeCoolingtower->format('Y-m-d H:i'),
    					'shift'					=> $this->input->post('shift'),
    					'motor_cooling'			=> $this->input->post('motor_cooling'),
    					'pump_cooling'			=> $this->input->post('pump_cooling'),
    					'meter_cooling'			=> $this->input->post('meter_cooling'),
    					'water_supply'			=> $this->input->post('water_supply'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				$query = $this->coolingtowermodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('coolingtower/search');
				}
			}
		}
		else
		{
			$data['content'] = 'coolingtower/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idcoolingtower)
	{
		$id = $idcoolingtower;

		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_coolingtower', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_coolingtower', 'Time', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('coolingtower', array('id' => $id))->row();

				$data['content'] = 'coolingtower/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$tanggal = $this->input->post('date_coolingtower').' '.$this->input->post('time_coolingtower');
				$datetimeCoolingtower = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'datetime_coolingtower'	=> $datetimeCoolingtower->format('Y-m-d H:i'),
    					'shift'					=> $this->input->post('shift'),
    					'motor_cooling'			=> $this->input->post('motor_cooling'),
    					'pump_cooling'			=> $this->input->post('pump_cooling'),
    					'meter_cooling'			=> $this->input->post('meter_cooling'),
    					'water_supply'			=> $this->input->post('water_supply'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				// melempar data ke model
				$this->coolingtowermodel->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('coolingtower/search');
				}
				else 
				{
					redirect('coolingtower/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('coolingtower', array('id' => $id))->row();

			$data['content'] = 'coolingtower/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idcoolingtower)
	{
		$id = $idcoolingtower;
		$this->coolingtowermodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('coolingtower/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('coolingtower/search');	
		}
	}
}

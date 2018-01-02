<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation','upload');
		$this->load->model('logmodel');
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
		$data['data'] = $this->logmodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		// dd($data);
		$data['content'] = 'log/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{	
		$fileUpload = false;

		if (!empty($_FILES['doc']['name'])) {
			$fileUpload = $this->uploads($_FILES['doc']['name']);
		}

		if ($this->input->post()) 
		{
			// Menjadikan date dan time menjadi satu
			$tanggal = $this->input->post('date_log').' '.$this->input->post('time_log');
			$datetimeLog = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

			// Detail validasi
			$this->form_validation->set_rules('date_log', 'Date', 'trim|required');
			$this->form_validation->set_rules('activity', 'Activity', 'trim|required');
			$this->form_validation->set_rules('floor', 'Floor', 'trim|required');
			$this->form_validation->set_rules('pic', 'PIC', 'trim|required');
			$this->form_validation->set_rules('time_log', 'Time', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			
			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'log/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$datas = array(
						'datetime_log'	=> $datetimeLog->format('Y-m-d H:i'),
						'shift'			=> $this->input->post('shift'),
						'activity'		=> $this->input->post('activity'),
						'floor'			=> $this->input->post('floor'),
						'pic'			=> $this->input->post('pic'),
						'status'		=> $this->input->post('status'),
						'doc'			=> ($fileUpload) ? date('his').$_FILES['doc']['name'] : ''
					);

				$query = $this->logmodel->insert($datas);
				
				if ($query) 
				{
					$this->session->set_flashdata('info', 'Berhasil dimasukan');
					redirect('log/search');
				}					
			}

		}
		else 
		{
			$data['content'] = 'log/create';
			$this->load->view('layout', $data);
		}

	}

	public function update($idLog)
	{
		$id = $idLog;

		if (!empty($_FILES['doc']['name'])) {
			$fileUpload = $this->uploads($_FILES['doc']);
		}

		if ($this->input->post()) 
		{
			// Change date format
			$tanggal = $this->input->post('date_log').' '.$this->input->post('time_log');
			$datetimeLog = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

			$datas = array(
					'datetime_log'	=> $datetimeLog->format('Y-m-d H:i'),
					'shift'			=> $this->input->post('shift'),
					'activity'		=> $this->input->post('activity'),
					'floor'			=> $this->input->post('floor'),
					'pic'			=> $this->input->post('pic'),
					'status'		=> $this->input->post('status')
				);

			if ($fileUpload) {
				$datas['doc'] = date('his').$_FILES['doc']['name'];
			}

			// melempar data ke model
			$this->logmodel->update($id,$datas);
		
			if ($this->db->affected_rows()) 
			{
				$this->session->set_flashdata('info', 'Berhasil diupdate');
				redirect('log/search');
			}
			else 
			{
				redirect('log/search');	
			}
		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('log', array('id' => $id))->row();

			$data['content'] = 'log/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idLog)
	{
		$id = $idLog;
		$this->logmodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Berhasil dihapus');
			redirect('log/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Gagal diupdate');
			redirect('log/search');	
		}
	}

	private function uploads($param) {
		$nmfile = date('his').$_FILES['doc']['name'];
		$config['upload_path']      = './assets/uploads/log';
		$config['allowed_types']    = 'gif|jpg|png|jpeg';
		$config['max_size']         = 3072;
		$config['max_width']        = 5000;
		$config['max_height']       = 5000;
		$config['file_name']		= $nmfile;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('doc')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('info', $error);
			return redirect('log/search');
        } 
        else 
        {
            $data = array('upload_data' => $this->upload->data());
		
            return TRUE;
        }
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestbook extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('guestbookmodel');
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
		$data['data'] = $this->guestbookmodel->getData($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;

		$data['content'] = 'guestbook/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_guestbook', 'Date', 'trim|required');
			$this->form_validation->set_rules('guest_name', 'Guest Name', 'trim|required');
			// $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('company', 'Company', 'trim|required');
			$this->form_validation->set_rules('activity', 'Activity', 'trim|required');
			// $this->form_validation->set_rules('sik', 'SIK', 'trim|required');
			$this->form_validation->set_rules('pic_tsel', 'PIC Tsel', 'trim|required');
			// $this->form_validation->set_rules('laptop', 'Laptop', 'trim|required');
			$this->form_validation->set_rules('guest_in', 'Guest In', 'trim|required');
			// $this->form_validation->set_rules('guest_out', 'Guest Out', 'trim|required');
			$this->form_validation->set_rules('floor', 'Floor', 'trim|required');
			// $this->form_validation->set_rules('visitor', 'Visitor', 'trim|required');
			// $this->form_validation->set_rules('acces', 'Acces', 'trim|required');
			// $this->form_validation->set_rules('nda', 'NDA', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'guestbook/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_guestbook').' '.$this->input->post('guest_in');
				$datetimeGuestbook = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'date_guestbook'	=> $datetimeGuestbook->format('Y-m-d H:i'),
    					'guest_name'		=> $this->input->post('guest_name'),
    					'phone'				=> $this->input->post('phone'),
    					'company'			=> $this->input->post('company'),
    					'activity'			=> $this->input->post('activity'),
    					'sik'				=> $this->input->post('sik'),
    					'pic_tsel'			=> $this->input->post('pic_tsel'),
    					'laptop'			=> $this->input->post('laptop'),
    					'guest_in'			=> $this->input->post('guest_in'),
    					'guest_out'			=> $this->input->post('guest_out'),
    					'floor'				=> $this->input->post('floor'),
    					'visitor'			=> $this->input->post('visitor'),
    					'acces'				=> $this->input->post('acces'),
    					'nda'				=> $this->input->post('nda')
					);

				$query = $this->guestbookmodel->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('guestbook/search');
				}
			}
		}
		else
		{
			$data['content'] = 'guestbook/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idGuestbook)
	{
		$id = $idGuestbook;

		if ($this->input->post()) 
		{

		$this->form_validation->set_rules('date_guestbook', 'Date', 'trim|required');
			$this->form_validation->set_rules('guest_name', 'Guest Name', 'trim|required');
			// $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('company', 'Company', 'trim|required');
			$this->form_validation->set_rules('activity', 'Activity', 'trim|required');
			// $this->form_validation->set_rules('sik', 'SIK', 'trim|required');
			$this->form_validation->set_rules('pic_tsel', 'PIC Tsel', 'trim|required');
			// $this->form_validation->set_rules('laptop', 'Laptop', 'trim|required');
			$this->form_validation->set_rules('guest_in', 'Guest In', 'trim|required');
			// $this->form_validation->set_rules('guest_out', 'Guest Out', 'trim|required');
			$this->form_validation->set_rules('floor', 'Floor', 'trim|required');
			// $this->form_validation->set_rules('visitor', 'Visitor', 'trim|required');
			// $this->form_validation->set_rules('acces', 'Acces', 'trim|required');
			// $this->form_validation->set_rules('nda', 'NDA', 'trim');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'guestbook/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				$tanggal = $this->input->post('date_guestbook').' '.$this->input->post('guest_in');
				$datetimeGuestbook = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				$datas = array(
						'date_guestbook'	=> $datetimeGuestbook->format('Y-m-d H:i'),
    					'guest_name'		=> $this->input->post('guest_name'),
    					'phone'				=> $this->input->post('phone'),
    					'company'			=> $this->input->post('company'),
    					'activity'			=> $this->input->post('activity'),
    					'sik'				=> $this->input->post('sik'),
    					'pic_tsel'			=> $this->input->post('pic_tsel'),
    					'laptop'			=> $this->input->post('laptop'),
    					'guest_in'			=> $this->input->post('guest_in'),
    					'guest_out'			=> $this->input->post('guest_out'),
    					'floor'				=> $this->input->post('floor'),
    					'visitor'			=> $this->input->post('visitor'),
    					'acces'				=> $this->input->post('acces'),
    					'nda'				=> $this->input->post('nda')
					);

				// melempar data ke model
				$this->guestbookmodel->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('guestbook/search');
				}
				else 
				{
					redirect('guestbook/search');	
				}
			}
		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('guestbook', array('id' => $id))->row();

			$data['content'] = 'guestbook/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idGuestbook)
	{
		$id = $idGuestbook;
		$this->guestbookmodel->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('guestbook/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('guestbook/search');	
		}
	}
}

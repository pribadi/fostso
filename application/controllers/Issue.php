<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('issuemodel');
	}

	public function search()
	{
		// Data dari model
		$data['data'] = $this->issuemodel->getData()->result_array();

		$data['content'] = 'issue/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post())
		{
			$datetimeIssue = DateTime::createFromFormat('d/m/Y', $this->input->post('tanggal'));

			$datas = array(
					'tanggal'	=> $datetimeIssue->format('Y-m-d'),
					'issue'		=> $this->input->post('issue'),
					'status'	=> $this->input->post('status')
				);

			$query = $this->issuemodel->insert($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('issue/search');
			}
		}
		else
		{
			$data['content'] = 'issue/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idissue)
	{
		$id = $idissue;

		if ($this->input->post())
		{

			$datetimeIssue = DateTime::createFromFormat('d/m/Y', $this->input->post('tanggal'));

			$datas = array(
					'tanggal'	=> $datetimeIssue->format('Y-m-d'),
					'issue'		=> $this->input->post('issue'),
					'status'	=> $this->input->post('status')
				);

			// melempar data ke model
			$this->issuemodel->update($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('issue/search');
			}
			else
			{
				redirect('issue/search');
			}
		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('issue', array('id' => $id))->row();

			$data['content'] = 'issue/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idissue)
	{
		$id = $idissue;
		$this->issuemodel->delete($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('issue/search');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('issue/search');
		}
	}
}

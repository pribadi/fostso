<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rectifier1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('rectifier1model');
	}

	public function search()
	{
		$month	= date('n');
		$year	= date('Y');

		if ($this->input->post()) {
			$month	= $this->input->post('month');
			$year	= $this->input->post('year');
		}

		// Data dari model
		$data['data']	= $this->rectifier1model->getData($month, $year);
		$data['month']	= $month;
		$data['year']	= $year;

		// dd($data);
		$data['content'] = 'rectifier1/search';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) 
		{
			$this->form_validation->set_rules('date_rectifier1', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_rectifier1', 'Time', 'trim|required');
			$this->form_validation->set_rules('load_rectifier1', 'Load', 'trim|required');
			$this->form_validation->set_rules('voltage', 'Voltage', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['content'] = 'rectifier1/create';
				$this->load->view('layout', $data);
			} 
			else 
			{
				// merge date and time
				$tanggal = $this->input->post('date_rectifier1').' '.$this->input->post('time_rectifier1');
				$datetimeRectifier1 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				// Accupancy Load
				// $persentasi1 = $this->input->post('load_rectifier1');
				// $persentasi2 = 336*0.9;
				// $hasil      = $persentasi1/$persentasi2;
				// $accupancy  = ceil($hasil*100);

				// Accupancy Load + Batt
				$persentasi1 = $this->input->post('load_rectifier1')+20;
            	$persentasi2 = 336*0.8;
            	$hasil      = $persentasi1/$persentasi2;
                $accupancy  = ceil($hasil*100);

                // autonomi
                $aut = (200*0.9)/$this->input->post('load_rectifier1');

                // pembulatan 2 angka di belakang koma
                $aut2 = round($aut, 2) ;
                // pecah depan dan belakang koma
                $aut3 = explode(".", $aut2);

                if($aut3[1]==1){
                	$aut3[1] = $aut3[1]+9;
                }
                elseif($aut3[1]==2){
                	$aut3[1] = $aut3[1]+18;
                }
                elseif($aut3[1]==3){
                	$aut3[1] = $aut3[1]+27;
                }
                elseif($aut3[1]==4){
                	$aut3[1] = $aut3[1]+36;
                }
                elseif($aut3[1]==5){
                	$aut3[1] = $aut3[1]+45;
                }
                elseif($aut3[1]==6){
                	$aut3[1] = $aut3[1]+54;
                }
                elseif($aut3[1]==7){
                	$aut3[1] = $aut3[1]+63;
                }
                elseif($aut3[1]==8){
                	$aut3[1] = $aut3[1]+72;
                }
                elseif($aut3[1]==9){
                	$aut3[1] = $aut3[1]+81;
                }

                if(empty($aut3[1])){
	                $autonomi = $aut3[0]*60;
                } else{
	                $autonomi = ($aut3[0]*60)+$aut3[1];
                }

				$datas = array(
						'datetime_rectifier1'	=> $datetimeRectifier1->format('Y-m-d H:i'),
						'shift'				=> $this->input->post('shift'),
    					'load_rectifier1'		=> $this->input->post('load_rectifier1'),
    					'voltage'				=> $this->input->post('voltage'),
    					'accupancy'				=> $accupancy,
    					'autonomi'				=> $autonomi,
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				$query = $this->rectifier1model->insert($datas);

				if ($query) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('rectifier1/search');
				}
			}
		}
		else
		{
			$data['content'] = 'rectifier1/create';
			$this->load->view('layout', $data);
		}
	}

	public function update($idrectifier1)
	{
		$id = $idrectifier1;

		if ($this->input->post()) 
		{
			// validasi
			$this->form_validation->set_rules('date_rectifier1', 'Date', 'trim|required');
			$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
			$this->form_validation->set_rules('time_rectifier1', 'Time', 'trim|required');
			$this->form_validation->set_rules('load_rectifier1', 'Load', 'trim|required');
			$this->form_validation->set_rules('voltage', 'Voltage', 'trim|required');
			$this->form_validation->set_rules('alarm_condition', 'Alarm Condition', 'trim|required');
			$this->form_validation->set_rules('remark', 'Remark', 'trim|required');

			// Jika validasi berhasil
			if ($this->form_validation->run() == FALSE) 
			{
				$data['editdata'] = $this->db->get_where('rectifier1', array('id' => $id))->row();

				$data['content'] = 'rectifier1/update';
				$this->load->view('layout', $data);
			}
			else
			{
				$tanggal = $this->input->post('date_rectifier1').' '.$this->input->post('time_rectifier1');
				$datetimeRectifier1 = DateTime::createFromFormat('d/m/Y H:i', $tanggal);

				// Accupancy Load
				// $persentasi1 = $this->input->post('load_rectifier1');
				// $persentasi2 = 336*0.9;
				// $hasil      = $persentasi1/$persentasi2;
				// $accupancy  = ceil($hasil*100);

				// Accupancy Load + Batt
				$persentasi1 = $this->input->post('load_rectifier1')+20;
            	$persentasi2 = 336*0.8;
            	$hasil      = $persentasi1/$persentasi2;
                $accupancy  = ceil($hasil*100);

                // autonomi
                $aut = (200*0.9)/$this->input->post('load_rectifier1');
                // pembulatan 2 angka di belakang koma
                $aut2 = round($aut, 2) ;
                // pecah depan dan belakang koma
                $aut3 = explode(".", $aut2);

                if($aut3[1]==1){
                	$aut3[1] = $aut3[1]+9;
                }
                elseif($aut3[1]==2){
                	$aut3[1] = $aut3[1]+18;
                }
                elseif($aut3[1]==3){
                	$aut3[1] = $aut3[1]+27;
                }
                elseif($aut3[1]==4){
                	$aut3[1] = $aut3[1]+36;
                }
                elseif($aut3[1]==5){
                	$aut3[1] = $aut3[1]+45;
                }
                elseif($aut3[1]==6){
                	$aut3[1] = $aut3[1]+54;
                }
                elseif($aut3[1]==7){
                	$aut3[1] = $aut3[1]+63;
                }
                elseif($aut3[1]==8){
                	$aut3[1] = $aut3[1]+72;
                }
                elseif($aut3[1]==9){
                	$aut3[1] = $aut3[1]+81;
                }

                if(empty($aut3[1])){
	                $autonomi = $aut3[0]*60;
                } else{
	                $autonomi = ($aut3[0]*60)+$aut3[1];
                }

				$datas = array(
						'datetime_rectifier1'	=> $datetimeRectifier1->format('Y-m-d H:i'),
						'shift'				=> $this->input->post('shift'),
    					'load_rectifier1'		=> $this->input->post('load_rectifier1'),
    					'voltage'				=> $this->input->post('voltage'),
    					'accupancy'				=> $accupancy,
    					'autonomi'				=> $autonomi,
    					'alarm_condition'		=> $this->input->post('alarm_condition'),
    					'remark'				=> $this->input->post('remark'),
    					'fs_name'				=> $this->input->post('fs_name')
					);

				// melempar data ke model
				$this->rectifier1model->update($id,$datas);
			
				if ($this->db->affected_rows()) 
				{
					$this->session->set_flashdata('info', 'Success');
					redirect('rectifier1/search');
				}
				else 
				{
					redirect('rectifier1/search');	
				}
			}

		}
		else
		{
			// Menampilkan data
			$data['editdata'] = $this->db->get_where('rectifier1', array('id' => $id))->row();

			$data['content'] = 'rectifier1/update';
			$this->load->view('layout', $data);
		}

	}

	public function delete($idrectifier1)
	{
		$id = $idrectifier1;
		$this->rectifier1model->delete($id);

		if ($this->db->affected_rows()) 
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('rectifier1/search');
		}
		else 
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('rectifier1/search');	
		}
	}
}

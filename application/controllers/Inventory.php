<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('inventorymodel');
	}

	public function map()
	{
		$data['data'] = $this->db->get('inventory')->result_array();

		// dd($data['data']);

		$data['content'] = 'inventory/map';
		$this->load->view('layout', $data);
	}



	// Trafo

	public function searchtrafo()
	{
		// Data dari model
		$data['dataTrafo'] = $this->inventorymodel->getDataTrafo()->result_array();

		$data['content'] = 'inventory/searchtrafo';
		$this->load->view('layout', $data);
	}

	public function createtrafo()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'trafo_id'		=> $this->input->post('trafo_id'),
				'merk'			=> $this->input->post('merk'),
				'capacity'		=> $this->input->post('capacity'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertTrafo($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchtrafo');
			}
		}
		else
		{
			$data['content'] = 'inventory/createtrafo';
			$this->load->view('layout', $data);
		}
	}

	public function updatetrafo($idtrafo)
	{
		$id = $idtrafo;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'			=> $this->input->post('side_id'),
				'trafo_id'		=> $this->input->post('trafo_id'),
				'merk'				=> $this->input->post('merk'),
				'capacity'		=> $this->input->post('capacity'),
				'type'				=> $this->input->post('type'),
				'model'				=> $this->input->post('model'),
				'sn'					=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'				=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateTrafo($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchtrafo');
			}
			else
			{
				redirect('inventory/searchtrafo');
			}

		}
		else
		{
			// Menampilkan data
			$data['editdataTrafo'] = $this->db->get_where('invtrafo', array('id' => $id))->row();

			$data['content'] = 'inventory/updatetrafo';
			$this->load->view('layout', $data);
		}
	}

	public function deletetrafo($idtrafo)
	{
		$id = $idtrafo;
		$this->inventorymodel->deleteTrafo($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchtrafo');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchtrafo');
		}
	}

	// Genset

	public function searchgenset()
	{
		// Data dari model
		$data['dataGenset'] = $this->inventorymodel->getDataGenset()->result_array();

		$data['content'] = 'inventory/searchgenset';
		$this->load->view('layout', $data);
	}

	public function creategenset()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'genset_id'		=> $this->input->post('genset_id'),
				'merk'			=> $this->input->post('merk'),
				'capacity'		=> $this->input->post('capacity'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertGenset($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchgenset');
			}
		}
		else
		{
			$data['content'] = 'inventory/creategenset';
			$this->load->view('layout', $data);
		}
	}

	public function updategenset($idgenset)
	{
		$id = $idgenset;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'genset_id'		=> $this->input->post('genset_id'),
				'merk'			=> $this->input->post('merk'),
				'capacity'		=> $this->input->post('capacity'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateGenset($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchgenset');
			}
			else
			{
				redirect('inventory/searchgenset');
			}
		}
		else
		{
			// Menampilkan data
			$data['editdataGenset'] = $this->db->get_where('invgenset', array('id' => $id))->row();

			$data['content'] = 'inventory/updategenset';
			$this->load->view('layout', $data);
		}
	}

	public function deletegenset($idgenset)
	{
		$id = $idgenset;
		$this->inventorymodel->deleteGenset($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchgenset');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchgenset');
		}
	}

	// Panel

	public function searchpanel()
	{
		// Data dari model
		$data['dataPanel'] = $this->inventorymodel->getDataPanel()->result_array();

		$data['content'] = 'inventory/searchpanel';
		$this->load->view('layout', $data);
	}

	public function createpanel()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'			=> $this->input->post('floor'),
				'panel_id'		=> $this->input->post('panel_id'),
				'merk'			=> $this->input->post('merk'),
				'capacity'		=> $this->input->post('capacity'),
				'type'			=> $this->input->post('type'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertPanel($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchpanel');
			}
		}
		else
		{
			$data['content'] = 'inventory/createpanel';
			$this->load->view('layout', $data);
		}
	}

	public function updatepanel($idpanel)
	{
		$id = $idpanel;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'			=> $this->input->post('floor'),
				'panel_id'		=> $this->input->post('panel_id'),
				'merk'			=> $this->input->post('merk'),
				'capacity'		=> $this->input->post('capacity'),
				'type'			=> $this->input->post('type'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updatePanel($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchpanel');
			}
			else
			{
				redirect('inventory/searchpanel');
			}

		}
		else
		{
			// Menampilkan data
			$data['editdataPanel'] = $this->db->get_where('invpanel', array('id' => $id))->row();

			$data['content'] = 'inventory/updatepanel';
			$this->load->view('layout', $data);
		}
	}

	public function deletepanel($idpanel)
	{
		$id = $idpanel;
		$this->inventorymodel->deletePanel($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchpanel');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchpanel');
		}
	}

	// UPS

	public function searchups()
	{
		// Data dari model
		$data['dataUps'] = $this->inventorymodel->getDataUps()->result_array();

		$data['content'] = 'inventory/searchups';
		$this->load->view('layout', $data);
	}

	public function createups()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'			=> $this->input->post('floor'),
				'location'		=> $this->input->post('location'),
				'ups_id'		=> $this->input->post('ups_id'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'sn'			=> $this->input->post('sn'),
				'r'				=> $this->input->post('r'),
				's'				=> $this->input->post('s'),
				't'				=> $this->input->post('t'),
				'capacity'		=> $this->input->post('capacity'),
				'modul'			=> $this->input->post('modul'),
				'kap_modul'		=> $this->input->post('kap_modul'),
				'load_kva'		=> $this->input->post('load_kva'),
				'load_persen'	=> $this->input->post('load_persen'),
				'autonomi'		=> $this->input->post('autonomi'),
				'battery_kap'	=> $this->input->post('battery_kap'),
				'battery_merk'	=> $this->input->post('battery_merk'),
				'battery_cell'	=> $this->input->post('battery_cell'),
				'battery_qty'	=> $this->input->post('battery_qty'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'po_kontak'		=> $this->input->post('po_kontak'),
				'responsible'	=> $this->input->post('responsible')
			);

			$query = $this->inventorymodel->insertUps($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchups');
			}
		}
		else
		{
			$data['content'] = 'inventory/createups';
			$this->load->view('layout', $data);
		}
	}

	public function updateups($idups)
	{
		$id = $idups;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'			=> $this->input->post('floor'),
				'location'		=> $this->input->post('location'),
				'ups_id'		=> $this->input->post('ups_id'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'sn'			=> $this->input->post('sn'),
				'r'				=> $this->input->post('r'),
				's'				=> $this->input->post('s'),
				't'				=> $this->input->post('t'),
				'capacity'		=> $this->input->post('capacity'),
				'modul'			=> $this->input->post('modul'),
				'kap_modul'		=> $this->input->post('kap_modul'),
				'load_kva'		=> $this->input->post('load_kva'),
				'load_persen'	=> $this->input->post('load_persen'),
				'autonomi'		=> $this->input->post('autonomi'),
				'battery_kap'	=> $this->input->post('battery_kap'),
				'battery_merk'	=> $this->input->post('battery_merk'),
				'battery_cell'	=> $this->input->post('battery_cell'),
				'battery_qty'	=> $this->input->post('battery_qty'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'po_kontak'		=> $this->input->post('po_kontak'),
				'responsible'	=> $this->input->post('responsible')
			);

			// melempar data ke model
			$this->inventorymodel->updateUps($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchups');
			}
			else
			{
				redirect('inventory/searchups');
			}

		}
		else
		{
			// Menampilkan data
			$data['editdataUps'] = $this->db->get_where('invups', array('id' => $id))->row();

			$data['content'] = 'inventory/updateups';
			$this->load->view('layout', $data);
		}
	}

	public function deleteups($idups)
	{
		$id = $idups;
		$this->inventorymodel->deleteUps($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchups');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchups');
		}
	}

	// FM 200

	public function searchfm200()
	{
		// Data dari model
		$data['dataFm200'] = $this->inventorymodel->getDataFm200()->result_array();

		$data['content'] = 'inventory/searchfm200';
		$this->load->view('layout', $data);
	}

	public function createfm200()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'fm200_id'		=> $this->input->post('fm200_id'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertFm200($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchfm200');
			}
		}
		else
		{
			$data['content'] = 'inventory/createfm200';
			$this->load->view('layout', $data);
		}
	}

	public function updatefm200($idfm200)
	{
		$id = $idfm200;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'fm200_id'		=> $this->input->post('fm200_id'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateFm200($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchfm200');
			}
			else
			{
				redirect('inventory/searchfm200');
			}
		}
		else
		{
			// Menampilkan data
			$data['editdataFm200'] = $this->db->get_where('invfm200', array('id' => $id))->row();

			$data['content'] = 'inventory/updatefm200';
			$this->load->view('layout', $data);
		}
	}

	public function deletefm200($idfm200)
	{
		$id = $idfm200;
		$this->inventorymodel->deleteFm200($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchfm200');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchfm200');
		}
	}

	// CCTV

	public function searchcctv()
	{
		// Data dari model
		$data['datacctv'] = $this->inventorymodel->getDataCctv()->result_array();

		$data['content'] = 'inventory/searchcctv';
		$this->load->view('layout', $data);
	}

	public function createcctv()
	{

		// dd($this->input->post());

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'		=> $this->input->post('floor'),
				'location'		=> $this->input->post('location'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'sn'			=> $this->input->post('sn'),
				'jumlah'		=> $this->input->post('jumlah'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertCctv($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcctv');
			}
		}
		else
		{
			$data['content'] = 'inventory/createcctv';
			$this->load->view('layout', $data);
		}
	}

	public function updatecctv($idcctv)
	{
		$id = $idcctv;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'		=> $this->input->post('floor'),
				'location'		=> $this->input->post('location'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'sn'			=> $this->input->post('sn'),
				'jumlah'		=> $this->input->post('jumlah'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateCctv($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcctv');
			}
			else
			{
				redirect('inventory/searchcctv');
			}
		}
		else
		{
			// Menampilkan data
			$data['editdataCctv'] = $this->db->get_where('invcctv', array('id' => $id))->row();

			$data['content'] = 'inventory/updatecctv';
			$this->load->view('layout', $data);
		}
	}

	public function deletecctv($idcctv)
	{
		$id = $idcctv;
		$this->inventorymodel->deleteCctv($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchcctv');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchcctv');
		}
	}

	// Access Control

	public function searchaccess()
	{
		// Data dari model
		$data['dataaccess'] = $this->inventorymodel->getDataAccess()->result_array();

		$data['content'] = 'inventory/searchaccess';
		$this->load->view('layout', $data);
	}

	public function createaccess()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'access_id'		=> $this->input->post('access_id'),
				'room_coverage'	=> $this->input->post('room_coverage'),
				'merk'			=> $this->input->post('merk'),
				'model'			=> $this->input->post('model'),
				'sn'			=> $this->input->post('sn'),
				'ip_address'	=> $this->input->post('ip_address'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertAccess($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchaccess');
			}
		}
		else
		{
			$data['content'] = 'inventory/createaccess';
			$this->load->view('layout', $data);
		}
	}

	public function updateaccess($idaccess)
	{
		$id = $idaccess;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'access_id'		=> $this->input->post('access_id'),
				'room_coverage'	=> $this->input->post('room_coverage'),
				'merk'			=> $this->input->post('merk'),
				'model'			=> $this->input->post('model'),
				'sn'			=> $this->input->post('sn'),
				'ip_address'	=> $this->input->post('ip_address'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateAccess($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchaccess');
			}
			else
			{
				redirect('inventory/searchaccess');
			}
		}
		else
		{
			// Menampilkan data
			$data['editdataAccess'] = $this->db->get_where('invaccess', array('id' => $id))->row();

			$data['content'] = 'inventory/updateaccess';
			$this->load->view('layout', $data);
		}
	}

	public function deleteaccess($idaccess)
	{
		$id = $idaccess;
		$this->inventorymodel->deleteAccess($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchaccess');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchaccess');
		}
	}

	// Apar

	public function searchapar()
	{
		// Data dari model
		$data['dataapar'] = $this->inventorymodel->getDataApar()->result_array();

		$data['content'] = 'inventory/searchapar';
		$this->load->view('layout', $data);
	}

	public function createapar()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'			=> $this->input->post('floor'),
				'room'			=> $this->input->post('room'),
				'apar_id'		=> $this->input->post('apar_id'),
				'merk'			=> $this->input->post('merk'),
				'model'			=> $this->input->post('model'),
				'class'			=> $this->input->post('class'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertApar($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchapar');
			}
		}
		else
		{
			$data['content'] = 'inventory/createapar';
			$this->load->view('layout', $data);
		}
	}

	public function updateapar($idapar)
	{
		$id = $idapar;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'floor'			=> $this->input->post('floor'),
				'room'			=> $this->input->post('room'),
				'apar_id'		=> $this->input->post('apar_id'),
				'merk'			=> $this->input->post('merk'),
				'model'			=> $this->input->post('model'),
				'class'			=> $this->input->post('class'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateApar($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchapar');
			}
			else
			{
				redirect('inventory/searchapar');
			}
		}
		else
		{
			// Menampilkan data
			$data['editdataApar'] = $this->db->get_where('invapar', array('id' => $id))->row();

			$data['content'] = 'inventory/updateapar';
			$this->load->view('layout', $data);
		}
	}

	public function deleteapar($idapar)
	{
		$id = $idapar;
		$this->inventorymodel->deleteApar($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchapar');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchapar');
		}
	}

	// Cooling Tower

	public function searchcoolingtower()
	{
		// Data dari model
		$data['datacoolingtower'] = $this->inventorymodel->getDataCoolingtower()->result_array();

		$data['content'] = 'inventory/searchcoolingtower';
		$this->load->view('layout', $data);
	}

	public function createcoolingtower()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'engine_id'		=> $this->input->post('engine_id'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'capacity'		=> $this->input->post('capacity'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertCoolingtower($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcoolingtower');
			}
		}
		else
		{
			$data['content'] = 'inventory/createcoolingtower';
			$this->load->view('layout', $data);
		}
	}

	public function updatecoolingtower($idcoolingtower)
	{
		$id = $idcoolingtower;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'		=> $this->input->post('side_id'),
				'engine_id'		=> $this->input->post('engine_id'),
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'capacity'		=> $this->input->post('capacity'),
				'sn'			=> $this->input->post('sn'),
				'coverage'		=> $this->input->post('coverage'),
				'tahun'			=> $this->input->post('tahun'),
				'maintenance'	=> $this->input->post('maintenance'),
				'responsible'	=> $this->input->post('responsible'),
				'po_kontak'		=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateCoolingtower($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcoolingtower');
			}
			else
			{
				redirect('inventory/searchcoolingtower');
			}

		}
		else
		{
			// Menampilkan data
			$data['editdataCoolingtower'] = $this->db->get_where('invcoolingtower', array('id' => $id))->row();

			$data['content'] = 'inventory/updatecoolingtower';
			$this->load->view('layout', $data);
		}
	}

	public function deletecoolingtower($idcoolingtower)
	{
		$id = $idcoolingtower;
		$this->inventorymodel->deleteCoolingtower($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchcoolingtower');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchcoolingtower');
		}
	}

	// Crac

	public function searchcrac()
	{
		// Data dari model
		$data['datacrac'] = $this->inventorymodel->getDataCrac()->result_array();

		$data['content'] = 'inventory/searchcrac';
		$this->load->view('layout', $data);
	}

	public function createcrac()
	{
		if ($this->input->post())
		{
			$datas = array(
				'side_id'			=> $this->input->post('side_id'),
				'crac_id'			=> $this->input->post('crac_id'),
				'merk'				=> $this->input->post('merk'),
				'type'				=> $this->input->post('type'),
				'model'				=> $this->input->post('model'),
				'model_fan'			=> $this->input->post('model_fan'),
				'phase'				=> $this->input->post('phase'),
				'vendor'			=> $this->input->post('vendor'),
				'total_cooling'		=> $this->input->post('total_cooling'),
				'capacity'			=> $this->input->post('capacity'),
				'sensible_cooling'	=> $this->input->post('sensible_cooling'),
				'sensible_capacity'	=> $this->input->post('sensible_capacity'),
				'coverage'			=> $this->input->post('coverage'),
				'sn'				=> $this->input->post('sn'),
				'tahun'				=> $this->input->post('tahun'),
				'maintenance'		=> $this->input->post('maintenance'),
				'responsible'		=> $this->input->post('responsible'),
				'po_kontak'			=> $this->input->post('po_kontak')
			);

			$query = $this->inventorymodel->insertCrac($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcrac');
			}
		}
		else
		{
			$data['content'] = 'inventory/createcrac';
			$this->load->view('layout', $data);
		}
	}

	public function updatecrac($idcrac)
	{
		$id = $idcrac;

		if ($this->input->post())
		{
			$datas = array(
				'side_id'			=> $this->input->post('side_id'),
				'crac_id'			=> $this->input->post('crac_id'),
				'merk'				=> $this->input->post('merk'),
				'type'				=> $this->input->post('type'),
				'model'				=> $this->input->post('model'),
				'model_fan'			=> $this->input->post('model_fan'),
				'phase'				=> $this->input->post('phase'),
				'vendor'			=> $this->input->post('vendor'),
				'total_cooling'		=> $this->input->post('total_cooling'),
				'capacity'			=> $this->input->post('capacity'),
				'sensible_cooling'	=> $this->input->post('sensible_cooling'),
				'sensible_capacity'	=> $this->input->post('sensible_capacity'),
				'coverage'			=> $this->input->post('coverage'),
				'sn'				=> $this->input->post('sn'),
				'tahun'				=> $this->input->post('tahun'),
				'maintenance'		=> $this->input->post('maintenance'),
				'responsible'		=> $this->input->post('responsible'),
				'po_kontak'			=> $this->input->post('po_kontak')
			);

			// melempar data ke model
			$this->inventorymodel->updateCrac($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcrac');
			}
			else
			{
				redirect('inventory/searchcrac');
			}

		}
		else
		{
			// Menampilkan data
			$data['editdataCrac'] = $this->db->get_where('invcrac', array('id' => $id))->row();

			$data['content'] = 'inventory/updatecrac';
			$this->load->view('layout', $data);
		}
	}

	public function deletecrac($idcrac)
	{
		$id = $idcrac;
		$this->inventorymodel->deleteCrac($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchcrac');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchcrac');
		}
	}

	// Cable

	public function searchcable()
	{
		// Data dari model
		$data['datacable'] = $this->inventorymodel->getDataCable()->result_array();

		$data['content'] = 'inventory/searchcable';
		$this->load->view('layout', $data);
	}

	public function createcable()
	{
		if ($this->input->post())
		{
			$datas = array(
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'ukuran'		=> $this->input->post('ukuran'),
				'warna'			=> $this->input->post('warna'),
				'jumlah'		=> $this->input->post('jumlah'),
				'satuan'		=> $this->input->post('satuan')
			);

			$query = $this->inventorymodel->insertCable($datas);

			if ($query)
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcable');
			}
		}
		else
		{
			$data['content'] = 'inventory/createcable';
			$this->load->view('layout', $data);
		}
	}

	public function updatecable($idcable)
	{
		$id = $idcable;

		if ($this->input->post())
		{
			$datas = array(
				'merk'			=> $this->input->post('merk'),
				'type'			=> $this->input->post('type'),
				'model'			=> $this->input->post('model'),
				'ukuran'		=> $this->input->post('ukuran'),
				'warna'			=> $this->input->post('warna'),
				'jumlah'		=> $this->input->post('jumlah'),
				'satuan'		=> $this->input->post('satuan')
			);

			// melempar data ke model
			$this->inventorymodel->updateCable($id,$datas);

			if ($this->db->affected_rows())
			{
				$this->session->set_flashdata('info', 'Success');
				redirect('inventory/searchcable');
			}
			else
			{
				redirect('inventory/searchcable');
			}

		}
		else
		{
			// Menampilkan data
			$data['editdataCable'] = $this->db->get_where('invcable', array('id' => $id))->row();

			$data['content'] = 'inventory/updatecable';
			$this->load->view('layout', $data);
		}
	}

	public function deletecable($idcable)
	{
		$id = $idcable;
		$this->inventorymodel->deleteCable($id);

		if ($this->db->affected_rows())
		{
			$this->session->set_flashdata('info', 'Success');
			redirect('inventory/searchcable');
		}
		else
		{
			$this->session->set_flashdata('info', 'Failed');
			redirect('inventory/searchcable');
		}
	}

}

<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Inventorymodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	// Trafo

	public function getDataTrafo()
	{
		return $this->db->get('invtrafo');
	}

	public function insertTrafo($datas)
	{
		return $this->db->insert('invtrafo', $datas);
	}

	function updateTrafo($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invtrafo', $datas);
	}

	function deleteTrafo($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invtrafo');
	}

	// Genset

	public function getDataGenset()
	{
		return $this->db->get('invgenset');
	}

	public function insertGenset($datas)
	{
		return $this->db->insert('invgenset', $datas);
	}

	function updateGenset($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invgenset', $datas);
	}

	function deleteGenset($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invgenset');
	}

	// Panel

	public function getDataPanel()
	{
		return $this->db->get('invpanel');
	}

	public function insertPanel($datas)
	{
		return $this->db->insert('invpanel', $datas);
	}

	function updatePanel($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invpanel', $datas);
	}

	function deletePanel($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invpanel');
	}

	// UPS

	public function getDataUps()
	{
		return $this->db->get('invups');
	}

	public function insertUps($datas)
	{
		return $this->db->insert('invups', $datas);
	}

	function updateUps($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invups', $datas);
	}

	function deleteUps($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invups');
	}

	// FM 200

	public function getDataFm200()
	{
		return $this->db->get('invfm200');
	}

	public function insertFm200($datas)
	{
		return $this->db->insert('invfm200', $datas);
	}

	function updateFm200($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invfm200', $datas);
	}

	function deleteFm200($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invfm200');
	}

	// CCTV

	public function getDataCctv()
	{
		return $this->db->get('invcctv');
	}

	public function insertCctv($datas)
	{
		return $this->db->insert('invcctv', $datas);
	}

	function updateCctv($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invcctv', $datas);
	}

	function deleteCctv($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invcctv');
	}

	// Access Control

	public function getDataAccess()
	{
		return $this->db->get('invaccess');
	}

	public function insertAccess($datas)
	{
		return $this->db->insert('invaccess', $datas);
	}

	function updateAccess($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invaccess', $datas);
	}

	function deleteAccess($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invaccess');
	}

	// Apar

	public function getDataApar()
	{
		return $this->db->get('invapar');
	}

	public function insertApar($datas)
	{
		return $this->db->insert('invapar', $datas);
	}

	function updateApar($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invapar', $datas);
	}

	function deleteApar($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invapar');
	}

	// Cooling Tower

	public function getDataCoolingtower()
	{
		return $this->db->get('invcoolingtower');
	}

	public function insertCoolingtower($datas)
	{
		return $this->db->insert('invcoolingtower', $datas);
	}

	function updateCoolingtower($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invcoolingtower', $datas);
	}

	function deleteCoolingtower($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invcoolingtower');
	}

	// Crac

	public function getDataCrac()
	{
		return $this->db->get('invcrac');
	}

	public function insertCrac($datas)
	{
		return $this->db->insert('invcrac', $datas);
	}

	function updateCrac($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invcrac', $datas);
	}

	function deleteCrac($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invcrac');
	}

	// Cable

	public function getDataCable()
	{
		return $this->db->get('invcable');
	}

	public function insertCable($datas)
	{
		return $this->db->insert('invcable', $datas);
	}

	function updateCable($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('invcable', $datas);
	}

	function deleteCable($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('invcable');
	}

}

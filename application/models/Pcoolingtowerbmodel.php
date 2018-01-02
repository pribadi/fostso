<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Pcoolingtowerbmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_pcoolingtowerb) as date')
				->select('DAY(datetime_pcoolingtowerb) as day')
				->where('MONTH(datetime_pcoolingtowerb) = '.$month)
				->where('YEAR(datetime_pcoolingtowerb) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_pcoolingtowerb ASC')
				->get('pcoolingtowerb')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('pcoolingtowerb', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('pcoolingtowerb', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pcoolingtowerb');
	}

}

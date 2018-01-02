<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Pcoolingtoweramodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_pcoolingtowera) as date')
				->select('DAY(datetime_pcoolingtowera) as day')
				->where('MONTH(datetime_pcoolingtowera) = '.$month)
				->where('YEAR(datetime_pcoolingtowera) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_pcoolingtowera ASC')
				->get('pcoolingtowera')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('pcoolingtowera', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('pcoolingtowera', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pcoolingtowera');
	}

}

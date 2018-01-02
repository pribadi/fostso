<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Mechanicalamodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_mechanicala) as date')
				->select('DAY(datetime_mechanicala) as day')
				->where('MONTH(datetime_mechanicala) = '.$month)
				->where('YEAR(datetime_mechanicala) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_mechanicala ASC')
				->get('mechanicala')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('mechanicala', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('mechanicala', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('mechanicala');
	}

}

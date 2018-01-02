<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Coolingtowermodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_coolingtower) as date')
				->select('DAY(datetime_coolingtower) as day')
				->where('MONTH(datetime_coolingtower) = '.$month)
				->where('YEAR(datetime_coolingtower) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_coolingtower ASC')
				->get('coolingtower')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('coolingtower', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('coolingtower', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('coolingtower');
	}

}

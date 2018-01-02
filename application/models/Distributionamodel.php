<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Distributionamodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_distributiona) as date')
				->select('DAY(datetime_distributiona) as day')
				->where('MONTH(datetime_distributiona) = '.$month)
				->where('YEAR(datetime_distributiona) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_distributiona ASC')
				->get('distributiona')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('distributiona', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('distributiona', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('distributiona');
	}

}

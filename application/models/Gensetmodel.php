<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Gensetmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_genset) as date')
				->select('DAY(datetime_genset) as day')
				->where('MONTH(datetime_genset) = '.$month)
				->where('YEAR(datetime_genset) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_genset ASC')
				->get('genset')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('genset', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('genset', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('genset');
	}

}

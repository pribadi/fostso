<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Rectifier2model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_rectifier2) as date')
				->select('DAY(datetime_rectifier2) as day')
				->where('MONTH(datetime_rectifier2) = '.$month)
				->where('YEAR(datetime_rectifier2) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_rectifier2 ASC')
				->get('rectifier2')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('rectifier2', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('rectifier2', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('rectifier2');
	}

}

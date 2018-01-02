<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Rectifier3model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_rectifier3) as date')
				->select('DAY(datetime_rectifier3) as day')
				->where('MONTH(datetime_rectifier3) = '.$month)
				->where('YEAR(datetime_rectifier3) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_rectifier3 ASC')
				->get('rectifier3')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('rectifier3', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('rectifier3', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('rectifier3');
	}

}

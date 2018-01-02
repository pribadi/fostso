<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Rectifier1model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_rectifier1) as date')
				->select('DAY(datetime_rectifier1) as day')
				->where('MONTH(datetime_rectifier1) = '.$month)
				->where('YEAR(datetime_rectifier1) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_rectifier1 ASC')
				->get('rectifier1')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('rectifier1', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('rectifier1', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('rectifier1');
	}

}

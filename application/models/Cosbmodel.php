<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Cosbmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_cosb) as date')
				->select('DAY(datetime_cosb) as day')
				->where('MONTH(datetime_cosb) = '.$month)
				->where('YEAR(datetime_cosb) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_cosb ASC')
				->get('cosb')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('cosb', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('cosb', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cosb');
	}

}

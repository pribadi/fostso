<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Mechanicalbmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_mechanicalb) as date')
				->select('DAY(datetime_mechanicalb) as day')
				->where('MONTH(datetime_mechanicalb) = '.$month)
				->where('YEAR(datetime_mechanicalb) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_mechanicalb ASC')
				->get('mechanicalb')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('mechanicalb', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('mechanicalb', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('mechanicalb');
	}

}

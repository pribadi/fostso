<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Powerbcrac1model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_powerbcrac1) as day')
					->where('MONTH(datetime_powerbcrac1) = '.$month)
					->where('YEAR(datetime_powerbcrac1) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_powerbcrac1 ASC')
                    ->get('powerbcrac1')->result_array();
		return $data;
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_powerbcrac1) as date')
				->select('DAY(datetime_powerbcrac1) as day')
				->where('MONTH(datetime_powerbcrac1) = '.$month)
				->where('YEAR(datetime_powerbcrac1) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_powerbcrac1 ASC')
				->get('powerbcrac1')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('powerbcrac1', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('powerbcrac1', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('powerbcrac1');
	}

}

<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Batteryacrac2model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_batteryacrac2) as day')
					->where('MONTH(datetime_batteryacrac2) = '.$month)
					->where('YEAR(datetime_batteryacrac2) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_batteryacrac2 ASC')
                    ->get('batteryacrac2')->result_array();
		return $data;
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_batteryacrac2) as date')
				->select('DAY(datetime_batteryacrac2) as day')
				->where('MONTH(datetime_batteryacrac2) = '.$month)
				->where('YEAR(datetime_batteryacrac2) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_batteryacrac2 ASC')
				->get('batteryacrac2')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('batteryacrac2', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('batteryacrac2', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('batteryacrac2');
	}

}

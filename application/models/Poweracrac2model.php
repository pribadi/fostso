<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Poweracrac2model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_poweracrac2) as day')
					->where('MONTH(datetime_poweracrac2) = '.$month)
					->where('YEAR(datetime_poweracrac2) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_poweracrac2 ASC')
                    ->get('poweracrac2')->result_array();
		return $data;
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_poweracrac2) as date')
				->select('DAY(datetime_poweracrac2) as day')
				->where('MONTH(datetime_poweracrac2) = '.$month)
				->where('YEAR(datetime_poweracrac2) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_poweracrac2 ASC')
				->get('poweracrac2')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('poweracrac2', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('poweracrac2', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('poweracrac2');
	}

}

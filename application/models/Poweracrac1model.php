<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Poweracrac1model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_poweracrac1) as day')
					->where('MONTH(datetime_poweracrac1) = '.$month)
					->where('YEAR(datetime_poweracrac1) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_poweracrac1 ASC')
                    ->get('poweracrac1')->result_array();
		return $data;
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_poweracrac1) as date')
				->select('DAY(datetime_poweracrac1) as day')
				->where('MONTH(datetime_poweracrac1) = '.$month)
				->where('YEAR(datetime_poweracrac1) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_poweracrac1 ASC')
				->get('poweracrac1')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('poweracrac1', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('poweracrac1', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('poweracrac1');
	}

}

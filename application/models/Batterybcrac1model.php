<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Batterybcrac1model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_batterybcrac1) as day')
					->where('MONTH(datetime_batterybcrac1) = '.$month)
					->where('YEAR(datetime_batterybcrac1) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_batterybcrac1 ASC')
                    ->get('batterybcrac1')->result_array();
		return $data;
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_batterybcrac1) as date')
				->select('DAY(datetime_batterybcrac1) as day')
				->where('MONTH(datetime_batterybcrac1) = '.$month)
				->where('YEAR(datetime_batterybcrac1) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_batterybcrac1 ASC')
				->get('batterybcrac1')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('batterybcrac1', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('batterybcrac1', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('batterybcrac1');
	}

}

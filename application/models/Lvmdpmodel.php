<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Lvmdpmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_lvmdp) as day')
					->where('MONTH(datetime_lvmdp) = '.$month)
					->where('YEAR(datetime_lvmdp) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_lvmdp ASC')
                    ->get('lvmdp')->result_array();
		return $data;
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_lvmdp) as date')
				->select('DAY(datetime_lvmdp) as day')
				->where('MONTH(datetime_lvmdp) = '.$month)
				->where('YEAR(datetime_lvmdp) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_lvmdp ASC')
				->get('lvmdp')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('lvmdp', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('lvmdp', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('lvmdp');
	}

}

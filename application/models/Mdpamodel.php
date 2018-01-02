<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Mdpamodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_mdpa) as day')
					->where('MONTH(datetime_mdpa) = '.$month)
					->where('YEAR(datetime_mdpa) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_mdpa ASC')
                    ->get('mdpa')->result_array();
		return $data;
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_mdpa) as date')
				->select('DAY(datetime_mdpa) as day')
				->where('MONTH(datetime_mdpa) = '.$month)
				->where('YEAR(datetime_mdpa) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_mdpa ASC')
				->get('mdpa')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('mdpa', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('mdpa', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('mdpa');
	}

}

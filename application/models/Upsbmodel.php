<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Upsbmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_upsb) as date')
				->select('DAY(datetime_upsb) as day')
				->where('MONTH(datetime_upsb) = '.$month)
				->where('YEAR(datetime_upsb) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_upsb ASC')
				->get('upsb')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('upsb', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('upsb', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('upsb');
	}

}

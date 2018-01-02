<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Upsamodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_upsa) as date')
				->select('DAY(datetime_upsa) as day')
				->where('MONTH(datetime_upsa) = '.$month)
				->where('YEAR(datetime_upsa) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_upsa ASC')
				->get('upsa')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('upsa', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('upsa', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('upsa');
	}

}

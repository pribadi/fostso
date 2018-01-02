<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Servermodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_server) as date')
				->select('DAY(datetime_server) as day')
				->where('MONTH(datetime_server) = '.$month)
				->where('YEAR(datetime_server) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_server ASC')
				->get('server')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('server', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('server', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('server');
	}

}

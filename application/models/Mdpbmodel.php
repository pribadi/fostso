<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Mdpbmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_mdpb) as date')
				->select('DAY(datetime_mdpb) as day')
				->where('MONTH(datetime_mdpb) = '.$month)
				->where('YEAR(datetime_mdpb) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_mdpb ASC')
				->get('mdpb')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('mdpb', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('mdpb', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('mdpb');
	}

}

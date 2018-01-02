<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Distributionbmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_distributionb) as date')
				->select('DAY(datetime_distributionb) as day')
				->where('MONTH(datetime_distributionb) = '.$month)
				->where('YEAR(datetime_distributionb) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_distributionb ASC')
				->get('distributionb')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('distributionb', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('distributionb', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('distributionb');
	}

}

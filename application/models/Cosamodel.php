<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Cosamodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_cosa) as day')
					->where('MONTH(datetime_cosa) = '.$month)
					->where('YEAR(datetime_cosa) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_cosa ASC')
                    ->get('cosa')->result_array();
		return $data;
	}	

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_cosa) as date')
				->select('DAY(datetime_cosa) as day')
				->where('MONTH(datetime_cosa) = '.$month)
				->where('YEAR(datetime_cosa) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_cosa ASC')
				->get('cosa')->result_array();

		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('cosa', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('cosa', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cosa');
	}

}

<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Dccrac3model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_dccrac3) as day')
					->where('MONTH(datetime_dccrac3) = '.$month)
					->where('YEAR(datetime_dccrac3) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_dccrac3 ASC')
                    ->get('dccrac3')->result_array();
		return $data;
	}

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_dccrac3) as date')
				->select('DAY(datetime_dccrac3) as day')
				->where('MONTH(datetime_dccrac3) = '.$month)
				->where('YEAR(datetime_dccrac3) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_dccrac3 ASC')
				->get('dccrac3')->result_array();

		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('dccrac3', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('dccrac3', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('dccrac3');
	}

}

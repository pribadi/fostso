<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Dccrac4model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getDatapagi($month, $year)
	{
		$data = $this->db->select('*')
					->select('DAY(datetime_dccrac4) as day')
					->where('MONTH(datetime_dccrac4) = '.$month)
					->where('YEAR(datetime_dccrac4) = '.$year, NULL, FALSE)
                    ->where('shift', 'Pagi')
                    ->order_by('datetime_dccrac4 ASC')
                    ->get('dccrac4')->result_array();
		return $data;
	}

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_dccrac4) as date')
				->select('DAY(datetime_dccrac4) as day')
				->where('MONTH(datetime_dccrac4) = '.$month)
				->where('YEAR(datetime_dccrac4) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_dccrac4 ASC')
				->get('dccrac4')->result_array();

		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('dccrac4', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('dccrac4', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('dccrac4');
	}

}

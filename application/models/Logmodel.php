<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Logmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_log) as date')
				->select('DAY(datetime_log) as day')
				->where('MONTH(datetime_log) = '.$month)
				->where('YEAR(datetime_log) = '.$year, NULL, FALSE)
				->order_by('day ASC, datetime_log ASC')
				->get('log')->result_array();


		// Membuat array baru berdasarkan tanggal dan shift
		function group_by_key ($array) {
	       	$result = array();
	       	foreach ($array as $sub) {
	       		$result[$sub['date']][$sub['shift']][] = $sub;
	       	}
	       	return $result;
	    }

	    $hasil = group_by_key($data);
	    
		return $hasil;
	}

	public function insert($datas)
	{
		return $this->db->insert('log', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('log', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('log');
	}

}

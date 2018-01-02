<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Wiringmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(datetime_wiring) as date')
				->select('TIME(datetime_wiring) as time')
				->where('MONTH(datetime_wiring) = '.$month)
				->where('YEAR(datetime_wiring) = '.$year, NULL, FALSE)
				->order_by('date ASC, floor ASC')
				->get('wiring')
				->result_array();

		// dd($data);

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
		return $this->db->insert('wiring', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('wiring', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('wiring');
	}

}

<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Guestbookmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData($month, $year)
	{
		$data = $this->db->select('*')
				->select('DATE(date_guestbook) as date')
				->select('DAY(date_guestbook) as day')
				->where('MONTH(date_guestbook) = '.$month)
				->where('YEAR(date_guestbook) = '.$year, NULL, FALSE)
				->order_by('day ASC, date_guestbook ASC')
				->get('guestbook')->result_array();
	    
		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('guestbook', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('guestbook', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('guestbook');
	}

}

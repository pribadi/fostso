<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Logactivitymodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getData()
	{
		return $this->db->get('logactivity');
	}

	public function insert($datas)
	{
		return $this->db->insert('logactivity', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('logactivity', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('logactivity');
	}

}

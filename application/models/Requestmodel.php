<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Requestmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}		

	public function getData()
	{
		return $this->db->get('request');
	}

	public function insert($datas)
	{
		return $this->db->insert('request', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('request', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('request');
	}

}
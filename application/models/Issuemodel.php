<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Issuemodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getData()
	{
		$data = $this->db->select('*')
				->order_by('status DESC')
				->get('issue');

		return $data;
	}

	public function insert($datas)
	{
		return $this->db->insert('issue', $datas);
	}

	function update($id,$datas)
	{
		$this->db->where('id', $id);
		$this->db->update('issue', $datas);
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('issue');
	}

}

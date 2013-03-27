<?php
class Admincp_model extends MY_Model {

	function checkLogin($user){
		$this->db->select('*');
		$this->db->where('email', $user);
		$this->db->where('status', 1);
		$query = $this->db->get('cli_user');
		
		foreach ($query->result() as $row){
			$pass = $row->password;
		}
		
		if(!empty($pass)){
			return $pass;
		}else{
			return false;
		}
	}
	
	function getInfo($user){
		$this->db->select('*');
		$this->db->where('email', $user);
		$this->db->where('status', 1);
		$query = $this->db->get('cli_user');

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getSetting($slug=''){
		$this->db->select('*');
		if($slug!=''){
			$this->db->where('slug', $slug);
			$this->db->limit(1);
		}
		$query = $this->db->get('admin_nqt_settings');

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function checkSlug($slug){
		$this->db->select('id');
		$this->db->where('slug', $slug);
		$this->db->limit(1);
		$query = $this->db->get('admin_nqt_settings');

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
}
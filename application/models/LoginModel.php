<?php
class LoginModel extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function auth_user($username, $password){

		$this->db->select('users.*');
		$this->db->from('users');
		$this->db->where('users.status', '1' );
		$this->db->where('users.user_type', 'admin');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query		= 	$this->db->get();
		$num_rows	=	$query->num_rows();

		if($num_rows > 0){
			$result = $query->row_array();
			//Set session value
			$this->session->set_userdata('email', $result['email']);
			$this->session->set_userdata('uid', $result['user_id']);
			$this->session->set_userdata('utype', $result['user_type']);

			return $result;

		}else{

			return $result=0;
		}

	}
	
}
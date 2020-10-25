<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	
	 */
	public function __construct() {
	parent::__construct();
	$this->layout->setLayout('login_layout');
	$this->load->model(array('loginModel'));
	}
	
	public function index()
	{
		$this->data['success_msg']              = $this->session->userdata('successmsg');
        $this->data['err_msg']                  = $this->session->userdata('errmsg');
        $this->session->set_userdata('successmsg', '');
        $this->session->set_userdata('errmsg', '');
		$this->elements['contentHtml']          = 'maincontent/login';
		$this->elements_data['contentHtml']     = $this->data;

		$this->detailsTemplateView();
	}
	public function authUser(){
		//echo $this->input->post('username');
		$data =  array();
		if($_POST){
			$username	= 	$this->input->post('username');
			$password	=	$this->input->post('password');
			$auth_check =	$this->loginModel->auth_user($username, $password);
			$isAdmin	=	$this->session->userdata('uid');

			if(!empty($auth_check) && !empty($isAdmin)){
				
				$this->session->set_userdata('successmsg', "User login successfull!");
				redirect(base_url()."Dashboard");
			}

		}else{

			//
				$this->session->set_userdata('failuremsg', "Oops user login failed");
				redirect(base_url());
		}
	}

	public function logout(){

		$this->session->set_userdata('email');
		$this->session->set_userdata('uid');
		$this->session->set_userdata('utype');
		redirect(base_url());
	}

	private function detailsTemplateView() {
	  $this->layout->getHeader();
	  $this->layout->getFooter();
	  $this->layout->multiple_view($this->elements, $this->elements_data);
	}
}

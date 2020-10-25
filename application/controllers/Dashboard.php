<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	
	 */
	public function __construct() {
	parent::__construct();
	$this->layout->setLayout('master_layout');
	//$this->load->model(array('loginModel'));
		if($this->session->userdata('uid') =='') {
			redirect(base_url());
		}

	}
	
	public function index()
	{
		$this->data['success_msg']              = $this->session->userdata('successmsg');
        $this->data['err_msg']                  = $this->session->userdata('errmsg');
        $this->session->set_userdata('successmsg', '');
        $this->session->set_userdata('errmsg', '');
		$this->elements['contentHtml']          = 'maincontent/dashboard';
		$this->elements_data['contentHtml']     = $this->data;

		$this->detailsTemplateView();
	}


	private function detailsTemplateView() {
	  $this->layout->getHeader();
	  $this->layout->getFooter();
	  $this->layout->getNavbar();
	  $this->layout->multiple_view($this->elements, $this->elements_data);
	}
}

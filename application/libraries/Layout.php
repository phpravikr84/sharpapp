<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    public $obj;
    public $layout;		
	private $themePath = '';
    public $data;
    function __construct($layout = "layout")
    {
        $this->obj =& get_instance();
        $this->layout = $layout;
        $this->data = array();
		//$this->themePath = base_url()."theme-v1/";
		
	}

    function setLayout($layout)
    {
      $this->layout =$layout;
    }

    function view($view, $data=null, $return=false)
    {
		$loadedData = array();
        $loadedData['layout_content'] 				= $this->obj->load->view($view, $data, true);	//string return	
		$loadedData['layout_header'] 				= $this->getHeader();
		$loadedData['layout_nav'] 				    = $this->getNavbar();
		$loadedData['layout_sidebar'] 				= $this->getSidebar();
		$loadedData['layout_footer'] 				= $this->getFooter();


		//print_r($loadedData);exit;
		if($return)
        {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        }
        else
        {
            $this->obj->load->view($this->layout, $loadedData, false);
			
        }
    }
	
		

	private function commonData(){
		$data['themePath'] = $this->themePath ;
		return $data;
	}
	


	public function getHeader(){
		$this->obj->elements['headerHtml'] = 'common/header';
		$this->obj->elements_data['headerHtml'] = $this->data;		
	}	
	public function getFooter(){
		$this->obj->elements['footerHtml'] = 'common/footer';
		$this->obj->elements_data['footerHtml'] = $this->data;		
	}
	public function getSidebar(){
		$this->obj->elements['sidebarHtml'] = 'common/sidebar';
		$this->obj->elements_data['sidebarHtml'] = $this->data;		
	}
	public function getNavbar(){
		$this->obj->elements['navHtml'] = 'common/nav';
		$this->obj->elements_data['navHtml'] = $this->data;		
	}
	
			
	public function multiple_view($view_arr = array(), $data_arr = array(), $return = false){
		//pr($view_arr, 0);pr($data_arr,0);
		$loadedData = array();
		foreach($view_arr as $key => $view){
			$data = null;
			if(isset($data_arr[$key])){
				$data = $data_arr[$key];
			}

			if($view <> ""){
				$loadedData['common'][$key] = $this->obj->load->view($view, $data, true);
			}
		}
        //pr($loadedData);
        if($return){
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        }else{
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }
}
?>

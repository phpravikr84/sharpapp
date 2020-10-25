<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require 'vendor/autoload.php';
//require 'vendor/simple-html-dom/simple_html_dom.php';

class Patient extends CI_Controller{
	/**
	 * Index Page for this controller.
	 *
	
	 */
	public function __construct() {
	parent::__construct();
	$this->layout->setLayout('master_layout');
	$this->load->model(array('Common_model'));
	$this->load->library("simple_html_dom");
	//$this->load->config('tablekey-constants');
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
		$this->elements['contentHtml']          = 'maincontent/patients';
		$this->elements_data['contentHtml']     = $this->data;

		$this->detailsTemplateView();
	}

	public function addPatients(){

		$url = 'assets/static/NHI MZS5407_ ANDERSEN, DANIELLE. DoB_ 28_05_1986.html';
		$now = date('Y-m-d H:i:s');

		if($_POST){

			 //1. *Referral Details ---  #Section2, #Section3
            //HEADING
            $sid = '#Section2';
            $referral_details_heading =  $this->getSectionsData($url, $sid);
            //VALUES
            $sid = '#Section3';
            $referral_details       =  $this->getSectionsData($url, $sid);
			
			$referral_dtls_newHtml = 'assets/static/sections/section_1/referral_details.html';
			$referral_array = $this->filterGenerateNewHtml($referral_dtls_newHtml, $referral_details);
			echo '<pre>';
			//print_r($referral_array);

			/* INSERT RECORD BEGIN */
				$ref_data=array();
				$ref_address ='';
				foreach($referral_array as $ref){

					//echo $ref['title'] .':'.$ref['details']."<br/>";
					if( $ref['title']==REF_NAME ){
						$ref_name = $ref['details'];
					}
					if( $ref['title']==REF_SPECIALITY ){
						$ref_speciality = $ref['details'];
					}
					if( $ref['title']==REF_URGENCY ){
						$ref_urgency = $ref['details'];
					}
					if( $ref['title']==REF_ADDRESS ){
						$ref_address .= $ref['details']."<br/>";
					}
					if( $ref['title']==REF_PHONE ){
						$ref_phone  = $ref['details'];
					}
					if( $ref['title']==REF_FAX  ){
						$ref_fax = $ref['details'];
					}
					if( $ref['title']==REF_SENT && $ref['title'] && $ref['refferral_id'] ){
						$ref_sent = $ref['details']."<br/>";
						$refferral_id = trim(str_replace('Referral ID:', '', $ref['refferral_id']));
					}

				}

				$ref_data[]=array(
									'name'			=> $ref_name,
									'speciality'	=> $ref_speciality,
									'urgency'		=> $ref_urgency,
									'address'		=> $ref_address,
									'phone_number'	=> $ref_phone,
									'fax'			=> $ref_fax,
									'referrral_id'	=> $refferral_id,
									'referral_sent'	=> date('Y-m-d H:i:s', strtotime($ref_sent)),
									'referral_dtls'	=> $referral_details,
									'created_at'	=> $now
					);
				print_r($ref_data);
			/* INSERT RECORD END */

			//END


			 //2. *Patient Details ---  #Section4, #Section5, #Section6,  #Section7, #Section8

            //HEADING
            $sid = '#Section4';
            $patient_details_heading       =  $this->getSectionsData($url, $sid);

            //VALUES_1
            $sid = '#Section5';
            $patient_personal_details      	=  $this->getSectionsData($url, $sid);
            $personal_01_dtls_newHtml 		= 'assets/static/sections/section_1/personal_details01.html';
			$personal__01_array 			= $this->filterGenerateNewHtml($personal_01_dtls_newHtml, $patient_personal_details);

            //VALUES_2
            $sid = '#Section6';
            $patient_address_details        =  $this->getSectionsData($url, $sid);
            $personal_02_dtls_newHtml 		= 'assets/static/sections/section_1/personal_details02.html';
			$personal__02_array 			= $this->filterGenerateNewHtml($personal_02_dtls_newHtml, $patient_address_details);

            //VALUES_3
            $sid = '#Section7';
            $patient_address_postcode       =  $this->getSectionsData($url, $sid);
            $personal_03_dtls_newHtml 		= 'assets/static/sections/section_1/personal_details03.html';
			$personal__03_array 			= $this->filterGenerateNewHtml($personal_03_dtls_newHtml, $patient_address_postcode);

            //VALUES_4
            $sid = '#Section8';
            $patient_personal_details2      =  $this->getSectionsData($url, $sid);
            $personal_04_dtls_newHtml 		= 'assets/static/sections/section_1/personal_details04.html';
			$personal__04_array 			= $this->filterGenerateNewHtml($personal_04_dtls_newHtml, $patient_personal_details2);


			//print_r($personal__01_array);
			//print_r($personal__02_array);
			//print_r($personal__03_array);
			//print_r($personal__04_array);

			/* INSERT PATIENT RECORD BEGIN */
				$patient_data=array();
				$patient_address ='';

				foreach($personal__01_array as $patient){

					if( $patient['title']==PAT_FAM ){
						$patient_family_name = $patient['details'];
					}
					if( $patient['title']==PAT_FIRST ){
						$patient_first_name = $patient['details'];
					}
					if( $patient['title']==PAT_FIRST ){
						$patient_prefferred = strtolower($patient['details']);
					}
					if( $patient['title']==PAT_DOB ){
						$patient_dob = $patient['details'];
					}
					

				}

				foreach($personal__02_array as $patient){

					
					if( $patient['title']==PAT_ADD ){
						$patient_address .= $patient['details']."<br/>";
					}

				}

				foreach($personal__03_array as $patient){

					if( $patient['title']==PAT_POST ){
						$patient_postcode = $patient['details'];
					}

				}

				foreach($personal__04_array as $patient){

					if( $patient['title']==PAT_MOB ){
						$patient_mobile = $patient['details'];
					}
					if( $patient['title']==PAT_FAX ){
						$patient_fax = $patient['details'];
					}
					if( $patient['title']==PAT_WORK ){
						$patient_work = $patient['details'];
					}
					if( $patient['title']==PAT_CSC ){
						$patient_csc = $patient['details'];
					}
					if( $patient['title']==PAT_HUHC ){
						$patient_huhc = $patient['details'];
					}
					if( $patient['title']==PAT_Q4 ){
						$patient_q4 = $patient['details'];
					}
					if( $patient['title']==PAT_Q5 ){
						$patient_q5 = $patient['details'];
					}

				}

				$patient_data = array(
										'firstname'			=> $patient_family_name,
										'lastname'			=> $patient_first_name,
										'preffered_name'	=> $patient_prefferred,
										'dob'				=> $patient_dob,
										'address'			=> $patient_address,
										'postcode'			=> $patient_postcode,
										'mobile_phone'		=> $patient_mobile,
										'home_phone'		=> '',
										'fax'				=> $patient_fax,
										'work_phone'		=> $patient_work,
										'csc_card'			=> $patient_csc,
										'huhc_card'			=> $patient_huhc,
										'q4'				=> $patient_q4,
										'q5'				=> $patient_q5,
										'address_postcode'	=> $patient_personal_details,
										'patient_dtls'		=> $patient_address_details,
										'address_dtls'		=> $patient_address_details,
										'adress_dtls2'		=> $patient_personal_details2,
										'created_at'		=> $now
				);

				print_r($patient_data);

			/* PATIENT RECORD END */

			//PATIENT DTLS END *********************


			 //3. *FUNDING ---  #Section 15 and #Section 16
            //HEADING
            $sid = '#Section15';
            $funding_details_heading	=  $this->getSectionsData($url, $sid);
            //VALUES
            $sid = '#Section16';
            $funding_details 			=  $this->getSectionsData($url, $sid);
			
			$funding_dtls_newHtml = 'assets/static/sections/section_1/funding_details.html';
			$funding_array = $this->filterGenerateNewHtml($funding_dtls_newHtml, $funding_details);
			echo '<pre>';
			//print_r($funding_array);

				/* INSERT PATIENT RECORD BEGIN */
				$funding_data=array();
				
				foreach ($funding_array as $funding) {
					# code...
					
				}

			//END

			 //4. *SERVICE REQUESTED ---  #Section-21, 22
            //HEADING
            $sid = '#Section21';
            $service_req_heading_block	=  $this->getSectionsData($url, $sid);
            $service_req_head_newHtml = 'assets/static/sections/section_1/service_head_details.html';
			$service_head_array = $this->filterGenerateNewHtml($service_req_head_newHtml, $service_req_heading_block);

            //VALUES
            $sid = '#Section22';
            $service_req_details 	=  $this->getSectionsData($url, $sid);
			
			$service_req_newHtml = 'assets/static/sections/section_1/service_details.html';
			$service_array = $this->filterGenerateNewHtml($service_req_newHtml, $service_req_details);
			echo '<pre>';
			print_r($service_head_array);
			print_r($service_array);
			//END

			 //4. *Reffer Details (DOCTOR) ---  #Section 37
            //HEADING
           
            //VALUES
            $sid = '#Section37';
            $doctor_details 	=  $this->getSectionsData($url, $sid);
			
			$doctor_newHtml = 'assets/static/sections/section_1/doctor_details.html';
			$doctor_array = $this->filterGenerateNewHtmlDoctors($doctor_newHtml, $doctor_details);
			echo '<pre>';
			
			print_r($doctor_array);
			//END




            
        // END
			exit;

		}else{

			redirect(base_url().'patients');
		}
	}

	private function getSectionsData($url, $sectionid=''){
      // get DOM from URL or file
		//$instance = new simple_html_dom();
		$sections = array();

        $html = file_get_html($url);
        //echo '<pre>';
        //var_dump($html);
	    if($sectionid){
	        foreach ($html->find($sectionid) as $article) {
	                # code...
	                $sections[] = $article->innertext;
	                return $sections;
	            }
	    }
	}


	private function filterGenerateNewHtml($path='', $filter=''){

			$table_array=array();

			//FILTER EMPTY COLOUMNS BEGIN*********************
			$filter = str_replace('<table cellspacing="0" cellpadding="0" border="0" width="400">', '<table>', $filter);
			$filter = str_replace('<td class="Title"></td>', '',  $filter);
			$filter = str_replace('<td class="Title" width="1"></td>', '', $filter);
			$filter = str_replace('<td class="Data"></td>', '', $filter);
			$filter = str_replace('<tr> <td class="Data" colspan="2"></td> <td class="Data"> </td>  <td class="Data"> </td> </tr>', '', $filter);
			$filter = str_replace('<td class="Data" colspan="2"></td>', '', $filter);
			$filter = str_replace('<td class="Data"> </td>', '', $filter);
			$filter = str_replace('<td class="HelpTitle" width="1"></td>', '', $filter);
			$filter = str_replace('<td class="TitleBold" width="69"> </td>', '', $filter);
			$filter = str_replace('<td class="Title" width="120"> </td>', '', $filter);
			$filter = str_replace('<td class="TitleBold" colspan="2"></td>', '', $filter);
			//FILTER EMPTY COLOUMNS END*********************
			
			//FILE CREATE, UPDATE CONTENT
			$myfile = fopen($path, "w") or die("Unable to open file!");
			$txt = $filter[0];
			fwrite($myfile, $txt);
			fclose($myfile);
			//print_r($referral_details);
			$table_array       =  $this->getTableToArray($path);
			return $table_array;

	}

	private function filterGenerateNewHtmlDoctors($path='', $filter=''){

			$table_array=array();

			//FILTER EMPTY COLOUMNS BEGIN*********************
			$filter = str_replace('<table cellspacing="0" cellpadding="0" border="0" width="400">', '<table>', $filter);
			$filter = str_replace('<td class="Title"></td>', '',  $filter);
			$filter = str_replace('<td class="Title" width="1"></td>', '', $filter);
			$filter = str_replace('<td class="Data"></td>', '', $filter);
			$filter = str_replace('<tr> <td class="Data" colspan="2"></td> <td class="Data"> </td>  <td class="Data"> </td> </tr>', '', $filter);
			$filter = str_replace('<td class="Data" colspan="2"></td>', '', $filter);
			$filter = str_replace('<td class="Data"> </td>', '', $filter);
			$filter = str_replace('<td class="HelpTitle" width="1"></td>', '', $filter);
			$filter = str_replace('<td class="TitleBold" width="69"> </td>', '', $filter);
			$filter = str_replace('<td class="Title" width="120"> </td>', '', $filter);
			$filter = str_replace('<td class="TitleBold" colspan="2"></td>', '', $filter);
			$filter = str_replace('<td class="HelpTitle"></td>', '', $filter);
			//FILTER EMPTY COLOUMNS END*********************
			
			//FILE CREATE, UPDATE CONTENT
			$myfile = fopen($path, "w") or die("Unable to open file!");
			$txt = $filter[0];
			fwrite($myfile, $txt);
			fclose($myfile);
			//print_r($referral_details);
			$table_array       =  $this->getTableToArrayDoctors($path);
			return $table_array;

	}

	private function getTableToArrayDoctors($url){
      // get DOM from URL or file
		//$instance = new simple_html_dom();
		$sections = array();

        $html = file_get_html($url);
        //echo '<pre>';
        //var_dump($html);
        $tableRowId='tr';
	    if($tableRowId){
	        foreach ($html->find($tableRowId) as $article) {
	                # code...Subtitle
	        	if($article){
	        		if($article->find('td.Subtitle', 0)){
	        			$item['subtitle']			= trim($article->find('td.Subtitle', 0)->plaintext);
	        		}
	        		if($article->find('td.TitleBold', 0)){
	        			$item['title']			= trim($article->find('td.TitleBold', 0)->plaintext);
	        		}
	        		if($article->find('td.Title', 0)){
        				// get details
        				$item['details']		= trim($article->find('td.Title', 0)->plaintext);
        			}
        			
        			

        			$ret[] = $item;

	        	}
	              
	        }
	    }
	    		// clean up memory
    			$html->clear();
    			unset($html);

    			return $ret;
	}



	private function getTableToArray($url){
      // get DOM from URL or file
		//$instance = new simple_html_dom();
		$sections = array();

        $html = file_get_html($url);
        //echo '<pre>';
        //var_dump($html);
        $tableRowId='tr';
	    if($tableRowId){
	        foreach ($html->find($tableRowId) as $article) {
	                # code...Subtitle
	        	if($article){
	        		if($article->find('td.Subtitle', 0)){
	        			$item['subtitle']			= trim($article->find('td.Subtitle', 0)->plaintext);
	        		}
	        		if($article->find('td.TitleBold', 0)){
	        			$item['title']			= trim($article->find('td.TitleBold', 0)->plaintext);
	        		}
	        		if($article->find('td.Title', 0)){
        				// get details
        				$item['details']		= trim($article->find('td.Title', 0)->plaintext);
        			}
        			if($article->find('td.CalculateR', 0)){
        				//CalculateR
        				$item['refferral_id'] 	= trim($article->find('td.CalculateR', 0)->plaintext);
        			}
        			if($article->find('td.Data', 0)){
        				//CalculateR
        				$item['details_2'] 	= trim($article->find('td.Data', 0)->plaintext);
        			}

        			$ret[] = $item;

	        	}
	              
	        }
	    }
	    		// clean up memory
    			$html->clear();
    			unset($html);

    			return $ret;
	}


	private function detailsTemplateView() {
	  $this->layout->getHeader();
	  $this->layout->getFooter();
	  $this->layout->getNavbar();
	  $this->layout->multiple_view($this->elements, $this->elements_data);
	}
}
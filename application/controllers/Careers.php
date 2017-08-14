<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Careers extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
		$this->load->model('page_model','page');
		$this->load->model('banner_model','banner');
		$this->load->model('careers_model','career');
		
		$this->load->library('form_validation');
    }
	public function index($type)
	{
		$data = $head	= array();
		$current = $this->uri->segment(1);
		$page			 = $this->page->getPageBySlug($current);	
		
		$banners		 = $this->banner->getPageBannerImagesArray($current);	
		$data['content'] = $page;
		$data['slug'] 	 = $current;
		$data['type'] 	 = $type;
		
		$data['banner_images'] = json_encode($banners);
		$data['jobs'] = $this->career->getLatestJobs();
		//echo "<pre>"; print_r($data['histories']); echo "</pre>"; exit;
		$this->load->view('header',$head);
		$this->load->view('careers',$data);
		$this->load->view('footer');
	}
	public function applynow($job_id){
		
		$current = $this->uri->segment(1);
		$banners		 = $this->banner->getPageBannerImagesArray($current);	
		$data['banner_images'] = json_encode($banners);
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){ //echo "<pre>"; print_r($_POST); echo "</pre>"; exit
		
			$this->form_validation->set_rules('fname', 'first name', 'required|xss_clean');
			$this->form_validation->set_rules('lname', 'last name', 'required|xss_clean');
			$this->form_validation->set_rules('dob', 'date of birth', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
			$this->form_validation->set_rules('phone', 'phone', 'xss_clean');
			$this->form_validation->set_rules('country', 'country', 'xss_clean');
			$this->form_validation->set_rules('address', 'address', 'trim|xss_clean');
			$this->form_validation->set_rules('ct_captcha', 'Security code', 'required|xss_clean');
			
			
			if ($this->form_validation->run() == TRUE )
			{
				$email  	= $this->input->post('email');
				$job_id  	= $this->input->post('job_id');
				$check 		= $this->career->checkApplied($email,$job_id);
				$job_title	= $this->career->getJobTitle($job_id);	
				$security   = $this->input->post('ct_captcha');
				$csrf_token_name          = $this->security->get_csrf_token_name();
				if($check == true ){
					$data['exist_error'] = 'You have already applied for this job.';
				}
				elseif($_FILES["uploaded_file"]["name"] == ''){
					$data['file_error'] = 'Please upload your resume';
				}
				elseif($_FILES["uploaded_file"]["size"] > 2097152){
					$data['file_error'] = 'File size should be less than 2 MB';
				}
				elseif($this->input->post($csrf_token_name)!=$this->security->get_csrf_hash()){
					$data['file_error'] = 'Verfication Failed';
				}
				else{
					/*if($_FILES['uploaded_file']['type'] == 'application/pdf' || $_FILES['uploaded_file']['type'] == 'application/msword' || $_FILES['uploaded_file']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ){*/
					if(mime_content_type($_FILES['uploaded_file']['tmp_name']) == 'application/pdf' || mime_content_type($_FILES['uploaded_file']['tmp_name']) == 'application/msword' || mime_content_type($_FILES['uploaded_file']['tmp_name']) == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ){
						if(strtolower($_SESSION['random_number']) == strtolower($security) ){
								
							$arr['applicants_jobs_id'] 		= $this->input->post('job_id');
							$arr['applicants_fname'] 		= $this->input->post('fname', true);
							$arr['applicants_lname'] 		= $this->input->post('lname', true);
							$arr['applicants_dob'] 			= $this->input->post('dob', true);
							$arr['applicants_email'] 		= $this->input->post('email', true);
							$arr['applicants_phone'] 		= $this->input->post('phone', true);
							$arr['applicants_country'] 		= $this->input->post('country', true);
							$arr['applicants_address'] 		= $this->input->post('address', true);							
							
							$arr['applicants_applied_time']	= time();
							$arr['applicants_ip']			= $_SERVER['REMOTE_ADDR'];
							$arr['applicants_status'] 		= '1';
							
							$application_id = $this->career->insertApplication($arr);	
							
							if($application_id){
								
								if($_FILES['uploaded_file']['error'] == 0){
									if(!file_exists('assets/uploads/cv'))
										mkdir('assets/uploads/cv', 0777, true);
										
									$filename = basename($_FILES['uploaded_file']['name']);
									$ext = substr($filename, strrpos($filename, '.') + 1);
									$filename = md5($_FILES['uploaded_file']['name']).time().".".$ext;
									$newname = 'assets/uploads/cv/'.$filename;
									if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname)) {
										$arr2 = array('applicants_cv' => $filename );
										$arr['applicants_cv']		= $filename ;
										$arr['job_title']			= $job_title ;
										
										$this->career->updateApplication($arr2,$application_id );
										
										$mail = $this->sendApplicationEmailToAdmin($arr);
										$this->sendApplicationEmailToCustomer($arr);				
										$this->session->set_flashdata('success', 'Your Job application has been submitted successfully.');
										redirect('applynow/'.$job_id);
								
									} 
									else{
										$this->career->removeApplication($application_id );
										$data['file_error'] = 'Due to some internal error your resume was not uploaded!!.';
									}
									
								}
								
								
							}
						}
						else{
							$data['file_error'] = 'Your security verification code is wrong.';
						}
					}
					else{
						$data['file_error'] = 'File type should be (.pdf) or (.doc)';
					}
				}
				
			}
			
			
		}	
		
		
		$this->load->view('header',$head);
		$job = $this->career->getJobDetails($job_id);
		if($job){
			$data['job'] 	 = $job;
			$this->load->view('applynow',$data);
		}
		else{
			$this->load->view('applynow-error',$data);
		}
		$this->load->view('footer');
		
	}
	private function sendApplicationEmailToAdmin($user){
		
		
		$data['NAME']			= $user['applicants_fname'].' '.$user['applicants_fname'];
		$data['POSITION']		= $user['job_title'];
		$data['COUNTRY']		= $user['applicants_country'];
		$data['DOB']			= date("M d, Y", strtotime($user['applicants_dob']));
		$data['EMAIL']			= $user['applicants_email'];
		$data['PHONE']			= $user['applicants_phone'];
		$data['MESSAGE']		= $user['applicants_address'];
		
		$to[]				    = $this->config->item('job_application_email')?$this->config->item('job_application_email'):'';
		$cc				        = array('mail_logs1@techmart.solutions','asker@techmart.solutions');
		$cc  					= '';
		
		$attachment = $user['applicants_cv']?FCPATH."assets/uploads/cv/".$user['applicants_cv']:'';
		if($to){
	    	return send_smtp_email(4,$to,$data,$cc,$attachment);
		}
		return false;
	}
	private function sendApplicationEmailToCustomer($user){
		
		$data['NAME']		= $user['applicants_fname'];
		$to[]				= $user['applicants_email'];	
		if($to){	
	   	 	return send_email(5,$to,$data);
		}
	}
	public function captcha(){
		$string = $this->randomSring();
		
		
		$dir = 'assets/fonts/captcha/';
		
		$image = imagecreatetruecolor(165, 50);
		
		// random number 1 or 2
		$num = rand(1,3);
		if($num==1)
		{
			$font = "Capture it 2.ttf"; // font style
			$_SESSION['random_number'] = strtoupper($string);
		}
		elseif($num==2){
			$font = "PlAGuEdEaTH.ttf"; // font style
			$_SESSION['random_number'] = strtolower($string);
		}
		else
		{
			$font = "Walkway rounded.ttf";// font style
			$_SESSION['random_number'] = strtolower($string);
		}
		
		// random number 1 or 2
		$num2 = rand(1,2);
		if($num2==1)
		{
			$color = imagecolorallocate($image, 113, 193, 217);// color
		}
		else
		{
			$color = imagecolorallocate($image, 163, 197, 82);// color
		}
		
		$white = imagecolorallocate($image, 255, 255, 255); // background color white
		imagefilledrectangle($image,0,0,399,99,$white);
		
		imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['random_number']);
		
		header("Content-type: image/png");
		imagepng($image);
	}
	private function randomSring() {
		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 5; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {

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
		$this->load->model('contactus_model','contact');
		
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data = $head	= array();
		$current = $this->uri->segment(1);
		$page			 = $this->page->getPageBySlug($current);	
		
		$banners		 = $this->banner->getPageBannerImagesArray($current);	
		$data['content'] = $page;
		$data['slug'] 	 = $current;
		$data['banner_images'] = json_encode($banners);
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){ //echo "<pre>"; print_r($_POST); echo "</pre>"; exit
		
			$this->form_validation->set_rules('fname', 'first name', 'required|xss_clean');
			$this->form_validation->set_rules('lname', 'last name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
			$this->form_validation->set_rules('phoneForm', 'phone', 'xss_clean');
			$this->form_validation->set_rules('country', 'country', 'xss_clean');
			$this->form_validation->set_rules('comments', 'comments', 'trim|xss_clean');
			$this->form_validation->set_rules('captcha', 'Security code', 'required|xss_clean');
			
			
			if ($this->form_validation->run() == TRUE )
			{
				$arr['fname'] 				= $this->input->post('fname',true);
				$arr['lname'] 				= $this->input->post('lname',true);
				$arr['email'] 				= $this->input->post('email',true);
				$arr['phone'] 				= $this->input->post('phoneForm',true);
				$arr['country'] 			= $this->input->post('country',true);
				$arr['comments']			= $this->input->post('comments',true);
				$arr['contactus_status']	= '1';
				$ajax						= $this->input->post('ajax');
				$captcha  			    	= $this->input->post('captcha');
				$csrf_token_name            = $this->security->get_csrf_token_name();
				if($this->input->post($csrf_token_name)==$this->security->get_csrf_hash()){
					if(strtolower($_SESSION['random_number']) == strtolower($captcha) ){
								
						if($this->contact->insertMessage($arr)){
							$arr['company'] 			= $this->input->post('company',true);
							$mail = $this->sendContactEmailToAdmin($arr);
							
							$this->sendContactEmailToCustomer($arr);
							
							
							$this->session->set_flashdata('success', 'Thank you for contacting us. We will get back to you within 2 business days.');
							redirect('contactus');
						}
						else{
							$data['error'] = 'Your message not submitted. ';	
						}
					}
					else{
						$data['error'] = 'Your security verification code is wrong.';
					}
				}
				else{
						$data['error'] = 'Verification Failed';
					}
			}
		}
		//echo "<pre>"; print_r($head['searches']); echo "</pre>"; exit;
		$this->load->view('header',$head);
		$this->load->view('contactus',$data);
		$this->load->view('footer');
		
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
	private function sendContactEmailToAdmin($user){
		
		
		$data['NAME']			= $user['fname'].' '.$user['lname'];
		$data['COMPANY']		= $user['company'];
		$data['COUNTRY']		= $user['country'];
		$data['EMAIL']			= $user['email'];
		$data['PHONE']			= $user['phone'];
		$data['MESSAGE']		= $user['comments'];
		
		$to[]				    = $this->config->item('contactus_email')?$this->config->item('contactus_email'):'';
		//$cc				    = $this->config->item('contactus_email_cc'); // OR email@domain.com
		$cc						= '';
		
		if($to){		
	   		return send_smtp_email(2,$to,$data,$cc);
		}
		return false;
	}
	private function sendContactEmailToCustomer($user){
		
		
		$data['NAME']		= $user['fname'];
		$to[]				= $user['email'];	
		if($to){		
	   		return send_email(3,$to,$data);
		}
		return false;	
	}
}

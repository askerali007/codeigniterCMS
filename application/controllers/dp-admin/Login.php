<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('login_model','login');
		
		/*if($_SERVER['REMOTE_ADDR'] != '94.200.208.210' ){
			redirect('/');
		}*/
    }
	public function index()
	{
		$data['prfx_admin'] = $this->prfx_admin;
		$logged_in = $this->session->userdata('logged_in');
		$is_admin  = $this->session->userdata('is_admin');
		if($logged_in === TRUE && $is_admin === TRUE ){
			 redirect($this->prfx_admin.'admin/home');
		}
		else{
			$this->load->view('admin/login',$data);
		}
		return false;
	}
	public function reset()
	{
		
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			$useremail = $this->input->post('useremail');
			$user = $this->login->getUserByEmail($useremail);
			if($useremail == ''){
				$this->session->set_flashdata('error', 'Please enter your Email Address.');				
			}
			elseif(empty($user)){
				$this->session->set_flashdata('error', 'There is no user with this Email Address.');
			}
			else{
					$new_password = $this->randomPassword();
					if($this->login->updateUserPassword($new_password, $user->id)){
						if($this->sendPasswordByEmail($user, $new_password)){
							$this->session->set_flashdata('success', 'New password has been sent to this email.');
						}
						else{
							$this->session->set_flashdata('success', 'Email not configured. Your new password is <strong>'.$new_password.'</strong>');
						}
						
					}
					
			}
			redirect($this->prfx_admin.'admin/login/reset');
		}
		
		$this->load->view('admin/login-reset');
		return false;
	}
	public function auth(){
		
		$username  = $this->input->post('username');
		$loginUser = $this->input->post('loginUser');
		$password  = $this->input->post('password');
		//$Password	=  substr($password, 0, -2);
		
		$user = $this->login->doAuthenticateAjax($username,$password);
		
		if($user <= 0){
			if($user == -1)
				$message = '<strong>Failed</strong>!!. Please check your username.';
			if($user== 0 )
				$message = '<strong>Failed</strong>!!. Please check your password.';
			elseif($user == -2 )
				echo "<strong>Failed</strong>!!. your account has disabled. Please contact Administrator.";
			$this->session->set_flashdata('error', $message);
			redirect($this->prfx_admin.'admin/login');
		}
		else{
			$passwordenc = base64_encode($password);
			if($this->input->post('remember') == 1){		
				$hour = time() + 3600*24*365;		
				setcookie('remember_me', $username, $hour);		
				setcookie('remember_pwd', $passwordenc, $hour);		
			}		
			else{			
				if(isset($_COOKIE['remember_me'])) {		
					$past = time() - 100;		
					setcookie('remember_me', '', $past);		
					setcookie('remember_pwd', '', $past);		
				}		
			}
			
			redirect($this->prfx_admin.'admin/home');
		}
		
	}
	public function ajax(){
		$username  = $this->input->post('username');
		$loginUser = $this->input->post('loginUser');
		$password  = $this->input->post('password');
		//$Password	=  substr($loginUser, 0, -2);
		
		$user 		=  $this->login->doAuthenticateAjax($username,$loginUser);
		
		if($user == -1)
			echo "<strong>Failed</strong>!!. Please check your username.";
		elseif($user == 0 )
			echo "<strong>Failed</strong>!!. Please check your password.";
		elseif($user == -2 )
			echo "<strong>Failed</strong>!!. your account has disabled. Please contact Administrator.";
		else{
				
				$passwordenc = base64_encode($loginUser);
				if($this->input->post('remember') == 1){		
					$hour = time() + 3600*24*365;		
					setcookie('remember_me', $username, $hour);		
					setcookie('remember_pwd', $passwordenc, $hour);		
				}		
				else{			
					if(isset($_COOKIE['remember_me'])) {		
						$past = time() - 100;		
						setcookie('remember_me', '', $past);		
						setcookie('remember_pwd', '', $past);		
					}		
				}
				echo "success";
		}
				exit();
		
	}
	public function changepass(){
		$old_pass  = $this->input->post('old_pass');
		$new_pass  = $this->input->post('new_pass');
		$conf_pass = $this->input->post('conf_pass');
		$user_id   = $this->session->userdata('user_id');
		
		if($new_pass == $conf_pass ){ 
			if($this->login->passwordTrue($old_pass, $user_id)){ 
				if($this->login->updateUserPassword($new_pass, $user_id)){
					$this->session->set_flashdata('l_success', 'Your password has been changed successfully.');
				}
				else{
					
					$this->session->set_flashdata('l_error', 'Passwords not updated.!');
						
				}
			}
			else{ 
					$this->session->set_flashdata('l_error', 'Your old password is wrong .!');
						
			}
		}
		else{
				$this->session->set_flashdata('l_error', 'Passwords are not matching.!');
					
		}
		redirect($this->prfx_admin.'admin/home/profile'); 
		
			
		
	}
	public function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('is_admin');
		$this->session->sess_destroy();
		redirect($this->prfx_admin.'admin/login'); 
	}
	private function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	private function sendPasswordByEmail($user, $new_password){
		
		$this->load->helper('custom');
		$data['NAME']		= $user->name;
		$data['PASSWORD']	= $new_password;
		$to[]				= $user->email;
		
	    return send_email(1,$to,$data);
	}
}

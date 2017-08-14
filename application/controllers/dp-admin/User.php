<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		authAdmin();  // Authentication
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('User_model','user');
    }
	public function index()
	{
		redirect($this->prfx_admin.'admin/user/lists');
		
	}
	public function lists(){
		
		
		$data['users'] = $this->user->getAllUsers();
		
		//echo "<pre>"; print_r($data['properties']); exit;
		$this->load->view('admin/header');
		$this->load->view('admin/user/lists', $data);
		$this->load->view('admin/footer');
	}
	public function admins(){
		
		
		$data['admins'] = $this->user->getAllAdmins();
		
		//echo "<pre>"; print_r($data['admins']); exit;
		$this->load->view('admin/header');
		$this->load->view('admin/user/admins', $data);
		$this->load->view('admin/footer');
	}
	
	public function add_admin($id){
		$id = $id?$id:$this->input->post('admin_id');
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			
			$arr['name']      = $this->input->post('name');
			$arr['phone'] 	  = $this->input->post('phone');
			$arr['email'] 	  = $this->input->post('email');
			if($this->input->post('role')){
				$arr['role'] 	  = $this->input->post('role');
			}
			
			if(!$id){
				$arr['user_name'] = $this->input->post('user_name');
				$arr['created_time'] = date("Y-m-d H:i:s");
				$arr['status'] = 'Y';
			}
				
			if($this->input->post('pass') != '' ){
				if($this->input->post('pass') !=  $this->input->post('conf_pass')){
					$this->session->set_flashdata('error', 'Passwords not matching!.');
						redirect($this->prfx_admin.'admin/user/add_admin/'.$id);
				}
				else{
					$pass = $this->input->post('pass');
					$arr['password'] = md5($pass);
					
				}
			}
			
			//
			if($this->user->checkAdmin($this->input->post('user_name'), $id )){
				$this->session->set_flashdata('error', 'User already added!.');
					redirect($this->prfx_admin.'admin/user/add_admin/'.$id);
			}
			else{
				
				if($this->user->updateAdmin($arr, $id)){
					$this->session->set_flashdata('success', 'Details has been updated successfully!.');
					redirect($this->prfx_admin.'admin/user/admins');
				}
				else{
					$this->session->set_flashdata('error', 'Admin not updated!.');
					redirect($this->prfx_admin.'admin/user/admins');
				}
			}
			
		}
		
		
		$data['user'] = $this->user->getOneAdmin($id);
		//echo "<pre>"; print_r($data['user']); echo "</pre>"; exit;
		
		$this->load->view('admin/header');
		$this->load->view('admin/user/add_admin', $data);
		$this->load->view('admin/footer');
		
	}
	
	public function check(){
		$type           = $this->input->post('type');
		$field          = $this->input->post('field');
		$user_id        = $this->input->post('user_id');
		$json['status'] = 'success';
		if($type == 'email'){
			if($this->user->checkUserByEmail($field, $user_id) ){
				$json['status'] = 'error';	
				$json['message'] = 'Email not available!';
			}
		}
		elseif($type == 'username'){
			if($this->user->checkUser($field, $user_id) ){
				$json['status'] = 'error';	
				$json['message'] = 'Username not available!';
			}
		}
		echo json_encode($json); exit;
	}
	public function update($id){
		$id = $id?$id:$this->input->post('user_id');
		$data = array();
		$data['error'] = '';
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			
			$arr['fullname']           = $this->input->post('fullname');
			$arr['hotel_name']            = $this->input->post('hotel_name');
			
			if(!$id){
				$arr['username']         = $this->input->post('username');
				$arr['created_time'] = date('Y-m-d H:i:s');
				$arr['status'] = 'Y';
				$arr['created_ip'] = $_SERVER['REMOTE_ADDR'];
			}
			
			if($this->user->checkUser($this->input->post('username'), $id) ){
				$data['error'] = 'Username exist!.';
			}
			elseif($this->input->post('pass') != '' ){
				if($this->input->post('pass') !=  $this->input->post('conf_pass')){
					$data['error'] = 'Passwords not matching!.';
				}
				else{
					$pass = $this->input->post('pass');
					$arr['password'] = md5($pass);
					
				}
			}
			
			if($data['error'] == '' ){
				if($this->user->updateUser($arr, $id)){
					
					$this->session->set_flashdata('success', 'Details has been updated successfully!.');
					redirect($this->prfx_admin.'admin/user/lists');
				}
				else{
					$data['error'] =  'User not updated!.';
				}
				
			}
			
			$data['user'] = (object)$_POST;
		}
		else{
			$data['user'] = $this->user->getOneUser($id);
		}
		//echo "<pre>"; print_r($data['user']); echo "</pre>"; exit;
		$this->load->view('admin/header');
		$this->load->view('admin/user/update', $data);
		$this->load->view('admin/footer');
		
	}
	
	public function stadmin(){
		$id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('status' =>$status?0:1);
		if($this->user->updateAdmin($arr,$id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	public function status(){
		$id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('status' =>($status=='Y')?'N':'Y');
		if($this->user->updateUser($arr,$id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	public function rmadmin(){
		$id		= $this->input->post('id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		
		$user = $this->user->getOneAdmin($id);
		
		if($this->user->removeAdmin( $user->id )){				
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, admin not removed. ';	
		}
		
			
		echo json_encode($json); exit;
	}
	public function remove(){
		$id		= $this->input->post('id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		
		if($this->user->removeUser( $id )){				
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, user not removed. ';	
		}
		
			
		echo json_encode($json); exit;
	}

	
}

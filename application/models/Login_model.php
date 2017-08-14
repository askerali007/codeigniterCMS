<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

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
    }
	function doAuthenticate($username,$password){
		if(!$password) return false;
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('user_name', $username);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return -1;
		}
		elseif($result->status != 'Y'){
			return -2;
		}
		elseif($result->password == md5(trim($password)) ){
			$user_session['user_id'] 	= $result->id;
			$user_session['name'] 	 	= $result->name;
			$user_session['email'] 	  	= $result->email;
			$user_session['role'] 	  	= $result->role;
			$user_session['logged_in']	= TRUE;
			$user_session['is_admin'] 	= TRUE;
			if( $result->profile_pic != '' && file_exists('assets/uploads/profile/admin/'.$result->profile_pic)){
				$user_session['profile_pic'] 	  	= base_url().'assets/uploads/profile/admin/'.$result->profile_pic;
			}
			else{
				$user_session['profile_pic'] = $this->config->item('admin_template').'img/user2-160x160.jpg';
			}
			$this->updateAdminVisit($result->id);
			$this->session->set_userdata($user_session);
			
			return $result;
		}
		else{
			return 0;
		}
	}
	function doAuthenticateAjax($username,$password){
		if(!$password) return false;
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('user_name', $username);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return -1;
		}
		elseif($result->status != 'Y'){
			return -2;
		}
		elseif($result->password == md5(trim($password)) ){
			$user_session['user_id'] 	= $result->id;
			$user_session['name'] 	 	= $result->name;
			$user_session['email'] 	  	= $result->email;
			$user_session['role'] 	  	= $result->role;
			$user_session['logged_in']	= TRUE;
			$user_session['is_admin'] 	= TRUE;
			if( $result->profile_pic != '' && file_exists('assets/uploads/profile/admin/'.$result->profile_pic)){
				$user_session['profile_pic'] 	  	= base_url().'assets/uploads/profile/admin/'.$result->profile_pic;
			}
			else{
				$user_session['profile_pic'] = $this->config->item('admin_template').'img/user2-160x160.jpg';
			}
			$this->updateAdminVisit($result->id);
			$this->session->set_userdata($user_session);
			return $result;
		}		
		else{
			return 0;			
		}
	}
	function getUserByEmail($email){
		if(!$email) return false;
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('email', $email);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return false;
		}
		else{
			return $result;
		}
	}
	function passwordTrue($password, $user_id ){
		if(!$user_id) return false;
		$this->db->select('user_name');
		$this->db->from('admins');
		$this->db->where('password', md5($password));
		$this->db->where('id', $user_id);
		$query  = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->row();
		if($result) return true;
		else return false;
	}
	function updateUserPassword($password, $user_id){
		if(!$user_id) return false;
		$data=array('password'=> md5($password));
		$this->db->where('id',$user_id);
		$this->db->update('admins',$data);
		return true;
	}
	function updateAdminVisit($id){
		if(!$id) return false;
		$data=array('last_visit'=> date("Y-m-d H:i:s"));
		$this->db->where('id',$id);
		$this->db->update('admins',$data);
		return true;
	}
	
	//******************* Front end ***********************//
	
	function doAuthenticateUser($username,$password){
		if(!$password) return false;
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $username);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return -1;
		}
		elseif($result->status != 'Y'){
			return -2;
		}
		elseif($result->password == md5(trim($password)) ){
			$user_session['user_id'] 	= $result->user_id;
			$user_session['user_parent']= $result->parent_id;
			$user_session['name'] = $result->fullname;
			$user_session['email'] 	  	= $result->email;
			$user_session['logged_in']	= TRUE;
			$user_session['is_customer'] 	= TRUE;
			$this->updateUserVisit($result->user_id);
			$this->session->set_userdata($user_session);
			
			return $result;
		}
		else{
			return 0;
			
		}
	}
	function doAuthenticateUserAjax($username,$password){
		if(!$password) return false;
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $username);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return -1;
		}
		elseif($result->status != 'Y'){
			return -2;
		}
		elseif($result->password == md5(trim($password)) ){
			$user_session['user_id'] 	= $result->user_id;
			$user_session['user_parent']= $result->parent_id;
			$user_session['name'] = $result->fullname;
			$user_session['email'] 	  	= $result->email;
			$user_session['role'] 	  	= $result->role;
			$user_session['logged_in']	= TRUE;
			$user_session['is_customer'] 	= TRUE;
			if( $result->profile_pic != '' && file_exists('assets/uploads/profile/admin/'.$result->profile_pic)){
				$user_session['profile_pic'] 	  	= base_url().'assets/uploads/profile/admin/'.$result->profile_pic;
			}
			else{
				$user_session['profile_pic'] = $this->config->item('admin_template').'img/user2-160x160.jpg';
			}
			$this->updateUserVisit($result->user_id);
			$this->session->set_userdata($user_session);
			return $result;
		}		
		else{
			return 0;			
		}
	}
	function updateUserVisit($id){
		if(!$id) return false;
		$data=array('last_visit'=> date("Y-m-d H:i:s"));
		$this->db->where('user_id',$id);
		$this->db->update('users',$data);
		return true;
	}
	function getCustomerByEmail($email){
		if(!$email) return false;
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return false;
		}
		else{
			return $result;
		}
	}
	function updateCustomerPassword($password, $user_id){
		if(!$user_id) return false;
		$data=array('password'=> md5($password));
		$this->db->where('user_id',$user_id);
		$this->db->update('users',$data);
		return true;
	}
}

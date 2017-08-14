<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

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
    var $query = '';
	
	function __construct()
    {
        parent::__construct();
    }
	
	
	function getAllUsers(){
		$this->db->select('users.*');
		$this->db->from('users');	
		$this->db->order_by('users.user_id','DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function getAllAdmins(){
		$this->db->select('*');
		$this->db->from('admins');	
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function removeAdmin($id){
		if(!$id) return false;
		
		$this->db->where('id', $id);
      	$this->db->delete('admins');
		return true;
	}
	
	function removeUser($id){
		if(!$id) return false;
		
		$this->db->where('user_id', $id);
      	$this->db->delete('users');
		return true;
	}
	
	
	function getOneUser($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('users');	
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function getOneAdmin($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function checkAdmin($admin, $id){
		if(!$admin) return false;
		
		$this->db->select('id');
		$this->db->from('admins');		
		$this->db->where('user_name',$admin);
		if($id)
			$this->db->where('id !=',$id, true);
			
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->num_rows();
		return $result?true:false;
	}
	function checkUser($user, $id){
		if(!$user) return false;
		
		$this->db->select('user_id');
		$this->db->from('users');		
		$this->db->where('username',$user);
		if($id)
			$this->db->where('user_id !=',$id, true);
			
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->num_rows();
		return $result?true:false;
	}
	function checkUserByEmail($email, $id){
		if(!$email) return false;
		
		$this->db->select('user_id');
		$this->db->from('users');		
		$this->db->where('email',$email);
		if($id)
			$this->db->where('user_id !=',$id, true);
			
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->num_rows();
		return $result?true:false;
	}
	function updateUser($arr, $id){
		if($id > 0 ) {
			$this->db->where('user_id',$id);
			return $this->db->update('users',$arr);
			//echo $this->db->last_query(); exit;
			
		}
		else{
			$this->db->insert('users',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
			$this->sendEmailToUser($arr);
			
		}
		return $id;
	}
	
	function updateAdmin($arr, $id){
		if($id > 0 ) {
			$this->db->where('id',$id);
			$this->db->update('admins',$arr);
			//echo $this->db->last_query(); exit;
			
		}
		else{
			$this->db->insert('admins',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
		}
		return $id;
	}
	function updateUserPassword($password, $user_id){
		if(!$user_id) return false;
		$data=array('password'=> md5($password));
		$this->db->where('user_id',$user_id);
		$this->db->update('users',$data);
		return true;
	}
	function passwordTrue($password, $user_id ){
		if(!$user_id) return false;
		$this->db->select('username');
		$this->db->from('users');
		$this->db->where('password', md5($password));
		$this->db->where('user_id', $user_id);
		$query  = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->row();
		if($result) return true;
		else return false;
	}
	function getAvailableFiles($user_id, $filter='', $start, $limit){	
		if(!$user_id) return false;
		
		$sql = "SELECT file.*, file_map.is_read, file_cat.category_name 
				FROM files file 
				INNER JOIN files_user_map file_map 
					ON `file_map`.`file_id`=`file`.`file_id` 
				LEFT JOIN files_category file_cat 
					ON (`file_cat`.`category_id`=`file`.`category_id` AND `file_cat`.`status` = 'Y') 
				WHERE `file_map`.`user_id` = '".$user_id."' AND `file`.`status` = 'Y' AND `file_cat`.`status` = 'Y' ";
			if($filter['cat'])	
				$sql .= " AND `file`.`category_id` = '".$filter['cat']."'";
			if($filter['s']){	
				$sql .= " AND  (`file`.`file_title` LIKE '%".$filter['s']."%' ESCAPE '!'
				OR  `file`.`file_name` LIKE '%".$filter['s']."%' ESCAPE '!'
				OR  `file_cat`.`category_name` LIKE '%".$filter['s']."%' ESCAPE '!' )" ;
			}
			$sql .= " ORDER BY `file_map`.`assigned_time` DESC";
			$sql .= " LIMIT $start, $limit";
		$query  = $this->db->query($sql);
	    //echo $this->db->last_query(); exit;
		$result = $query->result();
		return $result;
	}
	function getTotalAvailableFiles($user_id, $filter=''){	
		if(!$user_id) return false;
		
		$sql = "SELECT file.file_id
				FROM files file 
				INNER JOIN files_user_map file_map 
					ON `file_map`.`file_id`=`file`.`file_id` 
				LEFT JOIN files_category file_cat 
					ON (`file_cat`.`category_id`=`file`.`category_id` AND `file_cat`.`status` = 'Y') 
				WHERE `file_map`.`user_id` = '".$user_id."' AND `file`.`status` = 'Y' AND `file_cat`.`status` = 'Y' ";
			if($filter['cat'])	
				$sql .= " AND `file`.`category_id` = '".$filter['cat']."'";
			if($filter['s']){	
				$sql .= " AND  (`file`.`file_title` LIKE '%".$filter['s']."%' ESCAPE '!'
				OR  `file`.`file_name` LIKE '%".$filter['s']."%' ESCAPE '!'
				OR  `file_cat`.`category_name` LIKE '%".$filter['s']."%' ESCAPE '!' )" ;
			}
			
		$query  = $this->db->query($sql);
	    //echo $this->db->last_query(); exit;
		$result = $query->num_rows();
		return $result;
	}
	
	function getFileDetails($user_id, $file_id){	
		if(!$file_id) return false;
		
		$this->db->select('files.*');
		$this->db->from('files');
		$this->db->join('files_user_map', 'files_user_map.file_id=files.file_id ','inner', true);
		$this->db->where('files.file_id', $file_id);
		$this->db->where('files_user_map.user_id', $user_id);
		$query  = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->row();
		return $result;
	}
	function getAllFiles($user_id){	
		if(!$user_id) return false;
		
		$this->db->select('files.*');
		$this->db->from('files');
		$this->db->join('files_user_map', 'files_user_map.file_id=files.file_id ','inner', true);
		$this->db->where('files_user_map.user_id', $user_id);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function getUserCategories($user_id, $filter=''){
		if(!$user_id) return false;
		$this->db->select('files.category_id, files_category.category_name');
		$this->db->from('files');
		$this->db->join('files_user_map', 'files_user_map.file_id=files.file_id ','inner', true);
		$this->db->join('files_category', '(files_category.category_id=files.category_id AND files_category.status = "Y") ','left');
		$this->db->where('files_user_map.user_id', $user_id);
		$this->db->where('files.status', 'Y');
		$this->db->where('files_category.status', 'Y');
		
		$this->db->group_by('files.category_id');
		$query  = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->result();
		return $result;
	}
	private function sendEmailToUser($user){
		
		$this->load->helper('custom');
		$data['FNAME']		= $user['first_name'];
		$data['PASSWORD']	= $this->input->post('pass');
		$data['USER_NAME']	= $user['username'];
		$to[]				= $user['email'];
		
	    return send_email(6,$to,$data);
	}
}

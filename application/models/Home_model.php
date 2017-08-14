<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

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
		
	function getHomepageContents($ids){
		
		$this->db->select('p.*');
		$this->db->from('pages p');
		if($ids){
			$this->db->where_in('page_id',$ids);
		}
		
		$this->db->where('status','Y');	
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getLatestNews(){
		
		$this->db->select('*');
		$this->db->from('breakingnews');	
		$this->db->where('breakingnews_status','1');	
		$this->db->order_by('breakingnews_id','DESC');
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getAllStatics()
	{
			$output = array();
			$output['pages'] =  $this->getValue("SELECT COUNT(page_id) as total FROM dp_pages WHERE status = 'Y'");	
			$output['managements'] 	 =  $this->getValue("SELECT COUNT(team_id) as total FROM dp_managent_teams");	
			$output['history'] =  $this->getValue("SELECT COUNT(history_id) as total FROM dp_history WHERE history_status = '1'");	
			$output['newses'] =  $this->getValue("SELECT COUNT(breakingnews_id) as total FROM dp_breakingnews WHERE breakingnews_status = '1'");	
			$output['inquiries'] =  $this->getValue("SELECT COUNT(contactus_id) as total FROM dp_contactus  ");	
			$output['applications'] =  $this->getValue("SELECT COUNT(DISTINCT applicants_id) as total 
										FROM dp_applicants WHERE applicants_status = '1'");	
			
			return $output;
	}
	function updateUserPrimaryDetails($arr, $user_id){
		if(!$user_id) return false;
			$this->db->where('id',$user_id);
			$this->db->update('admins',$arr);
		
		return $user_id;
	}
	function getUserById($id){
		if(!$id) return false;
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('id', $id);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return false;
		}
		else{
			return $result;
		}
	}
	private function getValue($query){
		return $this->db->query($query)->row()->total;
	}
	
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management_model extends CI_Model {

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
	function getManagementTeams(){
		
		$this->db->select('*');
		$this->db->from('managent_teams');
		$this->db->order_by('sort_order','ASC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getAllManagements(){
		$this->db->select('*');
		$this->db->from('managent_teams');
		$this->db->order_by('sort_order','ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function removeManagement($id){
		if(!$id) return false;
		
		$this->db->where('team_id', $id);
      	$this->db->delete('managent_teams');
		return true;
	}
	function getOneManagement($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('managent_teams');	
		$this->db->where('team_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function updateManagement($arr, $id){
		if($id > 0 ) {
			$this->db->where('team_id',$id);
			$this->db->update('managent_teams',$arr);
			//echo $this->db->last_query(); exit;
			
		}
		else{
			$this->db->insert('managent_teams',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
		}
		return $id;
	}
	function getCount(){
		return $this->db->get('managent_teams')->num_rows();
	}
	
	
	
}

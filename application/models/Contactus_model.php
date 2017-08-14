<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus_model extends CI_Model {

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
	function insertMessage($arr){
		
		$this->db->insert('contactus',$arr);
		//echo $this->db->last_query(); exit;
		$id = $this->db->insert_id();
		
		return $id;
	}
	function getCountries(){
		
		return $this->db->get('countries')->result();
		
	}
	function getAllContacts(){
		$this->db->select('contactus.*');
		$this->db->from('contactus');	
		$this->db->order_by('contactus_id','DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function removeContact($id){
		if(!$id) return false;
		
		$this->db->where('contactus_id', $id);
      	$this->db->delete('contactus');
		return true;
	}
	
	
	function getOneContact($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('contactus');	
		$this->db->where('contactus_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
}

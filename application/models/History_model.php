<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {

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
	function getHistoryContents(){
		$this->db->select('*');
		$this->db->from('history');
		$this->db->where('history_status','1');	
		$this->db->order_by('history_year','ASC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	/*******Admin***********/
	function getAllHistories(){
		$this->db->select('*');
		$this->db->from('history');
		$this->db->order_by('history_id','DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function removeHistory($id){
		if(!$id) return false;
		
		$this->db->where('history_id', $id);
      	$this->db->delete('history');
		return true;
	}
	function getOneHistory($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('history');	
		$this->db->where('history_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function updateHistory($arr, $id){
		if($id > 0 ) {
			$this->db->where('history_id',$id);
			$this->db->update('history',$arr);
			//echo $this->db->last_query(); exit;
			
		}
		else{
			$this->db->insert('history',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
		}
		return $id;
	}
	function getCount(){
		return $this->db->get('history')->num_rows();
	}
	function checkYearAdded($year,$id){
		
		$this->db->select('history_id');
		$this->db->from('history');
		$this->db->where('history_year', $year);
		if($id)	
			$this->db->where('history_id !=', $id);
		$query  = $this->db->get();
	
		if ($query->num_rows() > 0)
			return true;
		else
			return false;

	}
	
}

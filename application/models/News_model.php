<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

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
	function getLatestNews(){
		$this->db->select('*');
		$this->db->from('breakingnews');
		$this->db->where('breakingnews_status','1');
		$this->db->order_by('breakingnews_id','DESC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getNewsDetails($news_id){
		$this->db->select('*');
		$this->db->from('breakingnews');
		$this->db->where('breakingnews_status','1');
		$this->db->where('breakingnews_id',$news_id);
		
		$query = $this->db->get();
		$results = $query->row();
	
		return $results;
	}
	/*******Admin***********/
	function getAllNewses(){
		$this->db->select('*');
		$this->db->from('breakingnews');
		$this->db->order_by('breakingnews_id','DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function removeNews($id){
		if(!$id) return false;
		
		$this->db->where('breakingnews_id', $id);
      	$this->db->delete('breakingnews');
		return true;
	}
	function getOneNews($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('breakingnews');	
		$this->db->where('breakingnews_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function updateNews($arr, $id){
		if($id > 0 ) {
			$this->db->where('breakingnews_id',$id);
			$this->db->update('breakingnews',$arr);
			//echo $this->db->last_query(); exit;
			
		}
		else{
			$this->db->insert('breakingnews',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
		}
		return $id;
	}
	function getCount(){
		return $this->db->get('breakingnews')->num_rows();
	}
	
	
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

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
	
	function getNavMenuItems(){
		
		$this->db->select('*');
		$this->db->from('navmenu_items');
		$this->db->where('type_id','1');	
		$this->db->where('status','Y');
		$this->db->order_by('display_order','ASC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getMenuHierarchy(){
		
		$this->db->select('n.*, IFNULL(n1.menu_title_en,"None") as parent_name',true);
		$this->db->from('navmenu_items n');		
		$this->db->join('navmenu_items n1','n.parent_id = n1.menu_id','left');		
		
		$this->db->where('n.status','Y');
		$this->db->order_by('n1.display_order','ASC');
		$this->db->order_by('n.display_order','ASC');
		$query = $this->db->get();
		$results = $query->result();
		for($i=0;$i<count($results);$i++ ){
			$result = $results[$i];
			
			if($result->parent_id > 0 ) {
				$output[$result->parent_id]->child[] = $result;
				//unset($results[$i]);
			}
			else{
				$output[$result->menu_id] = $result;	
			}
		}
		//echo "<pre>"; print_r($output); exit;
		
		return $output;
	}
	function getOneMenu($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('navmenu_items');		
		$this->db->where('menu_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	
	
	
}

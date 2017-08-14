<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

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
	
	function getPageBySlug($slug){
		if(!$slug) return false;
		
		$this->db->select('*');
		$this->db->from('pages p');
		$this->db->where('p.page_name',$slug);		
		$query = $this->db->get();
		
		$results = $query->row();
		return $results;
	}
	function getPageById($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('pages p');
		$this->db->where('p.page_id',$id);	
		$query = $this->db->get();
		$results = $query->row();
	
		return $results;
	}
	/*function getRelatedLinks($current){
		if($current == '' ) return false;
		
		$this->db->select('n2.*');
		$this->db->from('navmenu_items n1');
		$this->db->from('navmenu_items n2', 'n1.parent_id = n2.parent_id','inner');
		$this->db->where('n1.menu_link',$current);	
		$query = $this->db->get();
		$childs = $query->result();
		$page->childs = $childs;
		return $page;
	}*/
	function getMenuBySlug($slug){
		if(!$slug) return false;
		
		$this->db->select('*');
		$this->db->from('navmenu_items n');
		$this->db->where('n.menu_link',$slug);	
		$query = $this->db->get();
		$results = $query->row();
	
		return $results;
	}
	function getParentMenuBySlug($slug){
		if(!$slug) return false;
		
		$this->db->select('n2.*');
		$this->db->from('navmenu_items n');
		$this->db->join('navmenu_items n2', 'n2.menu_id = n.parent_id','inner');
		$this->db->where('n.menu_link',$slug);	
		$query = $this->db->get();
		$results = $query->row();
	
		return $results;
	}
	function getRelatedLinks($current){
		if($current == '' ) return false;
		$menu = $this->getParentMenuBySlug($current);
		
		$this->db->select('n1.*');
		$this->db->from('navmenu_items n1');
		$this->db->where('n1.parent_id',$menu->menu_id);	
		$query = $this->db->get();
		$childs = $query->result();
		$menu->childs = $childs;
		return $menu;
	}
	function getPrimaryPages($current){
		if($current == '' ) return false;
		
		$this->db->select('p2.*');
		$this->db->from('pages p1');
		$this->db->join('pages p2', '(p2.parent_id = p1.page_id AND p2.is_primary = "Y")','inner');
		$this->db->where('p1.page_name',$current);	
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;
	}
	function getSubPages($current){
		if($current == '' ) return false;
		
		$this->db->select('p2.*');
		$this->db->from('pages p1');
		$this->db->join('pages p2', '(p2.parent_id = p1.page_id AND p2.is_primary != "Y")','inner');
		$this->db->where('p1.page_name',$current);	
		$this->db->order_by('p2.sort_order','ASC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;
	}
	/********* Admin **********/
	function getAllPages(){
		
		$this->db->select('p.*, IFNULL(p1.page_title_en,"None") as parent_name',true);
		$this->db->from('pages p');		
		$this->db->join('pages p1','p.parent_id = p1.page_id','left');		
		
		$this->db->where('p.page_type','page');
		$this->db->order_by('p1.sort_order','ASC');
		$this->db->order_by('p.sort_order','ASC');
		$query = $this->db->get();
		$results = $query->result();
		for($i=0;$i<count($results);$i++ ){
			$result = $results[$i];
			
			if($result->parent_id > 0 ) {
				$output[$result->parent_id]->child[] = $result;
				//unset($results[$i]);
			}
			else{
				$output[$result->page_id] = $result;	
			}
		}
		//echo "<pre>"; print_r($output); exit;
		return $output;
	}
	function getPageDetails($id){
		if(!$id) return false;
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('page_id', $id);
		$query  = $this->db->get();
		$result = $query->row();
		
		if(empty($result)){
			return false;
		}
		else{
			return $result;
		}
	}
	function getParentPages($id){
		
		$this->db->select('*');
		$this->db->from('pages');		
		$this->db->where('status','Y');
		$this->db->where('page_type','page');
		$this->db->where('parent_id',0);
		if($id){
			$this->db->where('page_id !=',$id);
		}
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function getPageCount($parent_id){
		$this->db->select('page_id');
		$this->db->from('pages');	
		$this->db->where('page_type','page');
		$this->db->where('parent_id', $parent_id);
		
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result+1;
	}
	
	function updateParentNull($id){
		if(!$id) return false;
			$arr['parent_id'] = 0;
		
			$this->db->where('parent_id',$id);
			$this->db->update('pages',$arr);
		
		return $id;
	}
	function updatePage($arr, $id){
		if($id > 0 ) {
			$this->db->where('page_id',$id);
			$this->db->update('pages',$arr);
		}
		else{
			$this->db->insert('pages',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
		}
		return $id;
	}
	function removePage($id){
		if(!$id) return false;
		
		$this->db->where('page_id', $id);
      	$this->db->delete('pages');
		return true;
	}
	
}

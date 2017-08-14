<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

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
	
	function getNavMenus(){
		
		 $this->db->select('*');
		 $this->db->from('navmenus'); 
		 $this->db->where('status', 'Y'); 
		 $this->db->order_by('display_order', 'ASC'); 
         $query = $this->db->get();
        // $results = $query->result();
		$k		= 0;
		$class = 'class="active" ';
	    $html = '<ol class="sortable">'; //init
		//$html .= "<li>";
		//$html .= "<div><a href='".base_url()."'>Home</a></div>";
		//$html .= "</li>";
		foreach ($query->result() as $row) { 
			
				
			if ($row->parent_id == '0') {
				$k++;
				$html .= "<li id='".$row->menu_id."' class='parent' data-order='".$k."'>";
				
				//we have a category
				switch($row->meu_type){
					case 'page':
					$html .= "<div><a target='_blank' href='".base_url()."page/".$row->menu_link."'>" . $row->menu_title . "</a><span>[".$row->meu_type."]</span><span class='remove_menu pull-right'><i class='fa fa-trash'></i></span></div>";
					break;
					case 'category':
					
					break;
					case 'custom':
					default:
					$html .= "<div><a target='_blank' href='".$row->menu_link."'>" . $row->menu_title ."</a><span>[".$row->meu_type."]</span><span class='remove_menu pull-right'><i class='fa fa-trash'></i></span></div>";
					break;
				}
				
				$html .= "<ol>";
				$l     = 0;
				foreach ($query->result() as $subcat) { 
				
					if ($subcat->parent_id == $row->menu_id) {
						//we have a subcategory
						$l++;
						$html .= "<li id='".$subcat->menu_id."' class='child' data-order='".$l."'>";
						switch($subcat->meu_type){
							case 'page':
							$html .= "<div><a target='_blank' href='".base_url()."page/".$subcat->menu_link."'>" . $subcat->menu_title ."</a><span>[".$subcat->meu_type."]</span><span class='remove_menu pull-right'><i class='fa fa-trash'></i></span></div>";
							break;
							case 'category':
							
							break;
							case 'custom':
							default:
							$html .= "<div><a target='_blank' href='".$subcat->menu_link."'>" . $subcat->menu_title."</a><span>[".$subcat->meu_type."]</span><span class='remove_menu pull-right'><i class='fa fa-trash'></i></span></div>";
							break;
						}
						$html .= "</li>";
					}
				
				}
				$html .= "</ol>";
				
				$html .= "</li>";
			}
				
			
				
		}
		$html .= "</ol>";
		return $html;  
	
	}
	function getNavMenusList(){
		
		 $this->db->select('*');
		 $this->db->from('navmenus'); 
		 $this->db->where('status', 'Y'); 
		 $this->db->order_by('display_order', 'ASC'); 
         $query = $this->db->get();
         $results = $query->result();
		 
		return $results;  
	
	}
	function removeMenu(){
		if(!$id) return false;
		
		$this->db->where('menu_id', $id);
      	$this->db->delete('navmenus');
		return true;
	}
	function updateMenu($arr, $id){
		if($id > 0 ) {
			$this->db->where('menu_id',$id);
			$this->db->update('navmenus',$arr);
		}
		else{
			$this->db->insert('navmenus',$arr);
			$id = $this->db->insert_id();
		}
		return $id;
	}
	function updateEmail($arr, $id){
		if($id > 0 ) {
			$this->db->where('email_id',$id);
			return $this->db->update('general_emails',$arr);
			//echo $this->db->last_query(); exit;
			
		}
		else{
			$this->db->insert('general_emails',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
		}
		return $id;
	}
	function checkConfig($key){
		$this->db->select('config_id');
		$this->db->from('general_config');
		$this->db->where('config_var',$key);
		$query = $this->db->get();
        $row = $query->row();
		 
		return $row->config_id?true:false; 
	}
	function updateConfig($arr, $var){
		if($var) {
			$this->db->where('config_var',$var);
			return $this->db->update('general_config',$arr);
			
		}
		return false;
	}
	function addConfig($arr,$key){
		$arr['config_title'] = 'Theme custom';
		$arr['config_var'] 	 = $key;
		$arr['can_edit'] 	 = 'N';	
		$this->db->insert('general_config',$arr);
			
		return $this->db->insert_id();
	}
	
	function getEmailDetails($email_id){
		if(!$email_id) return false;
		
		$this->db->select('*');
		$this->db->from('general_emails');
		$this->db->where('email_id',$email_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function getAllEmails(){
		$this->db->select('*');
		$this->db->from('general_emails');	
		$this->db->order_by('email_id','DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function getConfigs(){
		$this->db->select('*');
		$this->db->from('general_config');	
		$this->db->where('can_edit','Y');
		$this->db->order_by('config_id','ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function getPageList(){
		$this->db->select('*');
		$this->db->from('pages');	
		$this->db->where('parent_id', 0);
		$this->db->where('status','Y');
		$query = $this->db->get();
		$result = $query->result();
		$pages[0] = 'Select page';
		foreach($result as $row ){
			$pages[$row->page_id] = $row->page_title;
		}
		return $pages;
		
	}
	
	
}

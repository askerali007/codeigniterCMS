<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Custom_config{
    public $this;
    public function __construct()
    {
		$this->cc = & get_instance();
		$this->cc->db->select('*');
		$this->cc->db->from('general_config'); 
        $query = $this->cc->db->get();
        $results = $query->result();
		if($results){
			foreach($results  as $result){
				if($result->config_var != '')
					$this->cc->config->set_item($result->config_var, $result->config_value);
			}
		}
		
		$menus = $this->navMenuItems();
		$this->cc->config->set_item('navMenus', $menus);
		
		$parentMenu = $this->getCurrentMenu();
		$this->cc->config->set_item('parentMenu', $parentMenu);
		//$banners = $this->getBanners();	
		//$this->cc->config->set_item('banners', $banners);
		
		### MEta Data##4
		$pageSlug = $this->cc->uri->segment(1);
		$this->cc->db->select('page_title_en, meta_title, meta_key, meta_desc');
		$this->cc->db->from('pages'); 
		$this->cc->db->where('page_name',$pageSlug); 
        $query = $this->cc->db->get();
        $meta = $query->row();
		
		if($meta->page_title_en)
			$this->cc->config->set_item('meta_title', $meta->meta_title?$meta->meta_title:$meta->page_title_en);
		if($meta->meta_key)
			$this->cc->config->set_item('meta_keys', $meta->meta_key);
		if($meta->meta_desc)
			$this->cc->config->set_item('meta_desc', $meta->meta_desc);
		
    }
	public function navMenuItems(){
		
		$this->cc = & get_instance();
		$this->cc->load->model('menu_model','menu');
		$menus = $this->cc->menu->getNavMenuItems();	
		return $menus;
	}
    public function getBanners(){
		$current_menu = $this->cc->uri->segment(1);
		$this->cc->load->model('banner_model','banner');
		$banners = $this->cc->banner->getBanners($current_menu);	
		return $banners;
	}
    public function getCurrentMenu(){
		$current_menu = $this->cc->uri->segment(1);
		$this->cc->db->select('n2.menu_link as current_menu');
		$this->cc->db->from('navmenu_items n1'); 
		$this->cc->db->join('navmenu_items n2', 'n1.parent_id = n2.menu_id','left');
		$this->cc->db->where('n1.menu_link',$current_menu); 
        $query = $this->cc->db->get();
		//echo $this->cc->db->last_query(); exit;
        $results = $query->row();	
		return $results->current_menu;
	}
}
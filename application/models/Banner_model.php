<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {

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
	function getHomeBanners(){
		
		$this->db->select('*');
		$this->db->from('banners');
		$this->db->where('banners_menus_id','1');	
		$this->db->where('banners_status','1');	
		$this->db->order_by('banners_order','ASC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getBanners($current_menu){
		
		$this->db->select('*');
		$this->db->from('banners b');
		$this->db->join('navmenu_items n', 'n.menu_id = b.banners_menus_id', 'inner');
		$this->db->where('n.menu_link',$current_menu);
		$this->db->where('b.banners_status', '1');
		$this->db->order_by('display_order','ASC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getPageBannerImagesArray($current_menu){
		if(!$current_menu) return false;
		
		$base_url = base_url('assets/images/banner');
		$this->db->select("CONCAT('".$base_url."/',banners_image) as image",true);
		$this->db->from('banners b');
		$this->db->join('navmenu_items n', 'n.menu_id = b.banners_menus_id', 'inner');
		$this->db->where('n.menu_link',$current_menu);	
		$this->db->where('b.banners_status','1');	
		$this->db->order_by('banners_order','ASC');
		
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$results = $query->result_array();
		if($results){
			$images = array_column($results, 'image');
			return $images;
		}
		else
			return false;
	}
	function getAllBanners(){
		
		
		/*$this->db->select('n.*, IFNULL(n1.menu_title_en,"None") as parent_name',true);
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
		}*/
		
		//##########################/
		
		$this->db->select("b.banners_menus_id as menu_id, ni.menu_title_en as name, GROUP_CONCAT(banners_image SEPARATOR '[#]') as images");
		$this->db->from('banners b');	
		$this->db->join('navmenu_items ni','ni.menu_id = b.banners_menus_id','inner');		
		$this->db->group_by('b.banners_menus_id');
		
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		$result = $query->result();
		return $result;
		
	}
	function getAllBannerImages(){
		$this->db->select('banners_image, banners_menus_id');
		$this->db->from('banners b');
		$this->db->group_by('banners_image');
		$query = $this->db->get();
		
		$results = $query->result();
	
		return $results;
	}
	function getMenuBanners($id){
		
		$this->db->select('*');
		$this->db->from('banners b');
		$this->db->where('b.banners_menus_id', $id);
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getBanner($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('banners');		
		$this->db->where('banners_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function removeBanner($id){
		if(!$id) return false;
		
		$this->db->where('banners_id', $id);
      	$this->db->delete('banners');
			return true;
	}
	function insertMenuBanner($arr){
		
		$this->db->insert('banners',$arr);
		
		$id = $this->db->insert_id();
		
		return $id;
	}
	function getCount($id){
		if(!$id)
			$count =  $this->db->get('banners')->num_rows();
		else{
			$this->db->select('banners_menus_id');
			$this->db->from('banners');		
			$this->db->where('banners_menus_id',$id);
			$query = $this->db->get();
			$count =  $query->num_rows();
		}
		return $count+1;
	}
	function checkBannerExists($image){
		if(!$image) return false;
		
		$this->db->select('banners_id');
		$this->db->from('banners');		
		$this->db->where('banners_image',$image);
		$query = $this->db->get();
		$result = $query->num_rows();
		return ($result>0)?true:false;
	}
	
}

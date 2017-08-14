<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

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
		authAdmin();  // Authentication
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('Page_model','page');
		$this->load->model('Banner_model','banner');
		$this->load->model('Menu_model','menu');
		
    }
	public function index()
	{
		
		
	}
	public function lists(){
		
		$data['pages'] = $this->page->getAllPages();
		
		$this->load->view('admin/header');
		$this->load->view('admin/page/lists', $data);
		$this->load->view('admin/footer');
	}
	public function update($page_id){
		$page_id = $page_id?$page_id:$this->input->post('page_id');
		$data['page'] = $this->page->getPageDetails($page_id);
		
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			$arr['parent_id']  	= $this->input->post('parent_id');
			$arr['page_title_en']  	= $this->input->post('page_title_en');
			$arr['is_primary']  	= ($this->input->post('is_primary')=='Y')?$this->input->post('is_primary'):'N';
			$arr['page_excerpt_en'] = $this->input->post('page_excerpt_en');
			$arr['page_content_en'] = $this->input->post('page_content_en');
			$arr['page_name']  		= $this->input->post('page_name')?$this->input->post('page_name'):pageSlug($this->input->post('page_title'));	
			$arr['updated_date']  	= date('Y-m-d H:i:s');
			$arr['user_id']  		= $this->session->userdata('user_id')?$this->session->userdata('user_id'):1;
			
			$arr['meta_title']      = $this->input->post('meta_title');
			$arr['meta_key']  		= $this->input->post('meta_key');
			$arr['meta_desc']  		= $this->input->post('meta_desc');
			
			if(!$page_id){
				$arr['created_date']  	= date('Y-m-d H:i:s');
				$arr['sort_order']  	= $this->page->getPageCount($arr['parent_id']);
			}
			
			if($_FILES['fl_thumb']['name']){				
				$result = $this->do_thumb_upload();
				if($result['status'] != 'fail' ){
					$arr['thumb']  = $result['file_name'];
					if($data['page']->thumb != '' && file_exists('assets/images/thumb/'.$data['page']->thumb)){
						unlink('assets/images/thumb/'.$data['page']->thumb);
					}
				}
				else{
					$this->session->set_flashdata('error', $result['error']);
					redirect($this->prfx_admin.'admin/page/update/'.$page_id);
				}
				
			}
			else{
				$arr['thumb']  = $this->input->post('thumb');	
			}
			
			//Featured image upload
			if($_FILES['fl_featured_image']['name']){				
				$result = $this->do_featured_image_upload();
				if($result['status'] != 'fail' ){
					$arr['featured_image']  = $result['file_name'];
					if($data['page']->featured_image != '' && file_exists('assets/images/featured/'.$data['page']->featured_image)){
						unlink('assets/images/featured/'.$data['page']->featured_image);
					}
				}
				else{
					$this->session->set_flashdata('error', $result['error']);
					redirect($this->prfx_admin.'admin/page/update/'.$page_id);
				}
				
			}
			else{
				$arr['featured_image']  = $this->input->post('featured_image');	
			}
			//$data['page'] = (object) $_POST;
			
			if($page_id = $this->page->updatePage($arr, $page_id )){
				
				if(!$data['errors']){
					$this->session->set_flashdata('success', 'Content updated successfully!.');
					redirect($this->prfx_admin.'admin/page/update/'.$page_id);
				}
			}
		}
	
		
		$data['parent_pages'] = $this->page->getParentPages($page_id);
		$this->load->view('admin/header');
		$this->load->view('admin/page/update', $data);
		$this->load->view('admin/footer');
	}	
	public function remove_image(){
		$img_id	= $this->input->get('img_id');
		$img 		=  $this->page->getImageDetails($img_id);
		if($img->image != '' && file_exists('assets/uploads/page/'.$img->image)){
			unlink('assets/uploads/page/'.$img->image);
			$this->page->removeImage($img_id );
		}
		$json['status'] = 'success';
		echo json_encode($json); exit;
	}
	public function status(){
		$page_id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('status' =>($status=='Y')?'N':'Y');
		if($this->page->updatePage($arr,$page_id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	
	public function change_order(){
		$id		= $this->input->post('id');
		$order  = $this->input->post('order');
		$parent = $this->input->post('parent');
		$prev_ord = $this->input->post('prev_ord');
		
		if($order == 'up'){
			$sql = " UPDATE pages SET sort_order = $prev_ord
				 WHERE parent_id = $parent AND sort_order = $prev_ord+1";
			$query = $this->db->query($sql);
			
			$sql1 = " UPDATE pages SET sort_order = sort_order+1
				 WHERE page_id = $id";
			$query1 = $this->db->query($sql1);
		}
		else{
			$sql = " UPDATE pages SET sort_order = $prev_ord
				 WHERE parent_id = $parent AND sort_order = $prev_ord-1";
			$query = $this->db->query($sql);
			
			$sql1 = " UPDATE pages SET sort_order = sort_order-1
				 WHERE page_id = $id";
				 $query = $this->db->query($sql1);
		}
		
		if($query){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, order not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	public function sort_order(){
		$id		= $this->input->post('id');
		$order = $this->input->post('order');
		$arr = array('sort_order' =>$order);
		if($this->page->updatePage($arr,$id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	public function check_name(){
		$page_id		= $this->input->get('page_id');
		$name			= $this->input->get('name');
		$name			= pageSlug($name,$page_id);
		$json['value']  = $name ;
		echo json_encode($json); exit;
	}
	public function meta(){
		$page_id		= $this->input->post('page_id');
		$meta_title		= $this->input->post('meta_title');
		$meta_key		= $this->input->post('meta_key');
		$meta_desc		= $this->input->post('meta_desc');
		$arr['meta_title']	= $meta_title;	
		$arr['meta_key']	= $meta_key;	
		$arr['meta_desc']	= $meta_desc;
		$this->page->updatePage($arr, $page_id );
		$json['status']  = 'success' ;
		echo json_encode($json); exit;
	}
	public function remove(){
		$id		= $this->input->post('id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		
		$page = $this->page->getPageDetails( $id );
		
		if($this->page->removePage( $id )){	
			$this->page->updateParentNull( $id );
			if($page->thumb != '' && file_exists('assets/images/thumb/'.$page->thumb)){
				unlink('assets/images/thumb/'.$page->thumb);
			}
			if($page->featured_image != '' && file_exists('assets/images/featured/'.$page->featured_image)){
				unlink('assets/images/featured/'.$page->featured_image);
			}
						 
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, country not removed. ';	
		}
		
			
		echo json_encode($json); exit;
	}
	private function do_thumb_upload()
	{ 
		$root = FCPATH.'assets';
		$uploads = $root.'/images';
		if(!file_exists($uploads)){
			mkdir($uploads,0777);	
		}
		$files = $uploads.'/thumb';
		if(!file_exists($files)){
			mkdir($files,0777);	
		}
		
		$config['upload_path'] = $files ;
		$config['allowed_types'] = 'png|jpg|jpeg|gif|PNG|JPG|JPEG|GIF';
		$config['max_size']	= 1024*1024*2;
		$config['min_width']  = '200';
		$config['min_height']  = '200';
		$config['file_name'] = rand ( 1 , 100 ).time();
		$config['overwrite'] = TRUE;
		
		$data = array();
		$this->load->library('upload', $config);
		

		
		if ( ! $this->upload->do_upload('fl_thumb'))
		{ 
			$data['status'] = 'fail';
			$data['error'] = $this->upload->display_errors();
		}
		else
		{ 
			$data = $this->upload->data();
			$data['status'] = 'success';
		}
		
		return $data;
	}
	private function do_featured_image_upload()
	{
		$root = 'assets';
		$uploads = $root.'/images';
		if(!file_exists($uploads)){
			mkdir($uploads,0777);	
		}
		$files = $uploads.'/featured';
		if(!file_exists($files)){
			mkdir($files,0777);	
		}
		
		$config['upload_path'] = $files ;
		$config['allowed_types'] = 'png|jpg|jpeg|gif';
		$config['max_size']	= 1024*1024*2;
		$config['file_name'] = rand ( 1 , 100 ).time();
		$config['overwrite'] = TRUE;
		
		$data = array();
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("fl_featured_image"))
		{
			$data['status'] = 'fail';
			$data['error'] = $this->upload->display_errors();
		}
		else
		{
			$data = $this->upload->data();
			$data['status'] = 'success';
		}
		return $data;
	}
	/******BANNER SECTION *********/
	public function banners(){
		$data['banners'] = $this->banner->getAllBanners();		
		$this->load->view('admin/header');
		$this->load->view('admin/page/banners', $data);
		$this->load->view('admin/footer');
	}
	public function banner($id){
		
		$data['menus'] = $this->menu->getMenuHierarchy();
		$data['banners'] = $this->banner->getMenuBanners($id);
		
		$this->load->view('admin/header');
		$this->load->view('admin/page/banner-update', $data);
		$this->load->view('admin/footer');
	}
	public function images(){
		
		/*$images = glob('assets/images/banner/*.*');
		 foreach($images as $filename){
			 echo $filename."<br/>";
		 }*/
		
		$data['banners'] = $this->banner->getAllBannerImages();	
		//print_r($data['banners']);
		$this->load->view('admin/page/existing-banners', $data);	
		
	}
	public function removebanner(){
		$id 	= $this->input->get('id');
		$baner = $this->banner->getBanner($id);
		
		if($this->banner->removeBanner($id)){
			
			if($baner->banners_image != '' && file_exists('assets/images/banner/'.$baner->banners_image)){
				if(!$this->banner->checkBannerExists($baner->banners_image)){
					unlink('assets/images/banner/'.$baner->banners_image);
				}
			}
			$json['status'] = 'success';	
		}
		else{
				$json['status'] = 'error';	
				$json['message'] = 'Oops..!!, Banner not exist. ';	
			}
			
		echo json_encode($json); exit;
	}
	public function upload($type){
		
				$type 			= $type?$type:$this->input->get('type');
				$menus_id		= $this->input->post('menus_id');
					if(isset($_FILES)){
							$file_formats = array("image/jpeg" => "jpg", "image/png" => "png");
							
							
							$time =time();
							$file_name = $type.'_'.md5($time);
							$name = $_FILES['imagefile']['name']; // filename to get file's extension
							$size = $_FILES['imagefile']['size'];
							
							$image_info = getimagesize($_FILES["imagefile"]["tmp_name"]);
							//print_r($image_info); exit; 
							$image_width = $image_info[0];
							$mime = $image_info['mime'];
							$image_height = $image_info[1];
							$tmp = $_FILES['imagefile']['tmp_name'];
							
									$new_width = ($image_width > 900)?900:$image_width;
									$new_height = round(($image_height / $image_width) * $new_width,1);
									$new_height = ($new_height < 450)?450:$new_height;
									$target_width = 1650;
									$target_height = 300;
								
								
								
								$rw = round($image_width/$new_width, 1);
								$rh = round($image_height/$new_height, 1);
							
								$wd = round($image_width/$rw, 6);	
								$ht = round($image_height/$rh, 6);
							
							if (strlen($name)) {
								$extension = $file_formats[$mime]?$file_formats[$mime]:'';
								if ($extension) { // check it if it's a valid format or not
									if ($size < 2100000) { // check it if it's bigger than 5 mb or no
										if($image_width < $target_width || $image_height < $target_height){
											$json['status'] = 'error';
											$json['message'] = 'Please upload '.$target_width.' X '.$target_height.' sized image';
										}
										else{
											$tmp_filename = 'assets/images/banner/'.$file_name.'.'.$extension;
											//$tmp_path = '../temp/'; 
											//$tmp_res_filename = $file_name.'.'.$extension;
											if(@move_uploaded_file($tmp,$tmp_filename)){
												
												// ////////////////////////////////////////////////
												$arr = array('banners_menus_id'=>$menus_id,
															 'banners_image' =>$file_name.'.'.$extension,
															 'banners_order' => $this->banner->getCount($menus_id),
															 'banners_status' => '1'
															 );
												$banner_id	= $this->banner->insertMenuBanner($arr );
												
												$json['status'] = 'success';
												$json['file_name']  = $file_name.'.'.$extension;
												$json['file_url']   = base_url().'assets/images/banner/'.$file_name.'.'.$extension.'?='.time();
												$json['type']		= $type;
												$json['banner_id']	= $banner_id;
											}
											else{
												$json['status'] = 'error';
												$json['message'] = "File not uploaded. Please try later.";	
											}
												
										}
										 
									}
									else{
										$json['status'] = 'error';
										$json['message'] = "Please choose an image that's size should be less than 2MB.";
									}
								}
								else{
									$json['status'] = 'error';
									$json['message'] = "Please choose an image type of jpg or png.";
								}
							}
							else{
								$json['status'] = 'error';
								$json['message'] = "Please choose an image.";
							}
				}
				else{
					$json['status'] = 'error';
					$json['message'] = "Please choose an image.";
				}
				echo json_encode($json, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); exit;
	}
	
	
	
	
}

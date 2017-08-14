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
		$this->load->model('page_model','page');
		$this->load->model('banner_model','banner');
    }
	public function index($slug)
	{
		
		$data = $head	= array();
		
		$page			 = $this->page->getPageBySlug($slug);	
		
		$banners		 = $this->banner->getPageBannerImagesArray($slug);	
		$data['content'] = $page;
		$data['slug'] 	 = $slug;
		$data['banner_images'] = json_encode($banners);
		
		$current = $this->uri->segment(1);
		$this->load->view('header',$head);
		if($page ){
			
			if($page->parent_id > 0 ){ 
				$data['sidelinks'] = $this->page->getRelatedLinks($current);
				$this->load->view('page',$data);
			}
			else{
				
				$data['primaryPages'] = $this->page->getPrimaryPages($current);	
				$data['subPages'] = $this->page->getSubPages($current);	
				
				$this->load->view('parent-page',$data);	
			}
		}
		else{
			$this->load->view('errors/html/error_404',$data);	
		}
		$this->load->view('footer');
	}
}

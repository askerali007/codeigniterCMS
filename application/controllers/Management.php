<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

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
		$this->load->model('management_model','management');
    }
	public function index()
	{
		$data = $head	= array();
		$current = $this->uri->segment(1);
		$page			 = $this->page->getPageBySlug($current);	
		
		$banners		 = $this->banner->getPageBannerImagesArray($current);	
		$data['content'] = $page;
		$data['slug'] 	 = $current;
		$data['banner_images'] = json_encode($banners);
		$data['teams'] = $this->management->getManagementTeams();
		$data['sidelinks'] = $this->page->getRelatedLinks($current);
		
		$this->load->view('header',$head);
			//echo "<pre>"; print_r($data['subPages']); echo "</pre>"; exit;
		$this->load->view('management',$data);	
		
		$this->load->view('footer');
	}
}

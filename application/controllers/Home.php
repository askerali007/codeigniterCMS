<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('home_model','home');
		$this->load->model('banner_model','banner');
    }
	public function index()
	{
		$data = $head	= array();
		$homepage_section_1 = $this->config->item('homepage_section_1')?$this->config->item('homepage_section_1'):2;
		$homepage_section_2 = $this->config->item('homepage_section_2')?$this->config->item('homepage_section_2'):3;
		$homepage_section_3 = $this->config->item('homepage_section_3')?$this->config->item('homepage_section_3'):4;
		
		$ids = array($homepage_section_1,$homepage_section_2,$homepage_section_3);
		$data['banners'] 	= $this->banner->getHomeBanners();	
		$data['contents'] 	= $this->home->getHomepageContents($ids);
		$data['newsItems'] 	= $this->home->getLatestNews();
		//echo "<pre>"; print_r($data['contents']); echo "</pre>"; exit;
		$this->load->view('header',$head);
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
}

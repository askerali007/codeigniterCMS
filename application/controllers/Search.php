<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

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
		
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data = $head	= array();
		$q 				= $this->input->get('q',true);
		$API_KEY 		= $this->config->item('custom_search_googleAPI');	
		$data['API_KEY']= $API_KEY;
		$data['q']= $q;
		
		$this->load->view('header',$head);
		$this->load->view('search',$data);
		$this->load->view('footer');
		
	}
	
	
}

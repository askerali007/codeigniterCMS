<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wildlife_model extends CI_Model {

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
	function getImagesList(){
		$this->db->select('*');
		$this->db->from('wildlife_gallery');
		$this->db->order_by('image_id','ASC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	
	
}

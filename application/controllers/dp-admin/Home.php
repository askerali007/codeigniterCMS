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
		authAdmin();  // Authentication
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('home_model','home');
    }
	public function index()
	{
		
		$logged_in = $this->session->userdata('logged_in');
		$is_admin  = $this->session->userdata('is_admin');
		if($logged_in === TRUE && $is_admin === TRUE ){
			
			
			$data['statics'] = $this->home->getAllStatics();
			$this->load->view('admin/header');
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/footer');
		}
		else{
			 redirect($this->prfx_admin.'admin/login','refresh');
		}
		return false;
	}
	public function profile(){
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			$arr['name']   = $this->input->post('name');
			$arr['email']  = $this->input->post('email');
			$arr['phone']  = $this->input->post('phone');
			$user_id 	   = $this->input->post('user_id');
			
			
			if($_FILES['userfile']['name']){
				$arr['profile_pic']  = $this->do_upload();
			}
			else{
				$arr['profile_pic']  = $this->input->post('profile_pic');	
			}
			
			if($this->home->updateUserPrimaryDetails($arr, $user_id )){
				$this->session->set_flashdata('success', 'User personal details has been updated successfully!.');
				redirect($this->prfx_admin.'admin/home/profile');
			}
		}
	
		$data['user'] = $this->home->getUserById($this->session->userdata('user_id'));
		
		$this->load->view('admin/header');
		$this->load->view('admin/profile', $data);
		$this->load->view('admin/footer');
	}
	private function do_upload()
	{
		$root = 'assets';
		$uploads = $root.'/uploads';
		if(!file_exists($uploads)){
			mkdir($uploads,0777);	
		}
		$profile = $uploads.'/profile';
		if(!file_exists($profile)){
			mkdir($profile,0777);	
		}
		$admin = $profile.'/admin';
		if(!file_exists($admin)){
			mkdir($admin,0777);	
		}
		
		$config['upload_path'] = $admin ;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= 1024*1024*2;
		$config['min_width']  = '90';
		$config['min_height']  = '90';
		$config['file_name'] = $this->session->userdata('user_id');
		$config['overwrite'] = TRUE;
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			return false;
		}
		else
		{
			$data = $this->upload->data();
			return $data['file_name'];
		}
	}
}

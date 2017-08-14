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
	 * @see https://codeigniter.com/management_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
		authAdmin();  // Authentication
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('Management_model','management');
    }
	public function index()
	{
		redirect($this->prfx_admin.'admin/management/lists');
		
	}
	public function lists($cat){
		
		
		$data['managements'] = $this->management->getAllManagements($cat);
		//echo "<pre>"; print_r($data['properties']); exit;
		$this->load->view('admin/header');
		$this->load->view('admin/management/lists', $data);
		$this->load->view('admin/footer');
	}
	
	
	
	public function update($id){
		$id = $id?$id:$this->input->post('id');
		$data = array();
		$data['error'] = '';
		$data['management'] = $this->management->getOneManagement($id);
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			
			$arr['name']           = $this->input->post('name');
			$arr['position']        = $this->input->post('position');
			$arr['details']        = $this->input->post('details');
			
			if(!$id){
				$order = $this->management->getCount();
				$arr['sort_order'] = $order+1;
			}
			
			if($_FILES['userfile']['name']){
				
				$result = $this->do_upload();
				if($result['status'] != 'fail' ){
					$arr['profile_pic']  = $result['file_name'];
					if($data['management']->profile_pic != '' && file_exists('assets/images/team/'.$data['management']->profile_pic)){
						unlink('assets/images/team/'.$data['management']->profile_pic);
					}
				}
				else{
					$this->session->set_flashdata('error', $result['error']);
					redirect($this->prfx_admin.'admin/management/update/'.$id);
				}
				
			}
			else{
				$arr['profile_pic']  = $this->input->post('profile_pic');	
			}
			
				//echo "<pre>"; print_r($arr); echo "</pre>"; exit;
			if($id = $this->management->updateManagement($arr, $id)){
			
				$this->session->set_flashdata('success', 'Management has been updated successfully!.');
				redirect($this->prfx_admin.'admin/management/update/'.$id);
			}
			else{
				$data['error'] =  'Management not updated!.';
			}
				
			
			
			$data['management'] = (object)$_POST;
		}
		
		//echo "<pre>"; print_r($data['management']); echo "</pre>"; exit;
		$this->load->view('admin/header');
		$this->load->view('admin/management/update', $data);
		$this->load->view('admin/footer');
		
	}
	
	
	public function status(){
		$id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('status' =>($status=='Y')?'N':'Y');
		if($this->management->updateManagement($arr,$id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	public function sort_order(){
		$id		= $this->input->post('id');
		$order = $this->input->post('order');
		$arr = array('sort_order' =>$order);
		if($this->management->updateManagement($arr,$id )){
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
		$prev_ord = $this->input->post('prev_ord');
		
		if($order == 'up'){
			$sql = " UPDATE dp_managent_teams SET sort_order = $prev_ord
				 WHERE sort_order = $prev_ord+1";
			$query = $this->db->query($sql);
			
			$sql1 = " UPDATE dp_managent_teams SET sort_order = sort_order+1
				 WHERE team_id = $id";
			$query = $this->db->query($sql1);
		}
		else{
			$sql = " UPDATE dp_managent_teams SET sort_order = $prev_ord
				 WHERE sort_order = $prev_ord-1";
			$query = $this->db->query($sql);
			
			$sql1 = " UPDATE dp_managent_teams SET sort_order = sort_order-1
				 WHERE team_id = $id";
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
	public function remove(){
		$id		= $this->input->post('id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		$management = $this->management->getOneManagement($id);
		if($this->management->removeManagement( $id )){		
			if($management->profile_pic != '' && file_exists('assets/images/team/'.$management->profile_pic)){
				unlink('assets/images/team/'.$management->profile_pic);
			}		
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, management not removed. ';	
		}
		
			
		echo json_encode($json); exit;
	}

	private function do_upload()
	{
		$root = 'assets';
		$uploads = $root.'/images';
		if(!file_exists($uploads)){
			mkdir($uploads,0777);	
		}
		$files = $uploads.'/team';
		if(!file_exists($files)){
			mkdir($files,0777);	
		}
		
		
		$config['upload_path'] = $files ;
		$config['allowed_types'] = 'png|jpg|jpeg|gif|PNG|JPG|JPEG|GIF';
		$config['max_size']	= 1024*1024*2;
		$config['min_width']  = '100';
		$config['min_height']  = '100';
		$config['file_name'] = md5(time());
		$config['overwrite'] = TRUE;
		
		$data = array();
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
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
}

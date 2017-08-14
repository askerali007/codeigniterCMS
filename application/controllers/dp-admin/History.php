<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

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
	 * @see https://codeigniter.com/history_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
		authAdmin();  // Authentication
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('History_model','history');
    }
	public function index()
	{
		redirect($this->prfx_admin.'admin/history/lists');
		
	}
	public function lists(){
		
		
		$data['histories'] = $this->history->getAllHistories();
		//echo "<pre>"; print_r($data['properties']); exit;
		$this->load->view('admin/header');
		$this->load->view('admin/history/lists', $data);
		$this->load->view('admin/footer');
	}
	
	
	
	public function update($id){
		$id = $id?$id:$this->input->post('id');
		$data = array();
		$data['error'] = '';
		$data['history'] = $this->history->getOneHistory($id);
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			
			$arr['history_year']	= $this->input->post('history_year');
			$arr['history_content'] = $this->input->post('history_content');
			$check 					= $this->history->checkYearAdded($arr['history_year'],$id);
			
			if($check == true ){
					$data['error']  = 'This year already added.';
			}
			else{
				if(!$id){
					$arr['history_status'] = 1;
				} 
			
				if($_FILES['userfile']['name']){
					
					$result = $this->do_upload();
					if($result['status'] != 'fail' ){
						$arr['history_image']  = $result['file_name'];
						if($data['history']->history_image != '' && file_exists('assets/images/history/'.$data['history']->history_image)){
							unlink('assets/images/history/'.$data['history']->history_image);
						}
					}
					else{
						$this->session->set_flashdata('error', $result['error']);
						redirect($this->prfx_admin.'admin/history/update/'.$id);
					}
					
				}
				else{
					$arr['history_image']  = $this->input->post('history_image');	
				}
			
				//echo "<pre>"; print_r($arr); echo "</pre>"; exit;
				if($id = $this->history->updateHistory($arr, $id)){
				
					$this->session->set_flashdata('success', 'History has been updated successfully!.');
					redirect($this->prfx_admin.'admin/history/update/'.$id);
				}
				else{
					$data['error'] =  'History not updated!.';
				}
			}
			
			
			$data['history'] = (object)$_POST;
		}
		
		//echo "<pre>"; print_r($data['history']); echo "</pre>"; exit;
		$this->load->view('admin/header');
		$this->load->view('admin/history/update', $data);
		$this->load->view('admin/footer');
		
	}
	
	
	public function status(){
		$id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('history_status' =>($status=='1')?'0':'1');
		if($this->history->updateHistory($arr,$id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	
	
	public function remove(){
		$id		= $this->input->post('id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		$history = $this->history->getOneHistory($id);
		if($this->history->removeHistory( $id )){		
			if($history->history_image != '' && file_exists('assets/images/history/'.$history->history_image)){
				unlink('assets/images/history/'.$history->history_image);
			}		
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, history not removed. ';	
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
		$files = $uploads.'/history';
		if(!file_exists($files)){
			mkdir($files,0777);	
		}
		
		
		$config['upload_path'] = $files ;
		$config['allowed_types'] = 'png|jpg|jpeg|gif|PNG|JPG|JPEG|GIF';
		$config['max_size']	= 1024*1024*2;
		$config['min_width']  = '300';
		$config['min_height']  = '120';
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

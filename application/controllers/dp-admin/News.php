<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

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
	 * @see https://codeigniter.com/news_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
		authAdmin();  // Authentication
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('News_model','news');
    }
	public function index()
	{
		redirect($this->prfx_admin.'admin/news/lists');
		
	}
	public function lists(){
		
		
		$data['newses'] = $this->news->getAllNewses();
		//echo "<pre>"; print_r($data['properties']); exit;
		$this->load->view('admin/header');
		$this->load->view('admin/news/lists', $data);
		$this->load->view('admin/footer');
	}
	
	
	
	public function update($id){
		$id = $id?$id:$this->input->post('id');
		$data = array();
		$data['error'] = '';
		$data['news'] = $this->news->getOneNews($id);
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			
			$arr['breakingnews_title']	= $this->input->post('breakingnews_title');
			$arr['breakingnews_news']   = $this->input->post('breakingnews_news');
			$arr['breakingnews_link']   = $this->input->post('breakingnews_link');
			
			if(!$id){
				$arr['breakingnews_date'] = time();
				$arr['breakingnews_status'] = 1;
			}
			
			if($_FILES['userfile']['name']){
				
				$result = $this->do_upload();
				if($result['status'] != 'fail' ){
					$arr['breakingnews_image']  = $result['file_name'];
					if($data['news']->breakingnews_image != '' && file_exists('assets/images/latestnews/'.$data['news']->breakingnews_image)){
						unlink('assets/images/latestnews/'.$data['news']->breakingnews_image);
					}
				}
				else{
					$this->session->set_flashdata('error', $result['error']);
					redirect($this->prfx_admin.'admin/news/update/'.$id);
				}
				
			}
			else{
				$arr['breakingnews_image']  = $this->input->post('breakingnews_image');	
			}
			
				//echo "<pre>"; print_r($arr); echo "</pre>"; exit;
			if($id = $this->news->updateNews($arr, $id)){
			
				$this->session->set_flashdata('success', 'News has been updated successfully!.');
				redirect($this->prfx_admin.'admin/news/update/'.$id);
			}
			else{
				$data['error'] =  'News not updated!.';
			}
				
			
			
			$data['news'] = (object)$_POST;
		}
		
		//echo "<pre>"; print_r($data['news']); echo "</pre>"; exit;
		$this->load->view('admin/header');
		$this->load->view('admin/news/update', $data);
		$this->load->view('admin/footer');
		
	}
	
	
	public function status(){
		$id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('breakingnews_status' =>($status=='1')?'0':'1');
		if($this->news->updateNews($arr,$id )){
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
		$news = $this->news->getOneNews($id);
		if($this->news->removeNews( $id )){		
			if($news->breakingnews_image != '' && file_exists('assets/images/latestnews/'.$news->breakingnews_image)){
				unlink('assets/images/latestnews/'.$news->breakingnews_image);
			}		
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, news not removed. ';	
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
		$files = $uploads.'/latestnews';
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

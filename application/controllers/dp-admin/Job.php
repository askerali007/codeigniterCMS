<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

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
	 * @see https://codeigniter.com/job_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
		authAdmin();  // Authentication
		$this->prfx_admin = $this->config->item('admin_prifix')?$this->config->item('admin_prifix'):'';
		$this->load->model('Careers_model','job');
		
		$this->load->library('pagination');
    }
	public function index()
	{
		redirect($this->prfx_admin.'admin/job/lists');
		
	}
	public function lists(){
		
		
		$data['jobs'] = $this->job->getAllJobs();
		
		//echo "<pre>"; print_r($data['properties']); exit;
		$this->load->view('admin/header');
		$this->load->view('admin/job/lists', $data);
		$this->load->view('admin/footer');
	}
	
	public function update($id){
		$id = $id?$id:$this->input->post('jobs_id');
		$data = array();
		$data['error'] = '';
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			$arr['jobs_position']       = $this->input->post('jobs_position');
			$arr['jobs_reportingto']    = $this->input->post('jobs_reportingto');
			$arr['jobs_department'] 	= $this->input->post('jobs_department');
			$arr['jobs_type']           = $this->input->post('jobs_type');
			$arr['jobs_location']       = $this->input->post('jobs_location');
			$arr['jobs_purpose'] 	    = $this->input->post('jobs_purpose');
			$arr['jobs_responsibilities']= $this->input->post('jobs_responsibilities');
			$arr['jobs_requirements']   = $this->input->post('jobs_requirements');
			
			if(!$id){
				$arr['job_addedtime'] = date('Y-m-d H:i:s');
				$arr['jobs_status'] = '1';
			}
			
			
			if($this->job->updateJob($arr, $id)){
				$this->session->set_flashdata('success', 'Job has been updated successfully!.');
				redirect($this->prfx_admin.'admin/job/lists');
			}
			else{
				$data['error'] =  'Job not updated!.';
			}
			$data['job'] = (object)$_POST;
		}
		else{
			$data['job'] = $this->job->getOneJob($id);
		}
		//echo "<pre>"; print_r($data['job']); echo "</pre>"; exit;
		$this->load->view('admin/header');
		$this->load->view('admin/job/update', $data);
		$this->load->view('admin/footer');
		
	}
		
	public function status(){
		$id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('jobs_status' =>($status=='1')?'0':'1');
		if($this->job->updateJob($arr,$id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	
	public function ap_status(){
		$id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('applicants_status' =>$status?$status:1);
		if($this->job->updateApplication($arr,$id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	
	public function ap_remove(){
		$id		= $this->input->post('id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		
		$app = $this->job->getOneApplication( $id );
		if($this->job->removeApplication( $id )){
			if($app->applicants_cv != '' && file_exists('assets/uploads/cv/'.$app->applicants_cv)){
				unlink('assets/uploads/cv/'.$app->applicants_cv);
			}
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, job not removed. ';	
		}
		
			
		echo json_encode($json); exit;
	}
	public function remove(){
		$id		= $this->input->post('id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		
		if($this->job->removeJob( $id )){				
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, job not removed. ';	
		}
		
			
		echo json_encode($json); exit;
	}
	public function applications($id='all',$status='all',$page=''){
		
		$limit  =  $this->config->item('page_limit')?$this->config->item('page_limit'):100;
		$start  = $page?$page:0;
		
		$config['base_url'] = base_url().$this->prfx_admin.'admin/job/applications/'.$id.'/'.$status.'/';
		$config['total_rows'] = $this->job->getApplicationCount($id,$status);
		$config['per_page'] = $limit;
		$config['first_link'] = 'First';
		$config['last_link']  = 'Last';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
		$config['full_tag_close']= '</ul></div>';
		$config['first_tag_open'] = '<li class="paginate_button">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="paginate_button">';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="paginate_button">';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="paginate_button">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="paginate_button">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open']  = '<li class="paginate_button"><span>';
		$config['cur_tag_close'] = '</span></li>';
		
		$this->pagination->initialize($config);

		$data['applications'] = $this->job->getAllApplications($id,$status,$start,$limit);
		$data['filterjobs'] = $this->job->getApplicationJobs();
		
		$this->load->view('admin/header');
		$this->load->view('admin/job/applications', $data);
		$this->load->view('admin/footer');
	}
	public function application($id){
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			$arr['applicants_status']           = $this->input->post('applicants_status');
			if($this->job->updateApplication($arr, $id)){
				$data['success'] = 'Job application status has been updated successfully!.';
			}
			else{
				$data['error'] =  'Job not updated!.';
			}
		}
		$data['applic'] = $this->job->getOneApplication($id);
		//echo "<pre>"; print_r($data['applic']); exit;
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/job/application-view', $data);
		$this->load->view('admin/footer');
	}
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Careers_model extends CI_Model {

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
	function getLatestJobs(){
		$this->db->select('*');
		$this->db->from('jobs');
		$this->db->join('department', 'department.department_id = jobs.department', 'left');
		$this->db->where('jobs_status','1');
		$this->db->order_by('jobs_id','ASC');
		
		$query = $this->db->get();
		$results = $query->result();
	
		return $results;
	}
	function getJobDetails($job_id){
		$this->db->select('*');
		$this->db->from('jobs');
		$this->db->join('department', 'department.department_id = jobs.department', 'left');
		$this->db->where('jobs_status','1');
		$this->db->where('jobs_id',$job_id);
		
		$query = $this->db->get();
		$results = $query->row();
		
		return $results;
	}
	function checkApplied($email,$job_id){
		if(!$job_id) return false;
		$this->db->select('applicants_email');
		$this->db->from('applicants');
		$this->db->where('applicants_email', $email);
		$this->db->where('applicants_jobs_id', $job_id);
		$query  = $this->db->get();
		if ($query->num_rows() > 0)
			return true;
		else
			return false;

	}
	function getJobTitle($job_id){
		if(!$job_id) return false;
		$this->db->select('jobs_position');
		$this->db->from('jobs');
		$this->db->where('jobs_id', $job_id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result->jobs_position;
	}
	function insertApplication($arr){
		
		$this->db->insert('applicants',$arr);
		
		$id = $this->db->insert_id();
		
		return $id;
	}
	function updateApplication($arr, $id){
		if($id > 0 ) {
			$this->db->where('applicants_id',$id);
			$this->db->update('applicants',$arr);
			return $id;
		}
		return false;
	}
	function removeApplication( $id){
		if($id > 0 ) {
			$this->db->where('applicants_id',$id);
			$this->db->delete('applicants');
			
			return $id;
		}
		return false;
	}
	/******** for Admin**************/
	function getAllJobs(){
		$this->db->select('jobs.*');
		$this->db->from('jobs');	
		$this->db->order_by('jobs.jobs_id','DESC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function removeJob($id){
		if(!$id) return false;
		
		$this->db->where('job_id', $id);
      	$this->db->delete('jobs');
		return true;
	}
	
	
	function getOneJob($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('jobs');	
		$this->db->where('jobs_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	function updateJob($arr, $id){
		if($id > 0 ) {
			$this->db->where('jobs_id',$id);
			return $this->db->update('jobs',$arr);
			//echo $this->db->last_query(); exit;
			
		}
		else{
			$this->db->insert('jobs',$arr);
			//echo $this->db->last_query(); exit;
			$id = $this->db->insert_id();
		}
		return $id;
	}
	
	function getAllApplications($id='all',$status='all',$start,$limit){
		
		$this->db->select('applicants.*, jobs.jobs_position as job');
		$this->db->from('applicants');	
		$this->db->join('jobs', 'jobs.jobs_id = applicants.applicants_jobs_id', 'left');	
		if($id && $id != 'all')
			$this->db->where('applicants_jobs_id',$id);
		if($status && $status != 'all'){
			$this->db->where('applicants_status',$status);
		}
		else{
			$this->db->where('applicants_status !=','0');
		}
		$this->db->limit($limit, $start);	
		$this->db->order_by('applicants_id','DESC');
		
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		
		$result = $query->result();
		return $result;
	}
	function getApplicationCount($id, $status){
		$this->db->select('applicants_id');
		$this->db->from('applicants');
		if($id && $id != 'all')
			$this->db->where('applicants_id',$id);
		if($status && $status != 'all'){
			$this->db->where('applicants_status',$status);
		}
		else{
			$this->db->where('applicants_status !=','0');
		}
		$query  = $this->db->get();
		
		return $query->num_rows();
	}
	function getOneApplication($id){
		if(!$id) return false;
		
		$this->db->select('*');
		$this->db->from('applicants');	
		$this->db->where('applicants_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function getApplicationJobs(){
		
		$this->db->select('jobs.jobs_id, jobs.jobs_position');
		$this->db->from('applicants');
		$this->db->join('jobs', 'jobs.jobs_id = applicants.applicants_jobs_id', 'inner');	
		$this->db->group_by('applicants.applicants_jobs_id');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

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
		$this->load->helper('form');
		$this->load->model('Setting_model','setting');
    }
	public function index()
	{
		
		
	}
	public function config(){
		$data['configs'] = $this->setting->getConfigs();
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			foreach($_POST as $key=>$value){
				$arr = array('config_value' => $this->input->post($key));
				$this->setting->updateConfig($arr, $key);
			}
			$this->session->set_flashdata('success', 'Config values updated successfully!.');
			redirect($this->prfx_admin.'admin/setting/config');
		}
		
		$this->load->view('admin/header'); 
		$this->load->view('admin/setting/config', $data);
		$this->load->view('admin/footer');
	}
	public function navmenu(){
		
		//$data['navmenu'] = $this->setting->getNavMenus();
		$data['navmenu'] = $this->setting->getNavMenusList();
		
		//echo "<pre>"; print_r($data['navmenu']); echo "</pre>";  exit;
		$this->load->view('admin/header'); 
		$this->load->view('admin/setting/navmenu', $data);
		$this->load->view('admin/footer');
	}
	public function emails(){
		
		$data['emails'] = $this->setting->getAllEmails();
		
		$this->load->view('admin/header'); 
		$this->load->view('admin/emails/lists', $data);
		$this->load->view('admin/footer');
	}
	public function email_edit($email_id){
		
		$email_id = $email_id?$email_id:$this->input->post('email_id');
		if($_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			$arr['email_subject']  	= $this->input->post('email_subject');
			$arr['email_content']  		= $this->input->post('email_content');
			
			
			if($this->setting->updateEmail($arr, $email_id )){
				$this->session->set_flashdata('success', 'Email template has been updated successfully!.');
				redirect($this->prfx_admin.'admin/setting/emails');
			}
		}
	
		$data['email'] = $this->setting->getEmailDetails($email_id);
		//echo "<pre>"; print_r($data['email']); echo "</pre>";  exit;
		$this->load->view('admin/header');
		$this->load->view('admin/emails/update', $data);
		$this->load->view('admin/footer');
	}
	public function email_status(){
		$email_id		= $this->input->post('id');
		$status = $this->input->post('status');
		$arr = array('status' =>($status=='Y')?'N':'Y');
		if($this->setting->updateEmail($arr,$email_id )){
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, status not updated. ';	
		}
			
		echo json_encode($json); exit;
	}
	
	public function menuremove(){
		$id		= $this->input->post('menu_id');
		$ajax = $this->input->post('ajax');
		if(!$ajax) die('Direct access restricted!!!!');
		
		if($this->setting->removeMenu( $id )){				
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
			$json['message'] = 'Oops..!!, Menu not removed. ';	
		}
		
			
		echo json_encode($json); exit;
	}
	public function menuorder(){
		$menus		= $this->input->post('menus');
		if($menus){
			foreach($menus as $menu){
				$arr = array('display_order'=>$menu['order']);
				$this->setting->updateMenu($arr, $menu['menu_id']);
			}
			$json['status'] = 'success';
		}
		else{
			$json['status'] = 'error';	
		}
		echo json_encode($json); exit;
	}
	public function savetheme(){
		$_POST['status'] = 'success';
		if($_POST){
			foreach($_POST as $key=>$value){
				$arr = array('config_value' => $this->input->post($key));
				if($this->setting->checkConfig($key)){
					$this->setting->updateConfig($arr, $key);	
				}
				else{
					$this->setting->addConfig($arr, $key);	
				}
			}
		}
		$post = json_encode($_POST);
		echo $post; exit;
	}
	private function selected_val($key,$val){
		if(!$key) return false;
		
		if($this->config->item($key) && $this->config->item($key) == $val)
		 	return true;
		else
			return false;
	}
	public function customize(){
		$pages = $this->setting->getPageList();
		$enable_menu_section = 
		
		$data['customize']['menu_section'] = array( array( 'label'  => 'Enable Menu section',
												 		'items' =>array( 
														array('label'=>'Yes',
															'field'=>form_radio('enable_menu_section', 'yes', $this->selected_val('enable_menu_section','yes') )),
														array('label'=>'No',
															'field'=>form_radio('enable_menu_section', 'no', $this->selected_val('enable_menu_section','no') ))
															)
												),
												 array( 'label'  => 'Menu section title',
														'items' =>array( array('label'=>'',
																		 'field'=> form_input(array(
																		 			'type'=>'text', 
																					'name' => 'menu_section_title',
																					'required'=>false , 
																					'value' => $this->config->item('menu_section_title'),
																					'class' => 'text'
																				))
																		))
													),
												 array( 'label'  => 'Menu section content',
														'items' =>array( array(
																		'label'=>'',
																		'field'=> form_dropdown('menu_section_page', 
																		 					$pages, 
																							$this->config->item('menu_section_page'), 
																							'class="text" ')
																		))
													)
											);
												
		/*$data['customize']['boutique_section'] = array( array( 'label'  => 'Enable Boutique section',
												 		'items' =>array( array('label'=>'Yes',
																		 'field'=>form_radio('enable_boutique_section','yes', $this->selected_val('enable_boutique_section','yes'))
																	),
																   array('label'=>'No',
																		 'field'=>form_radio('enable_boutique_section', 'no', $this->selected_val('enable_boutique_section','no'))
																	)
															)
												),
												 array( 'label'  => 'Boutique section title',
														'items' =>array( array('label'=>'',
																		 'field'=> form_input(
																		 		array('type'=>'text', 
																				'name' => 'boutique_section_title',
																				'required'=>false , 
																				'value' => $this->config->item('boutique_section_title'),
																				'class' => 'text'))
																		))
													),
												array( 'label'  => 'Boutique section tabs',
														'items' =>array( array('label'=>'Tab 1',
																		 'field'=> form_input(
																		 		array('type'=>'text', 
																				'name' => 'boutique_section_tab1_title',
																				'required'=>false , 
																				'value' => $this->config->item('boutique_section_tab1_title'),
																				'class' => 'text'))
																		),
																		array('label'=>'Tab 2',
																		 'field'=> form_input(
																		 		array('type'=>'text', 
																				'name' => 'boutique_section_tab2_title',
																				'required'=>false , 
																				'value' => $this->config->item('boutique_section_tab2_title'),
																				'class' => 'text'))
																		),
																		array('label'=>'Tab 3',
																		 'field'=> form_input(
																		 		array('type'=>'text', 
																				'name' => 'boutique_section_tab3_title',
																				'required'=>false , 
																				'value' => $this->config->item('boutique_section_tab3_title'),
																				'class' => 'text'))
																		))
													),
												 array( 'label'  => 'Boutique section tab content',
														'items' =>array( array('label'=>'Tab 1',
																		 'field'=> form_dropdown('boutique_section_tab1', 
																		 $pages,
																		 $this->config->item('boutique_section_tab1'), 
																		 'class="text" ')
																		),
																		array('label'=>'Tab 2',
																		 'field'=> form_dropdown('boutique_section_tab2', 
																		 $pages,
																		 $this->config->item('boutique_section_tab2'), 
																		 'class="text" ')
																		),
																		array('label'=>'Tab 3',
																		 'field'=> form_dropdown('boutique_section_tab3', 
																		 $pages,
																		 $this->config->item('boutique_section_tab3'), 
																		 'class="text" ')
																		))
													),
												 array( 'label'  => 'Full list link',
														'items' =>array( array('label'=>'',
																		 'field'=> form_input(
																		 	array('type'=>'text', 
																				'name' => 'boutique_section_link',
																				'value' => $this->config->item('boutique_section_link'),
																				'class' => 'text'
																			))
																		))
													)
											);*/
		$data['customize']['cakebook_section'] = array( array( 'label'  => 'Enable Cake book section',
												 		'items' =>array( array('label'=>'Yes',
																		 'field'=>form_radio('enable_cakebook_section','yes', $this->selected_val('enable_cakebook_section','yes'))
																	),
																   array('label'=>'No',
																		 'field'=>form_radio('enable_cakebook_section', 'no', $this->selected_val('enable_cakebook_section','no'))
																	)
															)
												),
												 array( 'label'  => '',
														'items' =>array( array('label'=>'Cake book section title',
																		 'field'=> form_input(
																		 		array('type'=>'text', 
																				'name' => 'cakebook_section_title',
																				'required'=>false , 
																				'value' => $this->config->item('cakebook_section_title'),
																				'class' => 'text'))
																		),
																		array(
																		'label'=>'Cake book section content',
																		'field'=> form_dropdown('cakebook_section_page', 
																		 					$pages, 
																							$this->config->item('cakebook_section_page'), 
																							'class="text" ')
																		),
																		array('label'=>'Download link',
																		 'field'=> form_input(
																		 	array('type'=>'text', 
																			'name' => 'cakebook_section_link',
																			'value' => $this->config->item('cakebook_section_link'),
																			'class' => 'text'
																			))
																		))
													)
											);
		$data['customize']['offer_section'] = array( array( 'label'  => 'Enable Offer section',
												 		'items' =>array( array('label'=>'Yes',
																		 'field'=>form_radio('enable_offer_section', 'yes', $this->selected_val('enable_offer_section','yes'))
																	),
																   array('label'=>'No',
																		 'field'=>form_radio('enable_offer_section', 'no', $this->selected_val('enable_offer_section','no'))
																	)
															)
												),
												 array( 'label'  => 'Offer section title',
														'items' =>array( array('label'=>'',
																		 'field'=> form_input(
																		 array('type'=>'text', 
																			'name' => 'offer_section_title',
																			'required'=>false , 
																			'value' => $this->config->item('offer_section_title'),
																			'class' => 'text'
																			))
																		))
													),
												array( 'label'  => 'Offer section content',
														'items' =>array( array(
																		'label'=>'',
																		'field'=> form_dropdown('offer_section_page', 
																		 					$pages, 
																							$this->config->item('offer_section_page'), 
																							'class="text" ')
																		))
													),
												 array( 'label'  => '<strong>Offer slider area</strong>',
														'items' =>array( array('label'=>'Title',
																		 'field'=> form_input(
																		 array('type'=>'text', 
																			'name' => 'offer_slider_title',
																			'required'=>false , 
																			'value' => $this->config->item('offer_slider_title'),
																			'class' => 'text'
																			))
																		),
																		array('label'=>'Pre description',
																		 'field'=> form_textarea(
																		 array('name'        => 'offer_pre_description',
																			   'value'       => $this->config->item('offer_pre_description'),
																			   'class'       => 'text'
																			  ))
																		),
																		array('label'=>'Post description',
																		 'field'=> form_textarea(
																		 array('name'        => 'offer_post_description',
																			'value'       => $this->config->item('offer_post_description'),
																			'class'       => 'text'
																			))
																		),
																		 array('label'=>'More offer link',
																		 'field'=> form_input(
																		 	array('type'=>'text', 
																			'name' => 'offer_section_link',
																			'value' => $this->config->item('offer_section_link'),
																			'class' => 'text'
																			))
																		))
													)
											);
										
		$data['customize']['gallery_section'] = array( array( 'label'  => 'Enable Gallery section',
												 		'items' =>array( array('label'=>'Yes',
																		 'field'=>form_radio('enable_gallery_section', 'yes', $this->selected_val('enable_gallery_section','yes'))
																	),
																   array('label'=>'No',
																		 'field'=>form_radio('enable_gallery_section', 'no', $this->selected_val('enable_gallery_section','no'))
																	)
															)
												)
											);			 
					
		$data['customize']['about_section'] = array( array( 'label'  => 'Enable about us section',
												 		'items' =>array( array('label'=>'Yes',
																		 'field'=>form_radio('enable_about_section','yes', $this->selected_val('enable_about_section','yes'))
																	),
																   array('label'=>'No',
																		 'field'=>form_radio('enable_about_section', 'no', $this->selected_val('enable_about_section','no'))
																	)
															)
												),
												 array( 'label'  => 'About section title',
														'items' =>array( array('label'=>'',
																		 'field'=> form_input(
																		 array('type'=>'text', 
																			'name' => 'about_section_title',
																			'required'=>false , 
																			'value' => $this->config->item('about_section_title'),
																			'class' => 'text'
																			))
																		))
													),
												 array( 'label'  => 'About section content',
														'items' =>array( array('label'=>'',
																		 'field'=> form_dropdown('about_section_content', 
																		 $pages,
																		 $this->config->item('about_section_content'), 
																		 'class="text" ')
																		))
													),
												array( 'label'  => 'Enable Testimonial section',
												 		'items' =>array( array('label'=>'Yes',
																		 'field'=>form_radio('enable_testimonial_section','yes', $this->selected_val('enable_testimonial_section','yes'))
																	),
																   array('label'=>'No',
																		 'field'=>form_radio('enable_testimonial_section', 'no', $this->selected_val('enable_testimonial_section','no'))
																	),
																	array('label'=>'Phone Number',
																		 'field'=> form_input(
																		 array('type'=>'text', 
																			'name' => 'location_phone_number',
																			'value' => $this->config->item('location_phone_number'),
																			'class' => 'text'
																	))
																	),
																	array('label'=>'Address',
																			 'field'=> form_input(
																			 array('type'=>'text', 
																				'name' => 'location_address',
																				'value' => $this->config->item('location_address'),
																				'class' => 'text'
																		))
																	),
																	 array('label'=>'Google Map link',
																			 'field'=> form_textarea(
																			 array('name'        => 'location_google_map',
																				'value'       => $this->config->item('location_google_map'),
																				'class'       => 'text'
																				))
																	)
															)
												)
											);	
													
		$data['customize']['footer'] = array( array( 'label'  => 'Footer area conntent',
												 		'items' =>array( array('label'=>'Facebook',
																		 'field'=> form_input(
																		 array('type'=>'text', 
																			'name' => 'footer_facebook',
																			'value' => $this->config->item('footer_facebook'),
																			'class' => 'text'
																			))
																),
																array('label'=>'Twitter',
																		 'field'=> form_input(
																		 array('type'=>'text', 
																			'name' => 'footer_twitter',
																			'value' => $this->config->item('footer_twitter'),
																			'class' => 'text'
																	))
																),
																array('label'=>'Instagram',
																		 'field'=> form_input(
																		 array('type'=>'text', 
																			'name' => 'footer_instagram',
																			'value' => $this->config->item('footer_instagram'),
																			'class' => 'text'
																	))
																),
																 array('label'=>'Footer text',
																		 'field'=> form_textarea(
																		 array('name'        => 'footer_text',
																			'value'       => $this->config->item('footer_text'),
																			'class'       => 'text'
																			))
																),
																 array('label'=>'Disclaimer title',
																		 'field'=> form_input(
																		 array('name'        => 'disclaimer_title',
																			'value'       => $this->config->item('disclaimer_title'),
																			'class'       => 'text'
																			))
																), 
																array('label'=>'Disclaimer page',
																		 'field'=> form_dropdown('disclaimer_page', 
																		 $pages,
																		 $this->config->item('disclaimer_page'), 
																		 'class="text" ')
																))
													
												)
											);		
		$this->load->view('admin/header'); 
		$this->load->view('admin/setting/customize', $data);
		$this->load->view('admin/footer');
	}
}

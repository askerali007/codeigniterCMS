<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <link rel="icon" href="favicon.png" type="image/png" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        
        <meta name="audience" CONTENT="all">
        <meta name="author" CONTENT="dusup">
        <meta name="revisit-after" CONTENT="4 days">
        <meta name="content-Language" CONTENT="English">
        <meta name="distribution" CONTENT="global">
        <meta name="copyright" CONTENT="by http://www.dusup.ae">
        <meta name="rating" CONTENT="general">
        <meta name="robots" CONTENT="All">
        
        <meta name="keywords" content="<?php echo $this->config->item('meta_keys');?>">
        <meta name="description" content="<?php echo $this->config->item('meta_desc');?>">
        <title><?php echo $this->config->item('meta_title');?></title>
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mCustomScrollbar.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/flexslider.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datepicker.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/styles.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        
        <script src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/js/easing.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.backstretch.js"></script>
        <script src="<?php echo base_url();?>assets/js/custom_scripts.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.flexslider.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
        
        </head>
<body>
<header id="pageHeader">
  <div class="divCenter"> <a href="<?php echo base_url();?>" class="pageLogo"><img src="<?php echo base_url();?>assets/images/logo.png"></a>
  <meta name="google-translate-customization" content="8d8d4844a25afad6-b3cf2d3999a607d5-g4a43cd8df45b6a22-16">
    </meta>	
    <div class="headerRightHolder"> <span class="btnMenu">Menu</span>
      <div class="searchWraper">
        <div class="searchHolder">
          <form id="searchForm" method="get" action="<?php echo base_url('search');?>" accept-charset="utf-8">
            <div class="inputHolder queryInput">
              <label for="subscribeText">Search here</label>
              <input id="q" type="text" name="q" value="<?php purify($this->input->get('q',true));?>" />
            </div>
            <input type="submit" class="btnSearch" value="Submit">
          </form>
        </div>
      </div>
	  
      <div class="clearFix"></div>
    </div>
    <div class="clearFix"></div>
    <div class="pageMenu">
      <ul>
        <?php 
		$parentMenu = $this->config->item('parentMenu'); 
		$menus = $this->config->item('navMenus'); 
		//echo "<pre>"; print_r($parentMenu ); echo "</pre>"; 
		//echo "<pre>"; print_r($menus ); echo "</pre>";
		if($menus) : ?>
		<?php foreach($menus as $menu ) : ?>
            		<li id="<?=$menu->menu_link?>" 
                    class="menusli <?php if( $this->uri->segment(1) != '' && ($this->uri->segment(1) ==  $menu->menu_link  )  || ( $this->uri->segment(1) == '' && $menu->is_home == 'Y'  ) || ($parentMenu == $menu->menu_link) )  :?>active<?php endif;?>"> <a href="<?php echo base_url();?>index.php/<?php echo ($menu->is_home == 'N')?$menu->menu_link:'';?>" <?=$menus_target?>><?php printR($menu->menu_title_en);  ?></a> 
            </li>
        <?php	
		endforeach;
		endif;
		?>
      </ul>
    </div>
    <div class="clearFix"></div>
  </div>
</header>
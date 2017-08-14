<aside class="main-sidebar">
	
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        	<li class="header">&nbsp;</li>
         <?php if( $this->session->userdata('role') == 'SUPER ADMIN' || $this->session->userdata('role') == 'ADMIN' ) : ?>
         <li class="treeview <?php if($this->uri->segment(2) == 'page'):?>active<?php endif;?>">
          <a href="#">
            <i class="fa fa-folder" aria-hidden="true"></i> <span>Content Pages</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class=" <?php if($this->uri->segment(3) == 'lists' ):?>active<?php endif;?>"><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/lists"><i class="fa fa-file"></i> All Pages</a></li>
            <li class=" <?php if($this->uri->segment(3) == 'applications' ):?>active<?php endif;?>"><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/banners"><i class="fa fa-image"></i>Banners</a></li>
          </ul>
        </li>        
         <li class="treeview <?php if($this->uri->segment(2) == 'management'):?>active<?php endif;?>">
          <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/lists">
            <i class="fa fa-users" aria-hidden="true"></i> <span>Our Managements</span> 
          </a>
       </li> 
         <li class="treeview <?php if($this->uri->segment(2) == 'history'):?>active<?php endif;?>">
          <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/history/lists">
            <i class="fa fa-history" aria-hidden="true"></i> <span>Our History</span> 
          </a>
       </li> 
         <li class="treeview <?php if($this->uri->segment(2) == 'news'):?>active<?php endif;?>">
          <a href="#">
            <i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Manage News</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class=" <?php if($this->uri->segment(3) == 'lists' ):?>active<?php endif;?>"><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/lists"><i class="fa fa-list"></i>All News</a></li>
            <li class=" <?php if($this->uri->segment(3) == 'update' ):?>active<?php endif;?>"><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/update"><i class="fa fa-calendar-plus-o"></i>Add News</a></li>
          </ul>
        </li>
         <?php endif; ?>
         <?php if( $this->session->userdata('role') == 'SUPER ADMIN' ||  $this->session->userdata('role') == 'ADMIN' ||  $this->session->userdata('role') == 'HR') : ?>      
         <li class="treeview <?php if($this->uri->segment(2) == 'job'):?>active<?php endif;?>">
          <a href="#">
            <i class="fa fa-pie-chart" aria-hidden="true"></i> <span>Manage Job</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class=" <?php if($this->uri->segment(3) == 'lists' ):?>active<?php endif;?>"><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/lists"><i class="fa fa-pie-chart"></i> Jobs</a></li>
            <li class=" <?php if($this->uri->segment(3) == 'applications' ):?>active<?php endif;?>"><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/applications"><i class="fa fa-envelope-o"></i>Application</a></li>
          </ul>
        </li>
         <li class="treeview <?php if($this->uri->segment(2) == 'contacts'):?>active<?php endif;?>">
          <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/contacts/lists">
            <i class="fa fa-comments" aria-hidden="true"></i> <span>Contact inquiries</span> 
          </a>
       </li>
         <?php endif; ?>
         <?php if( $this->session->userdata('role') == 'SUPER ADMIN' || $this->session->userdata('role') == 'ADMIN' ) : ?>
         <li class="treeview <?php if($this->uri->segment(2) == 'setting' || ($this->uri->segment(2) == 'user' && $this->uri->segment(3) == 'admins' ) ):?>active<?php endif;?>">
          <a href="#">
            <i class="fa fa-cogs" aria-hidden="true"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          		<!--<li class=" <?php if($this->uri->segment(3) == 'customize' ):?>active<?php endif;?>">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/setting/customize">
                    <i class="fa fa-paint-brush" aria-hidden="true"></i> <span>Customize Home</span> 
                  </a>
          		</li>-->
          <li class=" <?php if($this->uri->segment(3) == 'config' ):?>active<?php endif;?>">
              <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/setting/config">
                <i class="ion ion-settings" aria-hidden="true"></i> <span>Site config values</span> 
              </a>
          </li>
            <li class=" <?php if($this->uri->segment(3) == 'admins' ):?>active<?php endif;?>">
              <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/user/admins">
                <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Admins</span> 
              </a>
          </li>
           <li class=" <?php if($this->uri->segment(3) == 'emails' ):?>active<?php endif;?>"><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/setting/emails"><i class="fa fa-envelope-o"></i> Email templates</a></li>
         
          
         
          </ul>
        </li>
         <?php endif; ?>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
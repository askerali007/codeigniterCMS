<?php $this->load->view('admin/sidebar');?>
<div class="content-wrapper" style="min-height:646px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Welcome, Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Widgets</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<?php if( $this->session->userdata('role') == 'SUPER ADMIN' || $this->session->userdata('role') == 'ADMIN' ) : ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-sky-blue white">
            <div class="inner">
              <h3><?=$statics['pages']?></h3>

              <h4>Content Pages</h4>
            </div>
            <div class="icon white">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/lists" class="small-box-footer">
              View all <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?=$statics['managements']?></h3>

              <p>Our Managements</p>
            </div>
            <div class="icon white">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/lists" class="small-box-footer">
              View all <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$statics['history']?></h3>

              <p>Our History</p>
            </div>
            <div class="icon white">
              <i class="fa fa-history"></i>
            </div>
            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/history/lists" class="small-box-footer">
              View all <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <?php endif; ?>
      <div class="row">
      <?php if( $this->session->userdata('role') == 'SUPER ADMIN' || $this->session->userdata('role') == 'ADMIN' ) : ?>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-pink-blue white">
            <div class="inner">
              <h3><?=$statics['newses']?></h3>

              <h4>Latest News</h4>
            </div>
            <div class="icon white">
              <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/lists" class="small-box-footer">
              View all <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
     <?php endif; ?>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?=$statics['inquiries']?></h3>

              <p>Contact inquiries</p>
            </div>
            <div class="icon white">
              <i class="fa fa-comments"></i>
            </div>
            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/contacts/lists" class="small-box-footer">
              View all <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy white">
            <div class="inner">
              <h3><?=$statics['applications']?></h3>

              <p>Job Applications</p>
            </div>
            <div class="icon white">
              <i class="fa fa-envelope-o"></i>
            </div>
            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/applications" class="small-box-footer">
              View all <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- =========================================================== -->

     
      
    </section>
    <!-- /.content -->
  </div>
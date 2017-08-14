 <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
 <script type="text/javascript" src="<?php echo $this->config->item('admin_template');?>plugins/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<?php $this->load->view('admin/sidebar');?>
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage Banners of Property </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Banners</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/banner" class="btn btn-primary pull-right">Add Banner</a>
                </div>
                <div id="mesSages">
					<?php if($this->session->flashdata('error') ) : ?>
                        <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $this->session->flashdata('error');?></div>
                    <?php endif;?>
                    <?php if($this->session->flashdata('success') ) : ?>
                        <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $this->session->flashdata('success');?></div>
                    <?php endif;?>
                </div>
                    <!-- /.box-header -->
                    
                    <div class="box-body">
                      <table id="propertyTable" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th width="5%" class="center">SL</th>
                            <th width="5%">Actions </th>
                            <th width="35%">Menu Title</th>
                            <th width="55%">Images</th>
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($banners as $banner) : $i++;?>
                        <tr id="tr_<?php echo  $banner->menu_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/banner/<?php echo  $banner->menu_id;?>" class="mg0_10 icon-font red" data-id="<?php echo  $banner->property_id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
                          <td><?php printr($banner->name);?></td>
                          <td><?php
                          				$images  = $banner->images;
										$imageArr  = explode('[#]', $images);
										for($j=0;$j<count($imageArr);$j++){ ?>
                                        <a href='<?php echo base_url();?>assets/images/banner/<?=$imageArr[$j]?>' class="fancybox" data-fancybox-group="gallery<?php echo $banner->menu_id;?>" title="<?php echo $banner->name;?>">
                                        	<img src="<?php echo base_url();?>assets/images/banner/<?=$imageArr[$j]?>" style="width:30px; height:30px; max-height:30px; max-width:30px;" >
                                        </a>
											 <?php
										}
						  ?></td>
                          
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                        
                      </table>
                    </div>
                    <!-- /.box-body -->
          	</div>
         </div>
    </div>
 </section>
</div>
<script>
  $(function () {
	$('.fancybox').fancybox();
  });
</script>

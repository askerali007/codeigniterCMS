
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage Config Values </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Config Values</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
      <form role="form" action="<?php echo base_url();?>cc-admin/setting/savetheme" id="frmCustomTheme" method="post" enctype="multipart/form-data" accept-charset="utf-8">
          <div class="col-md-12">
              <div class="box box-primary">
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
				<div class="box-body padding_non">
                	<div class="cusomize leftSideBar  side-custom col-md-3 col-sm-3 padding_non">
                    	<div class="head-custom">
                        	<a href="<?php echo base_url();?>cc-admin/" class="close pull-left"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <span class=" pull-right">
                            	<img src="<?php echo base_url();?>assets/images/loading.gif" alt="loader" class="hide" id="loader" />
                        		<input type="button" name="saveCustom" id="saveCustom" class="btn btn-info" value="Save Change" />
                            </span>
                        </div>
                    	<div class="custom-field"> 
                        
                        
                        	<?php
							//echo "<pre>"; print_r( $customize ); echo "</pre>"; exit;
							if($customize){
								foreach($customize as $key => $fields){
								echo '<h3>'.ucfirst(str_replace('_', ' ', $key)).'</h3>';	
								echo '<div class="custom-side" id="'.$key.'">';
									foreach($fields as $field){
										echo '<div class="custom-area">';
										echo '<h5>'.$field['label'].'</h5>';
										echo '<div class="customize-fields">';
										foreach($field['items'] as $item){
											echo '<label>'.$item['label'].' '.$item['field'].'</label>';
										}
										echo '</div>';
										echo '</div>';
									}
								echo '</div>';	
								}
							}
							?>
                    
                        </div>
                    </div>
              		<div class="cusomize rightSideBar col-md-9 col-sm-9 padding_non">
                    	<div style="background:#fff;  border:1px solid #ccc; height:100%;" id="themedemo">
                       		<iframe src="<?php echo base_url();?>" width="100%" height="100%" onload="this.style.height = parseInt(10)+this.contentWindow.document.body.scrollHeight + 'px';" style="border:none;"></iframe>
                        </div>
                        <div class="cleafix"></div>
                    </div>
              	</div>
                    
            </div>
         
        </div>
         </form>
    </div>
  </section>
</div>
<script>
$(document).ready(function(){
		//$('#themedemo').load('');
		 
		$('body').addClass('sidebar-collapse');
		$('#saveCustom').click(function(e) {
      			$('#loader').removeClass('hide');		 
				$("#frmCustomTheme").ajaxForm({ 					
					 complete: function(response) { 
						
						var result = $.parseJSON(response.responseText);
						
						if(result.status == 'success') {
							$('#loader').addClass('hide');		 
							//location.reload();
						}
						else{
							alert(result.message);	
							location.reload();
							return false;	
						}
							
       				},
					error : function() {
							alert('Server not responding..!');	
							location.reload();
					}
				}).submit(); 
		 });
    });
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if(scroll >= 100) {
        $(".leftSideBar").addClass("topAlign");
    } else {
        $(".leftSideBar").removeClass("topAlign");
    }
});
</script>

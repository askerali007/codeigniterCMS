<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<?php $this->load->view('admin/sidebar');
//echo "<pre>";
//print_r($email); exit;
?>
<div class="content-wrapper" style="min-height:646px;">
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Update Email template</h3>
                  <a href="<?php echo base_url();?>admin/setting/emails" class="pull-right">Back to list</a>
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
                  <form role="form" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="box box-primary">
                      
                        <div class="box-body">
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                              <label for="email_title">Email subject</label>
                              <input type="text" placeholder="Email subject" id="email_subject" name="email_subject" value="<?php printR($email->email_subject);?>" class="form-control" required="required">
                              </div>
                            <div class="cleafix"></div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                              <label for="detail">Email Content</label>
                              <textarea id="email_content" name="email_content" class="form-control details_text" ><?php printR($email->email_content);?></textarea>
                            </div>
                            <div class="cleafix"></div>
                          </div>
                        </div>
                        
                        <div class="box-footer">
                          <input type="hidden"  name="email_id" id="email_id" value="<?=$email->email_id?>" >
                          <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>
                      
                    </div>
                    
                  </form>
    		</div>
       	</div>
   	  </div>
  </section>
</div>
<script>
  $(function () {
    CKEDITOR.replace('email_content');
	CKEDITOR.config.extraAllowedContent = 'div(*)';
	CKEDITOR.config.allowedContent = true;
	CKEDITOR.config.height = '400px';
	CKEDITOR.config.toolbar= [
             	[ 'Font', 'FontSize', 'TextColor' ],
                [ 'Bold', 'Italic', 'Underline', 'Strike' ],
                [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
                [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent' ],
                [ 'PasteText', 'PasteFromWord' ],
                [ 'Table', 'HorizontalRule', 'Templates', 'Source' ]
        ];
  	
  });

$(document).ready(function(e) {
	$('#email_title').keyup(function(e) {
		if($(this).val() != '' ){
		 $('#slug_area').removeClass('hide');	
		}
		if($('#email_id').val() == '' ){
			 var Text  = $('#email_title').val();
			 var name  =  Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
			 $('#email_url').html(name);
			 $('#email_name').val(name);
			 return ;
		}
	});
	
    $('#edit_emailname').click(function(e) {
		$('#email_url').addClass('hide');
	    $('#email_name').attr('type','text');
	    $(this).addClass('hide');
        $('#save_emailname').removeClass('hide');
    });
	$('#save_emailname').click(function(e) {
		var $this = $(this);
		$('#loader').removeClass('hide');
		$.getJSON('<?php echo base_url();?>admin/email/check_name',{name:$('#email_name').val(),email_id : '<?=$email->email_id?>'},function(data){
			$('#loader').addClass('hide');
			$('#email_name').val(data.value).attr('type','hidden');
			$('#email_url').removeClass('hide').html($('#email_name').val());
        	$('#edit_emailname').removeClass('hide');
			$this.addClass('hide');			
			
		});
	    
    });
	
	$('#meta_dataBtn').click(function(e) {
		$(this).html('Please wait..');
		$(this).attr('disabled',true);
		var $this  = $(this);
		$.ajax({
			url :'<?php echo base_url();?>admin/email/meta',
			type:'POST',
			dataType:"json",
			data : {meta_key:$('#meta_key').val(), meta_desc:$('#meta_desc').val(),email_id : '<?=$email->email_id?>'},
			success: function(data){
				$this.removeAttr('disabled');	
				$this.html('Save change');
			},
			error: function(){
				alert("Server not responding!!.");
				$this.removeAttr('disabled');	
				$this.html('Save change');
			}
			
		});
	});
});
</script>
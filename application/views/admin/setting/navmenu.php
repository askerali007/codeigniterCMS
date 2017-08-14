<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_template');?>plugins/nestedSortable/nestedSortable.css">
<script src="<?php echo $this->config->item('admin_template');?>plugins/jQueryUI/jquery-ui.js" type="text/javascript"></script> 
<script src="<?php echo $this->config->item('admin_template');?>plugins/nestedSortable/jquery.mjs.nestedSortable.js" type="text/javascript"></script> 
<?php $this->load->view('admin/sidebar'); ?>

<div class="content-wrapper" style="min-height:646px;">
  <section class="content">
    <div class="row">
    	<form role="form" action="" method="post" enctype="multipart/form-data">
        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Add menu</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
                  </div>
                </div>
                
                <div class="box-body">
                    <div class="form-group">
                  <label>Pages</label>
                    <div class="col-md-12 col-sm-12">
                      <input type="checkbox" name="page" value="1" />
                      Page1 </div>
                    <div class="cleafix"></div>
                  </div>
                    <div class="form-group">
              		<label>Custom</label>
                	 <div class="form-group">
                     	<div class="col-md-12 col-sm-12">
                  		<input type="text" name="custom_url" value="" placeholder="URL with http://" class="form-control" />
                		</div><div class="cleafix"></div>
                     </div>
                	 <div class="form-group">
                     	<div class="col-md-12 col-sm-12">
                  		<input type="text" name="custom_menu" value="" placeholder="Title" class="form-control" />
                		</div>
                        <div class="cleafix"></div>
                     </div>
                <div class="cleafix"></div>
              </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary pull-right saveMenu">Add menu</button>
                </div>
            </div>
        </div>
        <div class="col-md-9">
          
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Menu items</h3> 
              </div>
              <!-- /.box-header --> 
              <!-- form start -->
               <div class="box-footer">
               		<button type="button" class="btn btn-primary pull-right saveMenu">Save menu</button>
              </div>
              <div class="box-body">
                <?php echo $navmenu;?>
              </div>
              <div class="box-footer">
                <input type="hidden"  name="navmenu_id" id="navmenu_id" value="<?=$menu->navmenu_id?>" >
                <button type="button" class="btn btn-primary pull-right saveMenu">Save menu</button>
              </div>
            </div>
         
        </div>
         </form>
    </div>
  </section>
</div>
<script>
$(document).ready(function(){

        $('.sortable').nestedSortable({
           
			forcePlaceholderSize: true,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			opacity: .6,
			placeholder: 'placeholder',
			revert: 250,
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div',
			maxLevels: 2,

			isTree: true,
			expandOnHover: 700,
			startCollapsed: true
        });
		
		$('.saveMenu').click(function(e) {
			
			var input = [];
			$('ol.sortable  li.parent').each(function(index1){
				var id 		= $(this).attr('id');
			    var order 	= $(this).data('order');
			    input.push( {menu_id:id,order : index1+1} );
				$(this).find('li').each(function(index2){
					var id 		= $(this).attr('id');
			    	var order 	= $(this).data('order');
			    	input.push( {menu_id:id,order : index2+1} );
				});
				
			});
			
			
			if(input){
				$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
				$.ajax({
					url:"<?php echo base_url();?>admin/setting/menuorder",
					type:'POST',
					dataType:"json",
					data:{menus:input},
					success: function(response){
						console.log(response);
						$('.saveMenu').html('Save menu');
					},
					error:function(){
						
					}
				});
					
					
			}
        });
		
		$('.remove_menu').click(function(e) {
			var id		= $(this).closest('li').attr('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			
			$.ajax({ url:"<?php echo base_url();?>admin/setting/menuremove",
					 data:{menu_id:id, ajax:true},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
							$this.html('<i class="fa fa-trash"></i>');
							if(data.status == 'success'){
								$this.closest('li').css("background-color","#E5E5E5").fadeOut(500, function(){ 
									$(this).remove();
								});
								
							}
							else{
								alert(data.message);
								location.reload();
							}	
					 }
					 
			});
		});

    });
</script>
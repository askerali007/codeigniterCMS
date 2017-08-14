 <section class="content">
      <div class="row">
          <div class="col-md-12 col-sm-12">	
                      		<ul class="images-list">
                           <?php
                             ?>
                         <?php $i=0; 
						
						 foreach($banners as $banner ) : 
						  $i++; ?>
                         
                         <?php if($banner->banners_image != '' ) : ?>
                                <li class="banner-thumb item_<?=$banner->banners_id?>">
                                <a href="<?php echo base_url();?>assets/images/banner/<?=$banner->banners_image?>" target="_blank" >
                                	<img src="<?php echo base_url();?>assets/images/banner/<?=$banner->banners_image?>">
                                    </a>
                                    <br/>
                                </li>
                                <?php endif;?>
                        <?php endforeach; ?>
                                	
                            
                                </ul>
                        </div>
      </div>
 </section>
<section id="pageContent">
	<?php if($banner_images != 'false') : ?>
        <div class="innerBanner"> 
            <div class="bannerText">
    
                  <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span>
                    <?php printR($content->page_title_en); ?>
                 </div>
            </div>
    
      </div>
    <?php endif; ?>
  <div class="divCenter innerContent">
  <?php 
 /* if($_SERVER['REMOTE_ADDR'] == '94.200.208.210' ){
   echo "<pre>"; print_r($content); echo "<pre>"; exit;
  }*/
  
  ?>
	<?php if($content->page_excerpt_en != '') : ?>
      <h2><?php printR($content->page_title_en); ?><span></span></h2>
    <?php endif; ?>
      	<?php if($content->featured_image != '' && file_exists('assets/images/'.$content->featured_image)) : ?>
		<img src="<?php echo base_url();?>assets/images/<?php echo $content->featured_image; ?>" class="directorImage">
        <?php endif; ?>
		<p><?php printR($content->page_excerpt_en); ?></p>
        
        <?php if($primaryPages) : ?>
        <?php foreach($primaryPages as $primary) : ?>
        <div>  
        	<h2><?php printR($primary->page_title_en); ?><span></span></h2>     		
        	<p><?php printR($primary->page_excerpt_en); ?></p>
            <p><a href="<?php echo $primary->page_name; ?>" class="readMore">Read more</a></p>
      		<div class="clearFix"></div>
        </div>
       <?php endforeach; ?>
       <?php endif; ?>
            <div class="businessList">
            <?php if($subPages) : ?>
      			<ul>
                <?php foreach($subPages as $sub) : ?>
                <li>
                  <div>
                    <h2><?php printR( $sub->page_title_en ); ?><span></span></h2>

                    <?php if($sub->thumb != '' && file_exists('assets/images/thumb/'.$sub->thumb)) : ?>
                    <figure><img src="<?php echo base_url().'assets/images/thumb/'.$sub->thumb;?>"></figure>
					<?php endif; ?>
                    <p><?php printR($sub->page_excerpt_en); ?></p>

                    <a href="<?php echo $sub->page_name; ?>">Read More<span class="topLine"></span><span class="bottomLine"></span></a> </div>

                </li>
                <?php endforeach; ?>
            	</ul>
            <?php else : ?>
            <h2><?php printR($content->page_title_en); ?><span></span></h2>   
            <?php printR($content->page_content_en); ?>
            <?php endif; ?>
            </div>
            
            <div class="clearFix"></div>
    </div>

  
<script>
var innermenuHeight =$(".innerMenu").height();
var innerContentHeight = $(".innerContent").height();
//alert(innerContentHeight);

if(innerContentHeight>innermenuHeight)
	var finalHeight = 'auto';
else
	var finalHeight = parseInt(innermenuHeight)+100;
	
	
	$(".innerContent").height(finalHeight);
	//$(".rightGrey").height(finalHeight);
</script>
</section>


<script type="text/javascript">
$(window).load(function() {
	<?php if($banner_images != 'false') : ?>
	$(".innerBanner").backstretch(
	<?php echo $banner_images;?>
	, {fade: 1500,duration: 3000});
	<?php endif; ?>
});
</script>
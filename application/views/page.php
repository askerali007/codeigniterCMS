<section id="pageContent">
	<div class="innerBanner"> 
    	<div class="bannerText">

              <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span>
				<?php printR($content->page_title_en); ?>
             </div>
		</div>

  </div>
  <div class="divCenter innerContent">

      <h2><?php printR($content->page_title_en); ?><span></span></h2>
      	<?php if($content->featured_image != '' && file_exists('assets/images/featured/'.$content->featured_image)) : ?>
		<img src="<?php echo base_url();?>assets/images/featured/<?php echo $content->featured_image; ?>" class="directorImage">
        <?php endif; ?>
		<?php printR($content->page_content_en); ?>
        <?php if($sidelinks) : ?>
         <aside class="rightGrey">
         	<div class="innerMenu">
         		<h3><?php printR($sidelinks->menu_title_en); ?><span></span></h3>
          		<ul>
				<?php foreach($sidelinks->childs as $child) : ?>
                	<li<?php if($child->menu_link == $slug):?> class="active"<?php endif;?>>
                    <a href="<?php printR(base_url($child->menu_link));?>" id="<?php echo $child->menu_id;?>"
                    <?php if($child->target == 1 ):?> target="_blank"<?php endif;?> ><?php printR($child->menu_title_en); ?></a></li>
                <?php endforeach; ?>
        		</ul>
         		<div class="clearFix"></div>
        	</div>
      	</aside>
        <?php endif; ?>
           
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
	$(".innerBanner").backstretch(
	<?php echo $banner_images;?>
	, {fade: 1500,duration: 3000});
});
</script>
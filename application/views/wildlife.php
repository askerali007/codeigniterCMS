<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.fancybox.css" media="screen" />
 <section id="pageContent">
    <div class="innerBanner"> 
    	<div class="bannerText">
        <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span><?php printR($content->page_title_en); ?> </div>
      </div>
    </div>
    <div class="divCenter innerContent">
     	<h2><?php printR($content->page_title_en); ?><span></span></h2>
        <?php printR($content->page_content_en); ?>
    	<div id="galleryImages" class="galleryTabContent" style="display: block;">
            <div class="galleryWraper">
            <?php if($images) : ?>
              <ul>
                <?php foreach($images as $image) : ?>                  
                    <?php if($image->image != '' && file_exists('assets/images/wildlife/'.$image->image)) : ?>
                    <li> <a data-fancybox-group="gallery" href="<?php echo base_url();?>assets/images/wildlife/<?php echo $image->image; ?>" class="fancybox">
                    <figure>
                    	<div><span class="btnPlayVideo">Download</span></div>
                    	<img src="<?php echo base_url();?>assets/images/wildlife/thumb/<?php echo $image->image; ?>"> 
                    </figure>
                    </a> </li>
                    <?php endif; ?>
                <?php endforeach; ?>
              </ul>
          <?php endif; ?>
              <div class="clearFix"> </div>
            </div>
          </div>
    	<div class="clearFix"></div>
    </div>
    <div class="clearFix"></div>
  </section>
<script type="text/javascript">
$(window).load(function() {
	$(".innerBanner").backstretch(
	<?php echo $banner_images;?>
	, {fade: 1500,duration: 3000});
	
	$('.fancybox').fancybox();
});
</script>
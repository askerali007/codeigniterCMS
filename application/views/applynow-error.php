 <section id="pageContent">
    <div class="innerBanner"> 
    	<div class="bannerText">
        <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span><?php printR($content->page_title_en); ?> </div>
      </div>
    </div>
    <div class="divCenter innerContent" style="min-height:300px;">
     	<h3>Sorry, this job isn't available.</h3><br/>
        <a href="<?php echo base_url('careers/vacancies');?>" >Back to Job list</a>
        	
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
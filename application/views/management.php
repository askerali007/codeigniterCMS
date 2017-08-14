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
      	<?php if($content->featured_image != '' && file_exists('assets/images/'.$content->featured_image)) : ?>
		<img src="<?php echo base_url();?>assets/images/<?php echo $content->featured_image; ?>" class="directorImage">
        <?php endif; ?>
		<p><?php printR($content->page_content_en); ?></p>
        
        
        <div class="divCenter innerContent team">
            <?php if($teams) : ?> 
            <?php foreach($teams as $team) : ?>
            <div class="teamList ">
            <?php if($team->profile_pic != '' && file_exists('assets/images/team/'.$team->profile_pic)) : ?>
				<p><img src="<?php echo base_url();?>assets/images/team/<?php echo $team->profile_pic; ?>" alt="<?php echo $team->name; ?>"></p>
       		<?php endif; ?>
            <div class="teamListInner">
            <h2><?php echo $team->name; ?></h2>
            <?php echo $team->position; ?>
            <?php printR($team->details); ?>
            </div>
            <p><a class="readMore" href="javascript:void(0);">Read more</a></p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <div class="clearFix">&nbsp;</div>
            
            
            </div>
		<?php if($sidelinks) : ?>
         <aside class="rightGrey">
         	<div class="innerMenu">
         		<h3><?php printR($sidelinks->menu_title_en); ?><span></span></h3>
          		<ul>
				<?php foreach($sidelinks->childs as $child) : ?>
                	<li<?php if($child->menu_link == $slug):?> class="active"<?php endif;?>><a href="<?php printR(base_url($child->menu_link));?>" id="<?php echo $child->menu_id;?>"><?php printR($child->menu_title_en); ?></a></li>
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
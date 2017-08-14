<section id="pageContent">
    <div class="innerBanner"> 
    	<div class="bannerText">
        <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span><?php printR($content->page_title_en); ?> </div>
      </div>
    </div>
    <div class="divCenter innerContent">
    	<div class="newsWraper">
        <?php if($newses) : ?>
        <ul>
        	<?php foreach($newses as $news) : ?>
            <li>
				<?php if($news->breakingnews_image != '' && file_exists('assets/images/latestnews/'.$news->breakingnews_image)) : ?>
                	<figure><img src="<?php echo base_url();?>assets/images/latestnews/<?php echo $news->breakingnews_image; ?>" title="created on <?php printDate( $news->breakingnews_date);?>"></figure>
                <?php endif; ?>
            	<aside>
              		<h4><?php printR($news->breakingnews_title); ?><span></span></h4>
              		<!--<span class="newsDate"><?php printDate( $news->breakingnews_date);?></span>-->
              		<div class="contentHolder">
                		<p><?php printR($news->breakingnews_news); ?></p>
              		</div>
					<?php if($news->breakingnews_link != '' ) :?>
                        <a class="readMore" href="<?php printR($news->breakingnews_link); ?>" target="_blank">Read more</a>
                    <?php endif; ?>
            	</aside>
          	</li>
            <?php endforeach; ?>
        </ul>
        <?php else : ?>
        <p>There are no news updates!.</p>
        <?php endif; ?>
        <div class="clearFix"></div>
   		</div>
	 <div class="clearFix"></div>
    </div>
    <br clear="all"/>
    <div class="clearFix"></div>
  </section>
<script type="text/javascript">
$(window).load(function() {
	$(".innerBanner").backstretch(
	<?php echo $banner_images;?>
	, {fade: 1500,duration: 3000});
	
});
</script>

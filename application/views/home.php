<section id="pageContent">
            <div class="homeBanner">
              <div class="flexslider">
                <ul class="slides">
                  <?php if($banners) : ?>
                  <?php foreach($banners as $banner) : ?>
                  <li>
                    <div class="bannerSlides">
                      <div class="bannerText">
                        <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span>
                          <?php printR($banner->banners_caption);?>
                        </div>
                      </div>
                      <img src="<?php echo base_url();?>assets/images/banner/<?php echo $banner->banners_image;?>"> </div>
                  </li>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
            <div class="homeBoxes">
             <?php if($contents) : ?>
              <ul>
              <?php foreach( $contents as $content ) : ?>
                <li>
                  <div>
                    <h2><?php printR($content->page_title_en);?></h2>
                    <figure><img src="<?php echo base_url();?>assets/images/thumb/<?php echo $content->thumb;?>"></figure>
                    <?php printR($content->page_excerpt_en);?>
                    <a href="<?php printR(base_url($content->page_name));?>">Read More<span class="topLine"></span><span class="bottomLine"></span></a> </div>
                </li>
                <?php endforeach ;?>
              </ul>
            <?php endif ;?>
              <div class="clearFix"></div>
            </div>
            <br clear="all"/>
            	<h3 class="homeNewsHeading">Latest News and Events<em></em></h3>
                <div class="homeNewsWrapper">
                
                  <div class="divCenter"> <span id="btnPre" class="btnPrev">previous</span> <span id="btnNex" class="btnNext">next</span>
                
                    <div class="homeNewsInner">
                      <div class="flexslider">
                        <ul class="slides">
                          <?php if($newsItems) :?>
                		  <?php foreach( $newsItems as $news ) : ?>
                          <li>
                            <div class="newsList">
                              <figure><img src="<?php echo base_url();?>assets/images/latestnews/<?php echo $news->breakingnews_image;?>"></figure>
                              <span><?php printR($news->breakingnews_title);?></span>
                              <p><?php truncate($news->breakingnews_news,90);?></p>
                              <a href="<?php echo base_url();?>news">Read more</a>
                              <div class="clearFix"></div>
                
                            </div>
                
                            
                
                          </li>
                          <?php endforeach; ?>
              			  <?php endif; ?>
                        </ul>
                
                      </div>
                
                      <div class="clearFix"></div>
                
                    </div>
                
                    <div class="clearFix"></div>
                
                  </div>
                
                </div>
            <div class="clearFix"></div>
          </section>
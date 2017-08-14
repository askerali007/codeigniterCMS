<section id="pageContent">
<div class="divCenter innerContent">
    <div class="historyHolder">
      <div class="historyInner">
        <div id="slider" class="flexslider">
        <?php if($histories) : $years = ''; ?>
          <ul class="slides">
          <?php foreach($histories as $history ) : 
		  
            	$years .= '<li><span>'.$history->history_year.'<em></em></span></li>';
			?>
            <li>
              <div class="textHolder">
                <h3><?php echo $history->history_year; ?></h3>
                <?php if($history->history_image != '' && file_exists('assets/images/history/'.$history->history_image)) : ?>
                <figure><img src="<?php echo base_url();?>assets/images/history/<?php echo $history->history_image; ?>" alt="<?php echo $history->history_year; ?>" /></figure>
                <?php endif; ?>
                
                <p style="margin-top:20px;">
                  <?php printR($history->history_content);?>
                </p>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        </div>
        <div class="timeline"> <span class="btnPrevious">Previous</span>
          <div class="timelineText">
            <div id="carousel" class="flexslider">
              <ul class="slides">
                <?php echo $years; ?>
              </ul>
            </div>
          </div>
          <span class="btnNext">Next</span> </div>
      </div>
    </div>
    <div class="clearFix"></div>
  </div>
  <div class="clearFix"></div>
</section>
<script type="text/javascript">
        	$(window).load(function() {
				$('#carousel').flexslider({

					animation: "slide",

					controlNav: false,

					animationLoop: false,

					slideshow: false,

					itemWidth: 106,

					itemMargin: 0,

					asNavFor: '#slider',

					start: function () {

						

						$('#carousel .slides li').on('mouseover', function (e) {

							$(this).trigger( "click" );

						});

						

					} 

				});

				 
				
				$('#slider').flexslider({

					animation: "slide",
					
					controlNav: false,
					
					directionNav: true,
					
					animationLoop: false,
					
					slideshow: false,
					
					smoothHeight: true, 
					 
					sync: "#carousel",

					start: function () {

						$('.historyHolder .timeline .btnPrevious').on('click', function (e) {

							if ($('.historyHolder .flex-prev').hasClass('flex-disabled')) {

							} else {

								$('.historyHolder .flex-prev').trigger('click');

							}

						});

						$('.historyHolder .timeline .btnNext').on('click', function (e) {

							if ($('.historyHolder .flex-next').hasClass('flex-disabled')) {

							} else {

								$('.historyHolder .flex-next').trigger('click');

							}

						});	

					} 

				});

			});

		</script>
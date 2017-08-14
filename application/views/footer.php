<footer id="pageFooter">
  <div class="divCenter">
    <div class="pageFooterTop"> <a href="<?php echo base_url();?>" class="footerLogo"><img src="<?php echo base_url();?>assets/images/logoFooter.png"></a>
      <p>Copyright &copy; <?php echo date("Y");?> Dubai Supply Authority .<br>
        All rights reserved. <a href="<?php echo base_url('terms');?>">Terms &amp; Conditions</a> | <a href="<?php echo base_url('privacy');?>">Privacy Policy</a></p>
      <div class="clearFix"></div>
    </div>
    <div class="pageFooterBottom"> <span class="footerBtn">Sitemap</span>
      <div class="footerMenu">
        <ul>
          <li><a href="<?php echo base_url('our-business');?>">about us</a></li>
          <li><a href="<?php echo base_url('hsse');?>safety">HSSE</a></li>
          <li><a href="<?php echo base_url('commercial-services');?>">commercial services</a></li>
          <li><a href="<?php echo base_url('careers');?>">careers</a></li>
          <li><a href="<?php echo base_url();?>">Home</a></li>
        </ul>
      </div>
      <menu>
        <h4><a href="<?php echo base_url('our-business');?>">about us</a></h4>
        <ul>
          <li><a href="<?php echo base_url('our-organisation');?>">about us</a></li>
          <li><a href="<?php echo base_url('margham-field');?>">Margham Gas Plant & Field </a></li>
          <li><a href="<?php echo base_url('pipeline-department');?>">pipelines</a></li>
          <li><a href="<?php echo base_url('lng');?>">lng</a></li>
          <li><a href="<?php echo base_url('transporting-gas');?>">gas control station</a></li>
        </ul>
      </menu>
      <menu>
        <h4><a href="<?php echo base_url('hsse');?>">HSSE</a></h4>
        <ul>
          <!--<li><a href="<?php echo base_url('hsse');?>">HEALTH, SAFETY, SECURITY AND ENVIRONMENT POLICY</a></li>-->
          <li><a href="<?php echo base_url('hse-guidelines');?>">HSE Guidelines for Contractors</a></li>
          <li><a href="<?php echo base_url('operating-excellence');?>">OPERATING EXCELLENCE</a></li>
          <li><a href="<?php echo base_url('lng-project');?>">HSSE EXCELLENCE</a></li>
          <li><a href="<?php echo base_url('ISO14001');?>">iso14001</a></li>
          <li><a href="<?php echo base_url('wildlife');?>">Dusup Wildlife </a></li>
        </ul>
      </menu>
      <menu>
        <h4><a href="<?php echo base_url('commercial-services');?>">commercial services</a></h4>
        <ul>
          <li><a href="<?php echo base_url('commercial');?>">commercial</a></li>
          <li><a href="<?php echo base_url('general-conditions');?>">general conditions</a></li>
        </ul>
      </menu>
      <menu>
        <h4><a href="<?php echo base_url('careers');?>">careers</a></h4>
        <ul>
          <li><a href="<?php echo base_url('careers');?>">careers</a></li>
          <li><a href="<?php echo base_url('careers/vacancies');?>">vacancies</a></li>
        </ul>
      </menu>
      <menu class="boldMenu">
        <h4><a href="<?php echo base_url();?>">Home</a></h4>
        <ul>
          <li><a href="<?php echo base_url('contactus');?>">contact us</a></li>
          <li><a href="<?php echo base_url('news');?>">latest news</a></li>
          <!--<li><a href="gallery.php">gallery</a></li>-->
        </ul>
      </menu>
      <div class="clearFix"></div>
    </div>
    <div class="clearFix"></div>
  </div>
</footer>
<script type="application/javascript">
$(window).load(function() {
	$('.homeBanner .flexslider').flexslider({
		controlNav: true, 
		directionNav: false, 
		animationLoop: true,
		animation: "fade",
		slideshow: true,
		slideshowSpeed: 8000,      
		animationSpeed: 1500 
	});
	$('.homeNewsWrapper .flexslider').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					itemWidth: 480,
					directionNav: true, 
					slideshow: false,
					itemMargin: 0,
					minItems: 1,
					maxItems: 2,     
					animationSpeed: 1500,
					start: function () {
						$('#btnPre').on('click', function (e) {
							$('.homeNewsWrapper .flex-prev').trigger('click');
						});
						$('#btnNex').on('click', function (e) {
							$('.homeNewsWrapper .flex-next').trigger('click');
						});
					} 
				});
});
</script>
<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', 'UA-65734443-1', 'auto');
          ga('send', 'pageview');
        
</script>
</body>

</html>
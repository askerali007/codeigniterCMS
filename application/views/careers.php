<section id="pageContent">
    <div class="innerBanner"> 
    	<div class="bannerText">
        <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span><?php printR($content->page_title_en); ?> </div>
      </div>
    </div>
    <div class="divCenter innerContent">
          <div class="pageTabMenu">
            <ul>
              <li id="careersLink"><a href="javascript:void(0);" rel="#tabCareers">Careers</a><em></em></li>
              <li id="vacancyLink"><a href="javascript:void(0);" rel="#tabVacancies" >Vacancies</a><em></em></li>
            </ul>
            <div class="clearFix"></div>
          </div>
          <div class="careerTab">
                <div class="tabItem" id="tabCareers">
                	<?php printR($content->page_content_en); ?>	
                </div>
                <div class="tabItem"  id="tabVacancies">
              <div class="vacanciesList">
              <?php if($jobs) : ?>
                <table border="0" cellpadding="0" cellspacing="0">
                
                  <thead>
                    <tr>
                      <th><span>Job Position</span></th>
                      <th><span>Job ID</span></th>
                      <th><span>Department</span></th>
                      <th><span>Job Type</span></th>
                      <th><span>Location</span></th>
                      <th><em>apply</em></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($jobs as $job) : ?>
                    <tr class="readMore" rel="<?php echo $job->jobs_id; ?>">
                      <td><span><?php printR( $job->jobs_position); ?></span></td>
                      <td><span><?php echo $job->jobs_id; ?></span></td>
                      <td><span><?php echo $job->department_name; ?></span></td>
                      <td><span><?php echo ($job->jobs_type == '1')?'Permanent':'Contract'; ?></span></td>
                      <td><span><?php echo $job->jobs_location; ?></span></td>
                      <td><a href="<?php echo base_url('applynow').'/'.$job->jobs_id; ?>" class="readMore" title="Apply">View & Apply</a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php else : ?>
              <p> There are no jobs posted here..!</p>
              <?php endif; ?>
              </div>
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
	
});
</script>
<script type="text/javascript">

$(document).ready(function(e) {

	$(".pageTabMenu ul li").removeClass("active");

	<?php if($type	==	'vacancies') : ?>

		$("#vacancyLink").addClass("active");

		$('.careerTab .tabItem').fadeOut(200);

		$("#tabVacancies").fadeIn(200);

	<?php  else : ?>	

	$("#careersLink").addClass("active");

		$('.careerTab .tabItem').fadeOut(200);

		$("#tabCareers").fadeIn(200);

	 <?php endif; ?>

});

</script>
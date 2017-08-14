<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweet-alert.css">
<section id="pageContent">
  <div class="innerBanner"> 
  	<div class="bannerText">
      <div class="textHolder"> <span class="topLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="bottomLine"><span class="largeLine"></span><span class="smallLine"></span></span> <span class="leftLine"></span> <span class="rightLine"></span><?php printR($content->page_title_en); ?></div>
    </div>
   </div>
  <div class="divCenter innerContent">
  	<h2><?php printR($content->page_title_en); ?><span></span></h2>
    <div class="formolder">
    <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="uploadform" id="contactForm">
        <div id="errorContact">
			<?php if(validation_errors()) : ?>
                <span class='msg_error'><?php echo validation_errors(); ?></span>
            <?php endif; ?>
            <?php if($error ) : ?>
                  <span class="msg_error"><?php echo $error;?></span>
           <?php endif;?>
           <?php if($this->session->flashdata('success') ) : ?>
            <span class="msg_success">
                    <?php echo $this->session->flashdata('success');?></span>
           <?php endif;?>
       </div>
        
        <div class="inputHolder queryInput"> <span>First Name<em>*</em></span>
          <label>First Name</label>
          <input type="text" id="fname" name="fname" value="<?php purify($_POST['fname']);?>" >
        </div>
        <div class="inputHolder queryInput"> <span> Last Name<em>*</em></span>
          <label> Last Name</label>
          <input type="text" id="lname" name="lname" value="<?php purify($_POST['lname']);?>" >
        </div>
        <div class="inputHolder queryInput"> <span>Email<em>*</em></span>
          <label>Email</label>
          <input type="text" id="email" name="email" value="<?php purify($_POST['email']);?>" >
        </div>
        <div class="inputHolder queryInput"> <span>Company<em>*</em></span>
          <label>Company</label>
          <input type="text" id="company" name="company" value="<?php purify($_POST['company']);?>" >
        </div>
        <div class="inputHolder queryInput"> <span>Phone Number<em>*</em></span>
          <label>Enter here</label>
          <input type="text"  id="phoneForm" name="phoneForm" value="<?php purify($_POST['phoneForm']);?>">
        </div>
        <div class="inputHolder queryInput"> <span>Country<em>*</em></span>
          <select name="country" id="country">
            <option value="Afghanistan">Afghanistan</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antartica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaijan">Azerbaijan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Benin">Benin</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
            <option value="Botswana">Botswana</option>
            <option value="Bouvet Island">Bouvet Island</option>
            <option value="Brazil">Brazil</option>
            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
            <option value="Brunei Darussalam">Brunei Darussalam</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Burkina Faso">Burkina Faso</option>
            <option value="Burundi">Burundi</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Central African Republic">Central African Republic</option>
            <option value="Chad">Chad</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmas Island">Christmas Island</option>
            <option value="Cocos Islands">Cocos (Keeling) Islands</option>
            <option value="Colombia">Colombia</option>
            <option value="Comoros">Comoros</option>
            <option value="Congo">Congo</option>
            <option value="Congo">Congo, the Democratic Republic of the</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Cota D'Ivoire">Cote d'Ivoire</option>
            <option value="Croatia">Croatia (Hrvatska)</option>
            <option value="Cuba">Cuba</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="East Timor">East Timor</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="Equatorial Guinea">Equatorial Guinea</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Estonia">Estonia</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="France Metropolitan">France, Metropolitan</option>
            <option value="French Guiana">French Guiana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="French Southern Territories">French Southern Territories</option>
            <option value="Gabon">Gabon</option>
            <option value="Gambia">Gambia</option>
            <option value="Georgia">Georgia</option>
            <option value="Germany">Germany</option>
            <option value="Ghana">Ghana</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guam">Guam</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guinea">Guinea</option>
            <option value="Guinea-Bissau">Guinea-Bissau</option>
            <option value="Guyana">Guyana</option>
            <option value="Haiti">Haiti</option>
            <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
            <option value="Holy See">Holy See (Vatican City State)</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Iran">Iran (Islamic Republic of)</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati">Kiribati</option>
            <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
            <option value="Korea">Korea, Republic of</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao">Lao People's Democratic Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macau">Macau</option>
            <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia">Micronesia, Federated States of</option>
            <option value="Moldova">Moldova, Republic of</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Namibia">Namibia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherlands">Netherlands</option>
            <option value="Netherlands Antilles">Netherlands Antilles</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Philippines">Philippines</option>
            <option value="Pitcairn">Pitcairn</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russia">Russian Federation</option>
            <option value="Rwanda">Rwanda</option>
            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
            <option value="Saint LUCIA">Saint LUCIA</option>
            <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
            <option value="Samoa">Samoa</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia (Slovak Republic)</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
            <option value="Span">Spain</option>
            <option value="SriLanka">Sri Lanka</option>
            <option value="St. Helena">St. Helena</option>
            <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syria">Syrian Arab Republic</option>
            <option value="Taiwan">Taiwan, Province of China</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania">Tanzania, United Republic of</option>
            <option value="Thailand">Thailand</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks and Caicos">Turks and Caicos Islands</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates" selected>United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Vietnam">Viet Nam</option>
            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
            <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
            <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
            <option value="Western Sahara">Western Sahara</option>
            <option value="Yemen">Yemen</option>
            <option value="Yugoslavia">Yugoslavia</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
          </select>
        </div>
        <div class="inputHolder textHolder queryInput"> <span>Comments<em>*</em></span>
          <label>Comments</label>
          <textarea id="comments" name="comments"><?php purify($_POST['comments']);?></textarea>
        </div>
        <div class=" queryInput" style="margin:20px 0 0 0;"> 
  			<img src="<?php echo base_url();?>contactus/captcha" alt="" id="captchaImg" title="CAPTCHA" style="border: 1px solid #CCC; margin-right: 5px; " align="left" />           
            <img src="<?php echo base_url();?>assets/images/refresh.png" alt="Reload Image" height="32" width="32" onClick="this.blur()" align="bottom" border="0" style="margin-top:10px;" id="refresh"/>
    		<br />
    </div>
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"  value="<?php echo $this->security->get_csrf_hash(); ?>" />
    <div class="inputHolder  queryInput" style="margin-top: 15px;">
    
    <label id="captchaLabel">Enter the Security Code</label>
    <input type="text" name="captcha" id="captcha"/>
    </div>
        <a href="javascript:void(0);" id="btnSubmit" name="button" class="btnSubmitNow">Submit Now<span class="topLine"></span><span class="bottomLine"></span></a> 
        
        <!-- <input type="button" value="submit now" class="btnSubmit" id="btnSubmit" style="cursor:pointer;"/>--> 
        
        <a href="javascript:clearForm();"  class="clearButton">Clear<span class="topLine"></span><span class="bottomLine"></span></a>
      </form>
    </div>
    <aside class="rightFormHolder" >
    	<?php printR($content->page_content_en); ?>	
    <div class="clearFix"></div>
    </aside>
    <div class="clearFix"></div>
  </div>
</section>
<script type="text/javascript">
$(window).load(function() {
	$(".innerBanner").backstretch(
	<?php echo $banner_images;?>
	, {fade: 1500,duration: 3000});
	$('img#refresh').click(function() {  
		document.getElementById('captchaImg').src="<?php echo base_url();?>/contactus/captcha/?r=" + Math.random();
	});
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/sweet-alert.min.js"></script>
<script>
    $(document).ready(function(e) {
        $("#btnSubmit").click(function(e) {
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var email = $("#email").val();
            var company = $("#company").val();
            var phone = $("#phoneForm").val();
            var country = $("#country").val();
            var comments = $("#comments").val();
			var captcha = $("#captcha").val();
			var regex = /^[0-9a-zA-Z\_\ ]+$/;
            if (fname == null || fname == '') {
                contactError("<span class='error'>Please enter your first name</span>", "firstName");
                return false;
            }
			if(regex.test(fname)==false){			   
			    contactError("<span class='error'>Please enter Valid text as your first name</span>", "firstName");
                return false;			   	
			}
            if (lname == null || lname == '') {
                contactError("<span class='error'>Please enter your last name</span>", "firstName");
                return false;
            }
			if(regex.test(lname)==false){			   
			    contactError("<span class='error'>Please enter Valid text as your last name</span>", "firstName");
                return false;			   	
			}
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (email == null || email == '' || !re.test(email)) {
                contactError("<span class='error'>Please enter a valid Email ID</span>", "emailId");
                return false;
            }
            if (company == null || company == '') {
                contactError("<span class='error'>Please enter your company</span>", "Company");
                return false;
            }
			if(regex.test(company)==false){			   
			    contactError("<span class='error'>Please enter Valid text as your company</span>", "Company");
                return false;			   	
			}
            if (isNaN(phone) || phone == null|| phone =='') {
                contactError("<span class='error'>Please enter a valid phone number</span>", "Company");
                return false;
            }
            if (comments == null || comments == '') {
                contactError("<span class='error'>Please enter your comments</span>", "Details");
                return false;
            }
			if(regex.test(comments)==false){			   
			    contactError("<span class='error'>Please enter Valid text as your comments</span>", "Details");
                return false;			   	
			}
			if (captcha == null || captcha == '') {
                contactError("<span class='error'>Please enter security code</span>", "Details");
                return false;
            }
            
            
			$("#contactForm").submit();
			return false;
           
        });
		<?php if($this->session->flashdata('success') ) : ?>
		swal({title: "Success!",text: "<?php printR($this->session->flashdata('success') ); ?>",type: "success",confirmButtonText: "ok"});
		clearForm();
	<?php endif; ?>

    });

    function clearForm() {
        document.getElementById('contactForm').reset();
        $('label').show();
    }

    function contactError(html, id) {
        $('body,html').animate({
            scrollTop: 300
        }, 800)
        $("#errorContact").html("<span class=msg_error>" + html + "</span>");
        if (id != '') {
            $("#" + id).focus();
            //s$("#"+id).addClass("errortext");
        }
        $("#errorContact").fadeIn();
        return false;
    }
</script>
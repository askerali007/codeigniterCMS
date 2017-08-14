function html5Tags(){
	document.createElement('header');  
	document.createElement('section');  
	document.createElement('nav');  
	document.createElement('footer');  
	document.createElement('menu');  
	document.createElement('hgroup');  
	document.createElement('article');  
	document.createElement('aside');  
	document.createElement('details'); 
	document.createElement('figure');
	document.createElement('time');
	document.createElement('mark');
}

html5Tags();


jQuery(document).ready(function($){
	
	
	project = {
		
		common : {
			commonLoad : function(){
				$('body').append('<div class="popup-bg"></div>');
				$('body').append('<div class="popup-holder"></div>');
				$('.popup-bg').css('opacity', 0.6);
				
				
				 $('.btnMenu').click(function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $('.pageMenu').removeClass('show');
                    } else {
                        $(this).addClass('active');
                        $('.pageMenu').addClass('show');
                    }
                });
				
			/*	$('.pageTabMenu ul li').removeClass("active");				
                $('.pageTabMenu ul li').first().addClass("active");
				$('.careerTab .tabItem').first().fadeIn(200);*/

                $('.pageTabMenu ul li a').live('click', function() {
                    if ($(this).parent().hasClass('active')) {
						
                    } else {
                        $(".pageTabMenu ul li").removeClass("active");
                        $(this).parent().addClass("active");
                        $('.careerTab .tabItem').fadeOut(200);
                        var MyHref = $(this).attr('rel');
                        $(MyHref).fadeIn(200);
                    }
                });
				
				
			var showChar = 200;  // How many characters are shown by default
            var ellipsestext = "...";
   
            $('.teamList').each(function () {
                var content = $(this).find("p").first().html();

                if (content.length > showChar) {

                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);
                    var html = c + '<span class="dotHolder">' + ellipsestext + '&nbsp;</span><span class="morecontent">' + h + '</span>';
                    $(this).find("p").first().html(html);
                }

            });
				
				
				
				
				var moretext = "Read more +";
            	var lesstext = "Read Less -";		
					
				$('.teamList a.readMore').attr('href','javascript:void(0);');
				
				$('.teamList a.readMore').text(moretext);	
					
                $('.teamList a.readMore').live('click', function() {
											
                    if ($(this).hasClass('active')) {
						$(".teamList a.readMore").removeClass('active');
						$(".teamListInner").removeClass('show');
						$(".teamList a.readMore").text(moretext);						
                    } else {
						$(".teamList a.readMore").removeClass('active');
						$(".teamList a.readMore").text(moretext);
						$(this).addClass('active');
						$(this).text(lesstext);
						$(".teamListInner").removeClass('show');
						$(this).parent().parent().find(".teamListInner").addClass('show');
                    }
                });
				
				function careerRightHolder() {
					$(".rightFormHolder").parent().addClass('withRightForm')
					$(".rightGrey").parent().addClass('withRightGrey')
				}
				
				careerRightHolder();
				
				
				
				$('.footerBtn').on('click', function () {
                    if ($(this).hasClass('active')) {
						$(this).removeClass("active");
						$(".pageFooterBottom").removeClass('showMenu');
                    } else {
						$(this).addClass("active");
						$(".pageFooterBottom").addClass('showMenu');
						$("html, body").animate({ scrollTop: $(document).height() }, 1000);
                    }
                });
				
				
				/*
				function middleHeight() {
				  	var winHeight = $(window).height();
					var headHeight = $("#pageHeader").height();
					var footHeight = $("#pageFooter").height();
					var bodyMinHeight = winHeight-headHeight-footHeight-2;
					$("#pageContent, .detailHolder .detailBannerImage, .mapHolder").css({ "height": bodyMinHeight});
				}
				
				middleHeight();
				
				$( window ).resize(function() {
					middleHeight();
					$(".scrollDiv").mCustomScrollbar();
				});
				
				$(".scrollDiv").mCustomScrollbar();				
				
				$(".detailHolder.scrollDiv").mCustomScrollbar();
				
				$('.btnMenu').click(function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $('.pageMenu').removeClass('show');
                    } else {
                        $(this).addClass('active');
                        $('.pageMenu').addClass('show');
                    }
                });
				
				$('.detailHolder .detailBannerImage .btnInfo').click(function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $(".detailHolder.scrollDiv").mCustomScrollbar("scrollTo","top");
                    } else {
                        $(this).addClass('active');
						$(".detailHolder.scrollDiv").mCustomScrollbar("scrollTo","-300px");
                    }
                });
				
				$('.listHolder ul li').addClass("show");

                $('.pageMenu ul li.active ul li a').on('click', function () {
                    if ($(this).parent().hasClass('active')) {
						
                    } else {
						$('.listHolder ul li').removeClass("show");
                        $(".pageMenu ul li ul li").removeClass("active");					
                        $(this).parent().addClass("active");
                        $('.listHolder ul li').hide();
						$('.listHolder ul li').addClass("show");
                        var MyHref = $(this).attr('rel');
                        $(MyHref).show();
                    }
                });
				
				
				*/
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				$.fn.extend({
				zooSelect: function(options){
					var defaults = {
						top: 0,
						left: 0
					}
					var options = $.extend(defaults ,options);
					return this.each(function(){
						var zooObj = $(this);
						zooObj.css({position:'relative'}).find('select').hide();
						var zooOption = $('option', zooObj);
						zooObj.append('<input readonly="readonly" style="cursor: pointer;" /><div class="dropList" style="position: absolute;"><ul></ul></div>');
						var zooInput = $('input', zooObj);
						var zooSelVal = zooOption.parent().val();
						zooInput.val(zooSelVal);
						zooOption.each(function(){
							var zooVal = $(this).text();
							$('.dropList ul', zooObj).append('<li>'+zooVal+'</li>');
						});
						zooOption.removeAttr('selected');
						
						zooInput.live('click', function(){
							$(this).parent().find('.dropList').show();
						});
						zooObj.find('li').live('click', function(){
							zooInput.val($(this).text());
							zooOption.parent().val($(this).text());
						});
						zooInput.live('blur', function(){
							setTimeout(function(){
								zooObj.find('div.dropList').hide();
								return false;
							},120);
						});
					});
					return false;
				}
			});
			$('.selectbox').zooSelect({});
			//End Zoo Custom Select Menu


				
			},
			
			modalClose : function(){
				$('.close').live('click', function(){
					$('.popup-holder, .popup-bg').fadeOut(1000);
					$('.openerVideo, .modalFrame object').hide();
					Join=1;
				});
			},
						
			commonInput : function(){
				
				$( ".queryInput" ).each(function(){
					var getInputId = $(this).find("input, textarea").attr('id');
					$(this).find("label").attr('for',getInputId);
				});
				
				var $inputText = $('.queryInput input, .queryInput textarea');
				$inputText.each(function(){
					var $thisHH = $(this);
					if(!$(this).val()){
						$(this).parent().find('label').show();
					}else{
						setTimeout(function(){
						$thisHH.parent().find('label').hide();
						},100);
					}
					
				});
				$inputText.focus(function(){
					if(!$(this).val()){
						$(this).parent().find('label').addClass('showLab');
					}
				});
				$inputText.keydown(function(){
					if(!$(this).val()){
						$(this).parent().find('label').hide();
					}
				});
				$inputText.live("blur",function(){
					var $thisH = $(this);
					if(!$(this).val()){
						$(this).parent().find('label').show().removeClass('showLab');
					}else{
						$thisH.parent().find('label').hide();
					}
					
				});
				
			}
			
		}//end commonLoad
			
	};
	
	
	project.common.commonLoad();
	project.common.commonInput();
	project.common.modalClose();

});
jQuery.noConflict();
jQuery(document).ready(function($){
	//Menu setup
	var $nav = $('.nav');
	$('.nav li ul,.nav li ul li').css('visibility', 'visible');
	
	// fix for some browsers
	$('a', $nav).attr('title','');
	
	$.fn.reverse = [].reverse;
	$('ul li ul', $nav).reverse().each(function(){
		$(this).data('height', $(this).height()); // can be read only after menu has been shown
		$(this).hide();
	}).hide();
	
	$('li:has(ul)', $nav).hover(function(){
		var $ul = $('>ul', this);

		var height = $ul.data('height');
		
		var origin, anim;
		if($.browser.msie && $.browser.version < 8){
			origin = {
				height: '0px',
				overflow: 'visible'
			};
			anim = {
				height: height+'px'
			};
		} else {
			origin = {
				opacity: 0,
				height: '0px',
				overflow: 'visible'
			};
			anim = {
				opacity: 1,
				height: height+'px'
			};
		}
		
		$ul.show().css(origin).stop().animate(anim, {
			duration: 400,
			easing: 'easeOutExpo'
		});

		if($ul.offset().left + $ul.width() > $(window).width()){
			$ul.css({
				'left': - $ul.width() + 5 + 'px'
			});
		}
	}, function(){
		var $ul = $('>ul', this);

		var anim;
		if($.browser.msie && $.browser.version < 8){
			anim = {
				height: '0px'
			};
		} else {
			anim = {
				opacity: 0,
				height: '0px'
			};
		}
		
		$ul.stop().animate(anim,{
			duration: 400,
			easing: 'easeOutExpo',
			complete: function() { $(this).hide(); }
		});
	});
	
	var rad = '3px';
	// apply corner radius
	$('.nav>ul ul').css({
		'-moz-border-radius-bottomleft': '4px',
		'-moz-border-radius-bottomright': '4px',
		'-webkit-border-bottom-left-radius': '4px',
		'-webkit-border-bottom-right-radius': '4px'
	});
	
	$('.nav>ul>li>ul>li:last-child').css({
		'-moz-border-radius-bottomleft': rad,
		'-moz-border-radius-bottomright': rad,
		'-webkit-border-bottom-left-radius': rad,
		'-webkit-border-bottom-right-radius': rad
	});
	
	$('.nav>ul>li>ul>li:first-child').css({
		'-moz-border-radius-topleft': rad,
		'-moz-border-radius-topright': rad,
		'-webkit-border-top-left-radius': rad,
		'-webkit-border-top-right-radius': rad
	});
	
	$('.nav>ul ul ul>li:first-child').css({
		'-moz-border-radius-topleft': rad,
		'-moz-border-radius-topright': rad,
		'-webkit-border-top-left-radius': rad,
		'-webkit-border-top-right-radius': rad
	});
	
	$('.nav>ul ul ul>li:last-child').css({
		'-moz-border-radius-bottomleft': rad,
		'-moz-border-radius-bottomright': rad,
		'-webkit-border-bottom-left-radius': rad,
		'-webkit-border-bottom-right-radius': rad
	});
	
	// move last menus to the left if it overflows
	var $lastUl = $('>ul>li:last-child>ul', $nav);
	var lastUlWidth = $lastUl.width();
	var lastLiWidth = $('>ul>li:last-child', $nav).width();
	if(lastUlWidth > lastLiWidth){
		newLeft = lastUlWidth - lastLiWidth;
		$lastUl.css('left', '-' + newLeft + 'px');
	}
	$lastUl.css('background-position', '120px 0px');
	
	// fix trim for IE
	if(typeof String.prototype.trim !== 'function') {
		String.prototype.trim = function() {
			return this.replace(/^\s+|\s+$/, ''); 
		}
	}
	
	// searchbars, form elements default text removal
	setupField = function(){
		$(this).data('value', $(this).val())
		.focus(function(){
			if($(this).val() == $(this).data('value')){
				$(this).val('');
			}
		}).blur(function(){
			if($(this).val() == ''){
				$(this).val($(this).data('value'));
			}
		});
	}
	
	$('#top-search,input[name=uds-email],input[name=uds-subject],textarea[name=uds-text]').each(setupField);
	
	// Sidebar slideshow
	$('.uds-slideshow-widget .images img').each(function(i, el){
		var link = $('<div>' + (i + 1) + '</div>');
		if(i != 0) {
			$(this).hide();
		} else {
			$(link).addClass('active');
		}
		$(link).click(function(event){
			$('.uds-slideshow-widget .control div').removeClass('active');
			$(this).addClass('active');
			
			if($('.uds-slideshow-widget .images img:eq(' + i + ')').is(':visible')) return;
			
			$('.uds-slideshow-widget .images img:visible').animate({opacity: 0}, {
				duration: 800, 
				easing: 'easeOutExpo', 
				complete:function(){
					$(this).hide();
					$('.uds-slideshow-widget').height($(this).height());
				}
			});
			
			$('.uds-slideshow-widget .images img:eq(' + i + ')').show().css({opacity: 0}).animate({opacity: 1},{
				duration: 800,
				easing: 'easeOutExpo'
			});
		});
		$('.uds-slideshow-widget .control').append(link);
	});
	$('.uds-slideshow-widget').height($('.uds-slideshow-widget .images img:first').height());
	$('.uds-slideshow-widget .images img:first').load(function(){
		$('.uds-slideshow-widget').height($('.uds-slideshow-widget .images img:first').height());
	});
	
	// Content Slider
	$('.inner-slider').each(function(){
		$(this).cycle({
			delay:parseInt($('.inner-slider-delay', this).remove().text(), 2),
			height:$('.inner-slider-height', this).remove().text()
		});
	});
});
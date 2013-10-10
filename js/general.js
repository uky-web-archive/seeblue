// Utilizing the Modernizr object created to implement placeholder functionality
$(document).ready(function(){

	if(typeof(Modernizr) != 'undefined' && !Modernizr.input.placeholder){
		$('input[type="text"]').each(function(){
			var phAttr = $(this).attr('placeholder');
			if(typeof(phAttr) != 'undefined' && phAttr != false){
				if(phAttr != null && phAttr != ''){
				  $(this).addClass('default_title_text');
				  $(this).val(phAttr);
				  $(this).focus(function(){
					$(this).removeClass('default_title_text');
					if($(this).val() == $(this).attr('placeholder')){
					  $(this).val('');
					}
				  });
				  $(this).blur(function(){
					if($(this).val() == ''){
					  $(this).val($(this).attr('placeholder'));
					  $(this).addClass('default_title_text');
					}
				  });
				}
			}    
		});
	}


	var secondary_menu = $("#block-menu-menu-secondary-navigation .menu").html();

	secondary_menu = '<ul class="menu secondary-menu">' + secondary_menu + '</ul>';

	if (window.innerWidth <= 640)
	{
		//$("#block-system-main-menu .content").append(secondary_menu);
	}

	
	$("#block-system-main-menu ul.menu a.active:first").siblings("ul.menu").each(function (index) {
		$(this).css("display", "block");
		return false;
	});


	// toggle the display of the menu when in reponsive mobile layout
	$('.menulink').click(function(){
		//$('.block-menu .menu:first-child').slideToggle("fast");
		$('#block-system-main-menu .menu:first-child').slideToggle("fast");
		//$('#block-system-main-menu .secondary-menu').slideToggle("fast");
		
	});

	
	//add class to menu list elements (li) based on whether they are parents or leaves
	$('.block-menu .menu li').each(function(index) {
		if ($(this).children().length < 2) { 						  
			$(this).addClass('plainlink');	//add 'plainlink' class to leaves
		}
		else {
			$(this).addClass('parentlink');	//add 'parentlink' class to parents
		}
	});

	//remove href attribute from all parent links
	$('.block-menu .menu li.parentlink > a').attr('href', 'javascript:void(0);');

	//toggle the display of child links when a parent is clicked
	$(".block-menu .parentlink > a").click(function() {
	console.log("Click!");
		if (window.innerWidth <= 640)
		{
			$(this).siblings("ul").slideToggle('slow');
		}
	});


	//toggle the display of child links when a parent is clicked
	$("#sidebar-first .block-menu .parentlink > a").click(function() {
	console.log("Click!");
		if (window.innerWidth > 640)
		{
			$(this).siblings("ul").slideToggle('slow');
		}
	});
	
	$("#content-header .block-menu > .content > .menu > li").mouseover(function() {
		if (window.innerWidth > 640)
		{
			$(this).addClass("active");
		}
	});
	$("#content-header .block-menu > .content > .menu > li").mouseout(function() {
		if ($(this).hasClass("active"))
		{
			$(this).removeClass("active");
		}
	});
	
	
	//when a child link is hovered over, 
	$("#content-header .block-menu > .content > .menu > li li").mouseover(function() {
		$(this).parents("li.parentlink").children("a").addClass("highlight");
	});
	$("#content-header .block-menu > .content > .menu > li li").mouseout(function() {
		$(this).parents("li.parentlink").children("a").removeClass("highlight");
	});

	/*
		Check the window size when it's re-sized to see if we need to hide/show the menu
	*/
	$(window).resize(function() {
		if (window.innerWidth > 640)	//minimum window width for desktop layout
		{
			$(".block-menu .menu:first-child").css("display", "block");
			$('#block-menu-menu-secondary-navigation .menu:first-child').css("display", "block");
			
			if ($("#block-system-main-menu .content .secondary-menu").length)
			{
				$("#block-system-main-menu .content .secondary-menu").remove();
			}
		}
		else
		{
			$("#block-system-main-menu .menu:first-child").css("display", "none");
			$('#block-menu-menu-secondary-navigation .menu:first-child').css("display", "none");
			
			if (!$("#block-system-main-menu .content .secondary-menu").length)
			{
				//$("#block-system-main-menu .content").append(secondary_menu);
			}
		}
	});

	/*
		Only initialize the slider plugin if we have included the script (script is automatically included when slider markup is detected - see template.php)
	*/
	if (typeof $(".rslides").responsiveSlides == 'function')
	{
		//use this variable to toggle the pager for the slideshow - if we have a pager add the margin-bottom to the pager instead of the slideshow itself
		var hasPager = true;
		
		$(".rslides").responsiveSlides({
			pager: hasPager,
			timeout: 20000
		});
		
		(hasPager == false) ? $(".rslides").css("margin-bottom", "2em") : $(".rslides_tabs").css("margin-bottom", "2em");
	}

	$("#tabs").tabs();
	
	1
});
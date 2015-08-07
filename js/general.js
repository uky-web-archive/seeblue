   function position_pager()
    {
        if ($(".flexslider").length > 0) {

            //get the height of the images in the slider
            var img_height = $(".flexslider .slides li:first-child img").css("height");

            //convert "px" string to integer
            img_height = img_height.substr(0, img_height.length-2) * 1;

            //get the height of the pager
            var pager_height = $(".flexslider .flex-control-nav").css("height");

            //convert "px" string to integer
            pager_height = pager_height.substr(0, pager_height.length-2) * 1;

            //calculate the final position of the pager (includes 10 px of padding)
            var pager_top = (img_height - 40) + 'px';

            $(".flexslider .flex-control-nav").css("top", pager_top);
            $(".flexslider .flex-control-nav").css("display", "block");
        }

    }

// Utilizing the Modernizr object created to implement placeholder functionality
$(document).ready(function(){

    /*
    // Add novalidate tag if HTML5.
    if (!$.browser.msie || $.browser.version > 7) {
        this.attr('novalidate', 'novalidate');
    }
    */

    $(".mobile-menu ul.menu").css("display", "none");


        /*
        !!!DEPRECATED!!!
     Only initialize the slider plugin if we have included the script (script is automatically included when slider markup is detected - see template.php)
     */
    if (typeof $(".rslides").responsiveSlides == 'function')
    {
        //use this variable to toggle the pager for the slideshow - if we have a pager add the margin-bottom to the pager instead of the slideshow itself
        var hasPager = true;

        $(".rslides").responsiveSlides({
            pager: hasPager,
            nav: true,
            prevText: "",
            nextText: "",
            timeout: 10000
        });

        setTimeout(position_pager, 1000);

        //(hasPager == false) ? $(".rslides").css("margin-bottom", "2em") : $(".rslides_tabs").css("margin-bottom", "2em");
    }



    //  if the markup and scripts for the slider are in place, initialize it
    if (typeof $(".flexslider").flexslider == 'function') {
        $('.flexslider').flexslider({
            prevText: "",
            nextText: ""
        });


        setTimeout(position_pager, 1000);
    }

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
					  $(this).addClass('default_title_text');}
				  });
				}
			}
		});
	}


	// toggle the display of the menu when in reponsive mobile layout
	$('.menulink').click(function(){
		//$('.block-menu .menu:first-child').slideToggle("fast");
//		$('#block-system-main-menu .menu:first-child').slideToggle("fast");
		$(".mobile-menu .menu:first-child").slideToggle('fast');
		//$('#block-system-main-menu .secondary-menu').slideToggle("fast");

	});

	//add class to menu list elements (li) based on whether they are parents or leaves
//	$('.block-menu .menu li').each(function(index) {

	$('.menu li').each(function(index) {
		if ($(this).children().length < 2) {
			$(this).addClass('plainlink');	//add 'plainlink' class to leaves
		}
		else {
			$(this).addClass('parentlink');	//add 'parentlink' class to parents
            //$(this).children('a').attr('href', 'javascript:void(0);');
		}
	});




    $(".sidebar #block-system-main-menu ul.menu a.active:first").siblings("ul.menu").each(function (index) {
        $(this).css("display", "block");
        return false;
    });

	//$('.menu li.parentlink > a').attr('href', 'javascript:void(0);');

	//toggle the display of child links when a parent is clicked
	$(".parentlink > a").click(function(e) {
		if ($(window).width() <= 640)
		{
			$(this).siblings("ul").slideToggle('slow');
		}
		//e.preventDefault();
	});


	//toggle the display of child links when a parent is clicked
	$(".sidebar .block-menu .parentlink > a").click(function() {
		if ($(window).width() > 640)
		{
			$(this).siblings("ul").slideToggle('slow');
		}
	});

	$("#content-header .block-menu > .content > .menu > li").mouseover(function() {
		if ($(window).width() > 640)
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
		if ($(window).width() > 640)	//minimum window width for desktop layout
		{
			$(".block-menu .menu:first-child").css("display", "block");
			$('#block-menu-menu-secondary-navigation .menu:first-child').css("display", "block");
			$(".mobile-menu .menu").css("display", "none");
			if ($("#block-system-main-menu .content .secondary-menu").length)
			{
				$("#block-system-main-menu .content .secondary-menu").remove();
			}
		}
		else
		{
			$("#block-system-main-menu .menu:first-child").css("display", "none");
			$('#block-menu-menu-secondary-navigation .menu:first-child').css("display", "none");
		}

        position_pager();


	});





	$("#tabs").tabs();





    /*
    When the main nav menu is in the sidebar, expand the nested menus as appropriate to show the current page's link
     */
    if ($(window).width() > 640 ) {
        $(".sidebar #block-system-main-menu .menu li a.active").parents("ul").css("display", "block");
    }




    $("#mobile-search-toggle").click(function() {

        if ($('.searchform input[name="q"]').val().length > 0 && $(".searchform").css("display") == 'block') {

            $("form.searchform").submit();

        }
        else {

            $(".wrap-inner .searchform").slideToggle();

        }

    });

});

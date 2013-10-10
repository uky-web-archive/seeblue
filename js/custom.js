// JavaScript Document

/**
* Using Jquery to create a popup div when the search button is clicked and 
* the screen is less than 480 px
*/
/*
var SlideCount;
var $ = jQuery;
var slides;
var m = function theSwitcher() {
	var ActiveSlide = slides.find('li.active');
	
	if (ActiveSlide.index() != SlideCount) {
		ActiveSlide.siblings().hide();
		ActiveSlide.next().show();
		ActiveSlide.fadeOut('slow', function(){
								$(this).removeClass('active').next().addClass('active'); 	  
							});
	}
	else {
		ActiveSlide.siblings().hide();
		slides.find('li:first-child').show();
		ActiveSlide.fadeOut('slow', function(){
								$(this).removeClass('active');
								slides.find('li:first-child').addClass('active'); 
							});
	}
	setTimeout(m, 4500);
	//console.log("m ran");
	//slides.find('li.active').fadeOut('slow').removeClass('active').next().addClass('active');
	
	//slides.find('li.active').next();
} 
*/
var $ = jQuery;
$(document).ready(function(){
	var SearchForm = $('.searchform')
	var SearchFormButton = SearchForm.find('button[type=submit]');
	SearchFormButton.click(function(event){
		event.preventDefault();
		if (SearchForm.find('label').is(':visible') != true) {
			window.location.href = 'http://www.uky.edu/Search/';
		}
		else {
			SearchForm.submit();
		}
	});
	/*
	slides = $('#slideshow .view-content').find('ul');
	slides.find('li').first().addClass('active');
	slides.find('li.active').siblings().hide();
	SlideCount = slides.find('li').size() - 1;
	//console.log(SlideCount);
	setTimeout(m, 4500);
   /*  $("#imageOne").click(function() {
             $("#imageTwo").fadeIn('fast').siblings().fadeOut('slow');
     });*/
});

	
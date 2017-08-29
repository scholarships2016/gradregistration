// JavaScript Document

//$.fn.extend({
//    animateCss: function (animationName) {
//		"use strict";
//        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
//        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
//            $(this).removeClass('animated ' + animationName);
//        });
//    }
//});

jQuery(document).ready(function($) {
//	"use strict";
//
//	$("#wrapper").append("<div id='dim'>aaa</div>");

	//$('.slick').slick({arrows:false});
	
	 jQuery.scrollDepth();
	 
	 //var isClosed = true;
         $("#bars").live("click", function(){
	 //$('#bars').click(function() {
		if(isClosed) 
		{ 
			isClosed = false; 
			$("#wrapper").addClass("slide");
			$("#dim").addClass("showdim");
		}
		else 
		{ 
			isClosed = true; 
			$("#wrapper").removeClass("slide");
			$("#dim").removeClass("showdim");
		}
	});
	
	//$("#wrapper").hover( function(){ isClosed = true; $("#wrapper").removeClass("slide"); $("#dim").removeClass("showdim");} , function() {  });
        $("#wrapper").live("hover", function(){ isClosed = true; $("#wrapper").removeClass("slide"); $("#dim").removeClass("showdim");} , function() {  });
	
	//$("#dim").click(function() {
        $("#dim").live("click", function(){
		isClosed = true; 
			$("#wrapper").removeClass("slide");
			$("#dim").removeClass("showdim");
	});
	
	
//// Welcome Modal	
//var modal = document.getElementById('myModal');
//var img = document.getElementById('myImg');
//var modalImg = document.getElementById("img01");
////var captionText = document.getElementById("modal-caption");
//if(img)
//{
//	img.onload = function(){
//		modal.style.display = "block"; 
//		modalImg.src = this.src;
//		//modalImg.alt = this.alt;
//		//captionText.innerHTML = this.alt;
//	};
//}
//var span = document.getElementsByClassName("modal-close")[0];
//if(span)
//{
//	span.onclick = function() { 
//    	modal.style.display = "none";
//	};
//}
//	
//	$(".close-modal").click(function(){
//		modal.style.display = "none";
//	});
//
//
////accordion
//var acc = document.getElementsByClassName("accordion");
//var i;
//
//for (i = 0; i < acc.length; i++) {
//    acc[i].onclick = function(){
//        this.classList.toggle("active");
//        this.nextElementSibling.classList.toggle("show");
//    };
//}
	
	
});





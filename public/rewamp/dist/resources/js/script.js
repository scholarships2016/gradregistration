/*-------------------------- Load Header and Footer ------------------------------*/
function loadheaderfooter(tmppath){
  $.get(tmppath+"includes/header-th.html",function(data){
    var res = "";
    res = data.replace(new RegExp("../dist/","g"),"dist/");
    res = res.replace(new RegExp("dist/","g"),tmppath+"dist/");
    $("#header").replaceWith(res);
    initglobal();
  });

  $.get(tmppath+"includes/footer-th.html",function(data){
    var res = "";
    res = data.replace(new RegExp("../dist/","g"),"dist/");
    res = res.replace(new RegExp("dist/","g"),tmppath+"dist/");
    $("#footer").replaceWith(res);
    initglobal();
  });

  $.get(tmppath+"includes/side-menu-th.html",function(data){
    var res = "";
    res = data.replace(new RegExp("../dist/","g"),"dist/");
    res = res.replace(new RegExp("dist/","g"),tmppath+"dist/");
    $("#sidemenu").replaceWith(res);
    initglobal();
    initfaqblock();
  });

}

function loadheaderfooteren(tmppath){
  $.get(tmppath+"includes/header-en.html",function(data){
    var res = "";
    res = data.replace(new RegExp("../dist/","g"),"dist/");
    res = res.replace(new RegExp("dist/","g"),tmppath+"dist/");
    $("#header").replaceWith(res);
    initglobal();
  });

  $.get(tmppath+"includes/footer-en.html",function(data){
    var res = "";
    res = data.replace(new RegExp("../dist/","g"),"dist/");
    res = res.replace(new RegExp("dist/","g"),tmppath+"dist/");
    $("#footer").replaceWith(res);
    initglobal();
  });
    $.get(tmppath+"includes/side-menu-en.html",function(data){
    var res = "";
    res = data.replace(new RegExp("../dist/","g"),"dist/");
    res = res.replace(new RegExp("dist/","g"),tmppath+"dist/");
    $("#sidemenu").replaceWith(res);
    initglobal();
    initfaqblock();
  });
}

/*-------------------------------- function global init ---------------------*/
function initglobal(){
    bindmobilemenu();
    openheaderlv2();
    //initfaqblock();
    slideoutmenu();
    if($(window).width()<1324){
        $(".headerlv1.logo").width(145);
    }else{
        $(".headerlv1.logo").width(210);
    }
    
    $(window).resize(function(){
        if($(window).width()<1324){
            $(".headerlv1.logo").width(145);
        }else{
            $(".headerlv1.logo").width(210);
        }
    });
}

/*--------------------------------function for header ------------------------*/
var currentheaderlv1 = 'set1';
function openheaderlv1(objname){

    if(objname!=currentheaderlv1){

        currentheaderlv1 = objname;
        $(".headerlv1.showmenu").removeClass("showmenu").addClass("hidemenu");

        $(".hfirstlink").removeClass("isselected");
        $(".hfirstlink."+objname).addClass("isselected");

        $(".headerlv1.hidemenu").fadeOut(500,function(){

        }).css("display","none");
        $(".headerlv1."+objname).fadeIn(500,function(){

        }).css("display","inline-block");

    }
    
}
/**/
var currentheaderlv2 = '';
var intervalrollout;
function openheaderlv2(objname){

    if(currentheaderlv2!=objname){

        currentheaderlv2 = objname;
        $(".headerlv2").hide();

        $(".hsecondlink").removeClass("isselected");
        $(".hsecondlink."+objname).addClass("isselected");
        counttimerollout(objname);
        $(".headerlv2."+objname).slideDown(500,function(){});
    }
    
}
function closeheaderlv2(){
    currentheaderlv2 = '';
    $(".hsecondlink").removeClass("isselected");
    $(".headerlv2").slideUp(500,function(){

    });
}
function callbackfrominterval(){
    clearInterval(intervalrollout);
    closeheaderlv2();
}
function counttimerollout(objname){
    
    $('.headerlv2.'+objname).mousemove(function(){
        clearInterval(intervalrollout);
        intervalrollout = setInterval(callbackfrominterval,2000);
    });
}
/**/
function opendivlang(){
    $(".divclicklang").toggleClass("selected");
    if($(".divclicklang").hasClass("selected")){
        $(".choiceoptions").slideDown(300,function(){});
    }else{
        $(".choiceoptions").slideUp(300,function(){});
    }
    
}

/*------------------------------- function for footer ----------------------*/
function openfooter(idx){
    
  if($(window).width()<992){

    if($('.footerlv1:eq('+idx+') > li > a').hasClass("isselected")){
      $('.footerlv1:eq('+idx+') > li > a').removeClass("isselected");
    }else{
      $('.footerlv1:eq('+idx+') > li > a').addClass("isselected");
    }
    
    $('.footerlv2:eq('+idx+')').slideToggle("fast",function(){
        /*----- For IE8 -----*/
        if($.browser.msie && parseFloat($.browser.version)<=8){
            $('.footerlv1:eq('+idx+') > li > a').toggleClass("footermbclose");
        }
    });

  }
}

$(window).resize(function(){
  $('.footerlv1 > li > a').removeClass("isselected");
  if($(window).width()<992){
    /*----- For IE8 -----*/
    if($.browser.msie && parseFloat($.browser.version)<=8){
        $('.footerlv1 > li > a i').hide();
        $('.footerlv1 > li > a').addClass('footermbopen');
    }else{
        $('.footerlv2').css("display","none");
    }
    
  }else{    
    $('.footerlv2').show();
  }
});

/*for mobile */
function bindmobilemenu(){

    /*----- For IE8 -----*/
    if($.browser.msie && parseFloat($.browser.version)<=8){
        $('#menu-mobile-button').addClass('headermbopen');
    }

    $('#menu-mobile-button').click(function(){
        /*----- For IE8 -----*/
        if($.browser.msie && parseFloat($.browser.version)<=8){
            $('#menu-mobile-button').toggleClass('headermbclose');
        }

        $(this).toggleClass('open');
        if($(this).hasClass('open')){
            $(".secondmenumb").slideDown(200,function(){});
            $(".thirdmenumb").slideDown(300,function(){});
        }else{
            $('.divlanguagemb').removeClass('open');
            $(".divlanguagechoice").slideUp(200,function(){});
            $(".divlvsubmain").hide();
            $('.lv1mblink').removeClass('selected');
            $('.lv2').slideUp(200,function(){});
            $(".thirdmenumb").slideUp(200,function(){});
            $(".secondmenumb").slideUp(300,function(){});
            $(".thirdmenumb").css({left:"0%"});
            $(".fourthmenumb").css({left:"100%"});
        }
    });
    $('.divlanguagemb').click(function(){
        $(this).toggleClass('open');
        if($(this).hasClass('open')){
            $(".divlanguagechoice").slideDown(200,function(){});
        }else{
            $(".divlanguagechoice").slideUp(200,function(){});
        }
    });
    
}
function openmobilesubmenu(objname){
    $(".divlvsubmain").hide();
    $("."+objname).show();
    $(".thirdmenumb").animate({left:"-100%"},500,function(){});
    $(".fourthmenumb").animate({left:"0%"},500,function(){});
}
function backmobilesubmenu(){
    $(".thirdmenumb").animate({left:"0%"},500,function(){});
    $(".fourthmenumb").animate({left:"100%"},500,function(){});
    $('.lv1mblink').removeClass('selected');
    $('.lv2').slideUp(200,function(){});
}
function openmobilelv2menu(objname){
    $('.lv1mblink').removeClass('selected');
    $('.lv2').slideUp(200,function(){});
    $('.'+objname+'link').addClass('selected');
    $('.'+objname).slideDown(200,function(){});    
}
/*------------------------------- function for side menu --------------------------*/
function slideoutmenu(){
    $('.sidemenu').hover(function(){
        $('.tabs-menu').stop(true,false).animate({
            right:'40px'
        },800);
    },function(){
        $('.tabs-menu').stop(true,false).animate({
            right:'-180px'
        },800);
    });
}


/*------------------------------- function for Share button ----------------------*/
function sharepage(objname){
  
  $('#'+objname).toggleClass('active');

  var socialwidth = $('#'+objname).parent().parent().find(".followsocial").width();

  if($('#'+objname).hasClass('active')){
    $('#'+objname).parent().parent().find('.share-palette').animate({
        marginLeft: '-='+(socialwidth+5)+'px',
        width:socialwidth+'px'
    },500);
    
  }else{
    $('#'+objname).parent().parent().find('.share-palette').animate({
        marginLeft: '0px',
        width: '0px'
    },500);
  }
}
/*--------------------- Match height for all columns ----------------------*/
function matchheight(){
    var maxheight = 0;
    $(".contentlist > div").css("height","auto");
    $(".contentlist > div").each(function(index){
        //console.log($(".contentlist > div:eq("+index+")").height());
        if($(".contentlist > div:eq("+index+")").height()>maxheight){
            maxheight = $(".contentlist > div:eq("+index+")").height();
        }
    });
    $(".contentlist > div").height(maxheight);
    $(window).resize(function(){
        maxheight = 0;
        $(".contentlist > div").css("height","auto");
        $(".contentlist > div").each(function(index){
            //console.log($(".contentlist > div:eq("+index+")").height());
            if($(".contentlist > div:eq("+index+")").height()>maxheight){
                maxheight = $(".contentlist > div:eq("+index+")").height();
            }
        });
        $(".contentlist > div").height(maxheight);
    });
}
/**/
function matchheight2(){

    // var maxheightsm = 0;
    // var maxheightlg = 0;

    // $(".contentlist > div.itmlg").css("height","auto");
    // $(".contentlist > div.itmsm").css("height","auto");

    
    // $(".contentlist > div.itmlg").height(maxheightlg);

    // $(".contentlist > div.itmsm").each(function(index){
    //     if($(".contentlist > div.itmsm:eq("+index+")").height()>maxheightsm){
    //         maxheightsm = $(".contentlist > div.itmsm:eq("+index+")").height();
    //     }
    // });
    // $(".contentlist > div.itmsm").height(maxheightsm);

    // $(window).resize(function(){
    //      maxheightsm = 0;
    //      maxheightlg = 0;

    //     $(".contentlist > div.itmlg").css("height","auto");
    //     $(".contentlist > div.itmsm").css("height","auto");

       
    //     $(".contentlist > div.itmlg").height(maxheightlg);

    //     $(".contentlist > div.itmsm").each(function(index){
    //         if($(".contentlist > div.itmsm:eq("+index+")").height()>maxheightsm){
    //             maxheightsm = $(".contentlist > div.itmsm:eq("+index+")").height();
    //         }
    //     });
    //     $(".contentlist > div.itmsm").height(maxheightsm);
    // });


}

/*------------------------------- for Slick template ----------------------*/
 $(function(){

    moveslicktype2(); /*custom navigator for slickblock2*/ 

    $('.slickblock1').slick({
        dots:true,
        infinite:true,
        arrows:false,
        swipe:true,
        swipeToSlide:true
    });
    $('.slickblock2').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        slidesToShow:4,
        slidesToScroll:4,
        responsive:
        [{
            breakpoint:1200,
            settings:{
                slidesToShow:3,
                slidesToScroll:3
            }
        },{
            breakpoint:992,
            settings:{
                slidesToShow:2,
                slidesToScroll:2
            }

        },{
            breakpoint:768,
            settings:{
                slidesToShow:2.5,
                slidesToScroll:2
            }

        },]
    });

    $('.slickblock3').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        initialSlide: 0,
        slidesToShow:2.5,
        slidesToScroll:2,
        variableWidth: true,
        adaptiveHeight: true,
        responsive:
        [{
            breakpoint:768,
            settings:{
                slidesToShow:1,
                slidesToScroll:1,
                initialSlide: 0,
                variableWidth: false,
                adaptiveHeight: false,
            }

        }]
        
    }); 


    $('.slickblock4').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        slidesToShow:3,
        slidesToScroll:3,
        responsive:
        [{
            breakpoint:992,
            settings:{
                slidesToShow:2,
                slidesToScroll:2
            }

        },{
            breakpoint:768,
            settings:{
                slidesToShow:1.3,
                slidesToScroll:1
            }
        }]
    });
    $('.slickblock5').slick({
        dots:false,
        infinite:false,
        arrows:false,
        swipe:false,
        slidesToShow:4,
        slidesToScroll:4,
        responsive:
        [{
            breakpoint:768,
            settings:{
                slidesToShow:2.5,
                slidesToScroll:2,
                swipe:true,
            }
        },{
            breakpoint:480,
            settings:{
                slidesToShow:2.4,
                slidesToScroll:2,
                swipe:true,
            }
        }]
    });
    $('.slickblock6').slick({
        dots:false,
        infinite:true,
        arrows:false,
        swipe:false,
        slidesToShow:3,
        responsive:
        [{
            breakpoint:768,
            settings:{
                slidesToShow:2,
                slidesToScroll:2,
                swipe:true,
            }
        }]
    });
    $('.slickblock7').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: true,
        responsive: 
        [{
            breakpoint: 768,
            settings:{
                infinite: false,
                slidesToShow: 1.5,
                slidesToScroll: 1,
                dots: false
            }
        },
        {
            breakpoint: 480,
            settings:{
                infinite: false,
                slidesToShow: 1.2,
                slidesToScroll: 1,
                dots: false
            }
        }
        ]
        
    });
    $('.slickblock8').slick({
        dots:false,
        infinite:false,
        arrows:false,
        swipe:false,
        slidesToShow:3,
        responsive:
        [{
            breakpoint:768,
            settings:{
                infinite:false,
                slidesToShow:1.5,
                slidesToScroll:1,
                swipe:true,
            }
        },
        {
            breakpoint:480,
            settings:{
                infinite:false,
                slidesToShow:1.5,
                slidesToScroll:1,
                swipe:true,
            }
        }]
    });
     $('.slickblock9').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        slidesToShow:1,
    });  

    $('.slickblock10-preview').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slickblock10-nav'
    });

    $('.slickblock10-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.slickblock10-preview',
        focusOnSelect: true,
        centerMode: true,
        responsive:
        [{
            breakpoint:768,
            settings:{
                slidesToShow:3
            }
        },
        {
            breakpoint:480,
            settings:{
                slidesToShow:2
            }
        }]
    });
    $('.slickblock11').slick({
        infinite: false,
        slidesToShow: 7,
        slidesToScroll: 7,
        arrows: false,
        responsive: 
            [{
                breakpoint:1201,
                settings:{
                    infinite: true,
                    slidesToShow: 5,
                    slidesToScroll: 5
                }
            },
            {
                breakpoint:993,
                settings:{
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            }]
    });
     $('.slickblock12').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        slidesToShow:3,
        slidesToScroll:3,
        responsive:
        [{
            breakpoint:992,
            settings:{
                slidesToShow:2,
                slidesToScroll:2
            }

        },{
            breakpoint:768,
            settings:{
                slidesToShow:1.3,
                slidesToScroll:1
            }
        }]
    });
    $('.slickblock13').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        slidesToShow:3,
        slidesToScroll:3,
        responsive:
        [{
            breakpoint:992,
            settings:{
                slidesToShow:2,
                slidesToScroll:2
            }

        },{
            breakpoint:768,
            settings:{
                slidesToShow:1.3,
                slidesToScroll:1
            }
        }]
    });
    $('.slickblock14').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        slidesToShow:3,
        slidesToScroll:3,
        responsive:
        [{
            breakpoint:992,
            settings:{
                slidesToShow:2,
                slidesToScroll:2
            }

        },{
            breakpoint:768,
            settings:{
                slidesToShow:1.3,
                slidesToScroll:1
            }
        }]
    });

    $('.slickblock15').slick({
        dots:false,
        infinite:false,
        arrows:false,
        swipe:false,
        slidesToShow:4,
        responsive:
        [{
            breakpoint:992,
            settings:{
                swipe:true,
                slidesToShow:3,
                slidesToScroll:3
            }
        },{
            breakpoint:768,
            settings:{
                swipe:true,
                slidesToShow:1.3,
                slidesToScroll:1
            }
        }]
    });
    $('.slickblock16').slick({
        dots:true,
        infinite:false,
        arrows:false,
        swipe:true,
        slidesToShow:1,
        slidesToScroll:1
    });


    $('.slickblock9').on('beforeChange',function(){
        openpic();
    });

    $('.slickblock9').on('afterChange',function(){
        opacpic();
    });


    function opacpic(){
        var beforeitem = -1;
        $(".slickblock9 .item").each(function(index){
            if($(".slickblock9 .item:eq("+index+")").attr("aria-hidden")=="false"){
                beforeitem = index-1;
            }
        });
        $(".slickblock9 .item").removeClass("opcpic");
        $(".slickblock9 .item:eq("+beforeitem+")").addClass("opcpic");
    }

    function openpic(){
        var beforeitem = -1;
        $(".slickblock9 .item").each(function(index){
            if($(".slickblock9 .item:eq("+index+")").attr("aria-hidden")=="false"){
                beforeitem = index-1;
            }
        });
        $(".slickblock9 .item:eq("+beforeitem+")").removeClass("opcpic");
    }


    $(function(){
        opacpic();
        openpic();
    });

    $('.slickblock11').on('afterChange',function(){
        delvline();
    });
    function delvline(){
        var lastitem = -1;
        var firstitem = 0;
        var countitem = 0;
        $(".slickblock11 .item").each(function(index){
            if($(".slickblock11 .item:eq("+index+")").attr("aria-hidden")=="false"){
                countitem += 1;
                if(countitem == 1){
                    firstitem = index-1;
                }
                lastitem = index;
            }
        });
        $(".slickblock11 .item").removeClass("vline");
        $(".slickblock11 .item").addClass("vline");
        $(".slickblock11 .item:eq("+lastitem+")").removeClass("vline");
        $(".slickblock11 .item:eq("+firstitem+")").removeClass("vline");
    }
    $(function(){
        delvline();
    });


    function moveslicktype2(){
        $('.prev-slide').on('click',function(){
            $('.slickblock2').slick('slickPrev');
        });
        $('.next-slide').on('click',function(){
            $('.slickblock2').slick('slickNext');
        });

        $('.prev-slide10').on('click',function(){
                $('.slickblock10-preview').slick('slickPrev');
        });
        $('.next-slide10').on('click',function(){
                $('.slickblock10-preview').slick('slickNext');
        });

        $('.prev-slide11').on('click',function(){
            $('.slickblock11').slick('slickPrev');
        });
        $('.next-slide11').on('click',function(){
            $('.slickblock11').slick('slickNext');
        });

        $('.prev-slide16').on('click',function(){
            $('.slickblock16').slick('slickPrev');
        });
        $('.next-slide16').on('click',function(){
            $('.slickblock16').slick('slickNext');
        });
    }

});


/*----------------------------------------for slickblock3----------------------------------------------*/ 
var tmphigh = 0;
var currentactive = false;
var isIE8 = false;
function getmaxheight(){
    tmphigh = 0;
    if($(window).width() > 767){
        $(".picframe3").each(function(index){
            if($(this).height() > tmphigh){
                tmphigh = $(this).height();
            }
        });
        $(".picframe3").height(tmphigh);
        if(isIE8){
            setTimeout(function(){
                currentactive = false;
            },2000);
        }
    }
}

function resizeSlickItem(chkdivnm){
    var slkwidth = $(chkdivnm).width();
    if($(window).width() > 767){
        $( chkdivnm + " .item" ).each(function( index ) {
            if($(window).width() <=  parseInt($(chkdivnm).attr("data-resp-mobile-size"))){      
            
            $(this).width(slkwidth);				
        }else{
        
            $(this).width(parseInt($(this).attr("data-width-per"))*slkwidth/100);            
            }
        });
    }
}

 $(document).on('ready', function() {

    $(".picframe3").css('height','auto');
    if($(window).width() > 767){
        resizeSlickItem(".slickblock3");   
        getmaxheight();  
    }  
 });

 $(window).resize(function(){
    /*----- For IE8 -----*/
    if($.browser.msie && parseFloat($.browser.version)<=8){
        isIE8 = true;
    }


    if(!currentactive){
        if(isIE8){
            currentactive = true;
        }

        $('.slickblock3 li:eq(0) button').click(); 
        tmphigh = 0;
        setTimeout(function(){
            $(".picframe3").css('height','auto');
            if($(window).width() > 767){
                resizeSlickItem(".slickblock3"); 
                getmaxheight();
            }
        },100);
    }
   
});

/*-------------------------------------------------------------------------------------------------*/
function initfaqblock(){
    $('.mainfaqinc .questionclick').on('click',function(){
        $(this).toggleClass('active');
        $(this).parent().find('.catanswer').slideToggle(300,function(){});
    })
}
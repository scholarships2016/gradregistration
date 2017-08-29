/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Start Heighlight slider
jssor_1_slider_init = function () {

    var jssor_1_options = {
        $AutoPlay: true,
        $AutoPlaySteps: 1,
        $SlideDuration: 160,
        $SlideWidth: 283.33,
        $SlideSpacing: 27,
        $Cols: 4,
        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$,
            $Steps: 1
        },
        $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$,
            $SpacingX: 1,
            $SpacingY: 1
        }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

    /*responsive code begin*/
    /*you can remove responsive code if you don't want the slider scales while window resizing*/
    function ScaleSlider() {
        var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
            refSize = Math.min(refSize, 900);
            jssor_1_slider.$ScaleWidth(refSize);
        }
        else {
            window.setTimeout(ScaleSlider, 30);
        }
    }
    ScaleSlider();
    $Jssor$.$AddEvent(window, "load", ScaleSlider);
    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    /*responsive code end*/
};
// End Heighlight slider
// 
// Start Head Banner slider
jssor_h_slider_init = function () {

    var jssor_h_options = {
        $AutoPlay: false,
        $SlideDuration: 800,
        $SlideEasing: $Jease$.$OutQuint,
        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
        },
        $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$
        }
    };

    var jssor_h_slider = new $JssorSlider$("jssor_h", jssor_h_options);

    /*responsive code begin*/
    /*you can remove responsive code if you don't want the slider scales while window resizing*/
    function ScaleSliderH() {
        var refSize = jssor_h_slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
            refSize = Math.min(refSize, 1920);
            jssor_h_slider.$ScaleWidth(refSize);
        }
        else {
            window.setTimeout(ScaleSliderH, 30);
        }
    }
    ScaleSliderH();
    $Jssor$.$AddEvent(window, "load", ScaleSliderH);
    $Jssor$.$AddEvent(window, "resize", ScaleSliderH);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSliderH);
    /*responsive code end*/
};
// End Heighlight slider

var DIALOG_LOADING = "DIALOG_LOADING";
var DIALOG_SYSTEM_ERROR = "DIALOG_SYSTEM_ERROR";
var DIALOG_BUSINESS_ERROR = "DIALOG_BUSINESS_ERROR";
var DIALOG_WARNING = "DIALOG_WARNING";
var DIALOG_PICK_LIST = "DIALOG_PICK_LIST";


$.ajaxSetup({
    error: function(x, e) {
        loadingUI(false);
        var errorDialog;
        if (x.status == 0) {
            errorDialog = loanResponse("ระบบไม่สามารถดำเนินการได้ Network Error " + x.status, "ERROR", null, "SYSTEM ERROR");
        } else if (x.status == 200) {
            $("#biz_error_div").html(x.responseText);
        } else if (x.status == 404) {
            errorDialog = loanResponse("ระบบไม่สามารถดำเนินการได้ กรุณาตรวจสอบข้อมูล " + x.status, "ERROR", null, "SYSTEM ERROR 404");
        } else if (x.status == 500) {
            errorDialog = loanResponse("ระบบไม่สามารถดำเนินการได้ กรุณาตรวจสอบข้อมูล " + x.status, "ERROR", null, "SYSTEM ERROR 500");
        } else {
            errorDialog = loanResponse("ระบบไม่สามารถดำเนินการได้ กรุณาติดต่อผู้ดูแลระบบ " + x.status + x.responseText, "ERROR", null, "SYSTEM ERROR UNKNOW");
        }
        if ($(errorDialog).length > 0) {
            $(errorDialog).parents(".ui-dialog:first").find(".ui-dialog-titlebar").addClass("ui-state-error");
        }
    }
});

var loadingUI = function(isShow, divId) {
    if (divId == undefined) {
        divId = DIALOG_LOADING;
    }
    if ($("#" + divId).length == 0) {
        insertDialog(divId);
    }
    if (isShow == undefined) {
        isShow = true;
    }

    if (isShow) {
        $.blockUI({
            message: $('#' + divId),
            css: {
                width: '190px',
                border: 'none',
                top: ($(window).height() - 40) / 2 + 'px',
                left: ($(window).width() - 190) / 2 + 'px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .8
            }
        });
    } else {
        $.unblockUI();
    }
}

var insertDialog = function(dialogType) {
    if ($(dialogType).length == 0) {
        switch (dialogType) {
            case DIALOG_LOADING:
                $('body').append('<div id="DIALOG_LOADING" class="progress-bar progress-bar-info progress-bar-striped" style="display:none">&nbsp;</div>');
                break;
            case DIALOG_SYSTEM_ERROR:
                $('body').append('<div id="DIALOG_SYSTEM_ERROR"  style="display:none"></div>');
                break;
            case DIALOG_BUSINESS_ERROR:
                $('body').append('<div id="DIALOG_BUSINESS_ERROR"  style="display:none"></div>');
                break;
            case DIALOG_WARNING:
                $('body').append('<div id="DIALOG_WARNING"  style="display:none"></div>');
                break;
            case DIALOG_PICK_LIST:
                $('body').append('<div id="DIALOG_PICK_LIST"  style="display:none"></div>');
                break;
            default:
                $('body').append('<div id="DIALOG_BUSINESS_ERROR"  style="display:none"></div>');
                break;
        }
    }
}

var systemError = function() {
    $("#dialog:ui-dialog").dialog("destroy");
    $("#dialog-system-error").dialog({
        height: 140,
        modal: true
    });
}

// kat edit
var postAjaxRequest = function(form, divId, afterPost, autoIndicator) {

    if (autoIndicator == undefined) {
        autoIndicator = true;
    }
    if (autoIndicator) {
        loadingUI(true);
    }

    var queryString = $(form).serialize();

    var actionUrl = $(form).attr('action');
    if (actionUrl == null || actionUrl == "") {
        if (autoIndicator) {
            loadingUI(false);
        }
        alert("ไม่ได้ระบุ action ใน form");
        return;
    }
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: queryString,
        success: function(data) {
            displayDiv(data, divId, afterPost, autoIndicator);
        }
    });

};

var postSubscribeAjaxRequest = function(form, divId, afterPost, autoIndicator) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }
    if (autoIndicator) {
//        loadingUI();
    }

    var queryString = $(form).serialize();

    var actionUrl = $(form).attr('action');
    if (actionUrl == null || actionUrl == "") {
        if (autoIndicator) {
            loadingUI(false);
        }
        alert("ไม่ได้ระบุ action ใน form");
        return;
    }
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: queryString,
        dataType: 'json', //add dataType เพื่อ get ค่าจาก objectในรูปแบบ jsom
        success: function(data) {
            
            if (data.id === 'success') {
                $('#subscribeDiv').hide();
                //=========== Clear Criteria =================
                $("#fNameRegist").val('');
                $("#lNameRegist").val('');
                $("#telRegist").val('');
                $("#traderFlagRegist").prop('checked', false);
                $("#juristicIdRegist").val('');
                $("#businessNameRegist").val('');
                $("#businessTypeIdRegist").val('');
                $("#businessTypeNameRegist").val('');
                $("#incomeAmtRegist").val('');
                for (var i = 1; i <= 2; i++) {
                    $("#juristicDiv" + i).attr("style", 'display:none');
                }
                //=========== Set Criteria =================
                $("#emailRegist").val(data.email);
                var listItems = "";
                listItems += "<option value=''></option>";
                for (var i = 0; i < data.businessTypeList.length; i++) {
                    listItems += "<option value='" + data.businessTypeList[i].id + "'>" + data.businessTypeList[i].desc + "</option>";
                }
                $('#radioBtn').html('');
                for (var key in  data.titleMap) {
                    var radioBtn = $('<label class="radio-inline"> <input type="radio" name="customerEmailVo.titleName" id= "titleName_' + key + '" value = "' + key + '"/>' + data.titleMap[key] + '</label>');
                    radioBtn.appendTo('#radioBtn');
                }
                $("#businessTypeIdRegist").html(listItems);

                $("#myModalHorizontal").modal('show');
            } else {
                $('#subscribeDiv').show();
                displayDiv(data.desc, divId, afterPost, autoIndicator);
            }
        }
    });
};



var getAjaxRequest = function(url, divId, afterGet, autoIndicator) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }

    if (autoIndicator) {
        loadingUI(true);
    }

    $.get(url, function(data) {
        displayDiv(data, divId, afterGet, autoIndicator);
    });
}

var displayDiv = function(data, divId, afterPost, autoIndicator) {
    if (data.indexOf("<!--#ERROR-->", 0) == 0) {//if return this case still show old data and its page
        $("#biz_error_div").html(data);
    } else if (data.indexOf("<!--#ERROR_UNHANDLE-->", 0) == 0) { // if return this case clear old data
        $("#biz_error_div").html(data);

    } else if (data.indexOf("<!--#LOGIN-->", 0) == 18) { // if return this case clear old data
        var thisHref = $(location).attr('href');
        var strHTML = ""
                + "            <style type=\"text/css\">"
                + "                .ui-widget-header { border: 1px solid #3e6877; background: #f7b850 url(<c:url value='/style/ui-lightness/images/ui-bg_gloss-wave_35_f6a828_500x100.png'/>) 50% 50% repeat-x; color: #ffffff; font-weight: bold; }"
                + "                .actionMessage li{ margin-left: 20px;}"
                + "            </style>"
                + "       <div id=\"dialogErr\" title=\"Error Message\" >"
                + "        <p>"
                + "            <p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"
                + "                <strong>Session Timeout:</strong>"
                + "                <span id=\"errMsgValErr\">"
                + "                  <ul class=\"actionMessage\"><li>หมดเวลาการเข้าใช้งานระบบ กรุณา Login ใหม่อีกครั้ง</li></ul>"
                + "                </span>"
                + "            </p>"
                + "        </p>"
                + "    </div>"
                + "<script type=\"text/javascript\">"
                + "    $(function(){"
                + "        $('#dialogErr').dialog({"
                + "            autoOpen: true,"
                + "            bgiframe:true,"
                + "            modal: true,"
                + "            width: 600,"
                + "            buttons: {"
                + "                \"Ok\": function() {"
                + "                    $(this).dialog(\"close\");"
                + "                     top.location.href='" + thisHref + "'"
                + "                }"
                + "            }"
                + "        });"
                + "    });";
        strHTML += "<\/script>";
        $("#biz_error_div").html(strHTML);
    } else if (data.indexOf("<!--#FAIL LOGIN-->", 0) == 0) {
        $("#errorLogin").html(data);
    } else if (data.indexOf("<!--#SELECT ROLE-->", 0) == 0) {
        $(divId).html(data);
        $("#responseLogin").dialog("open");
    } else if (data.indexOf("<!--#INVALID", 0) == 0) {
        $("#biz_error_div").html(data);
    }
    else if (data.indexOf("<!--#SUCCESS LOGIN-->", 0) == 0) {
        window.location.href = "index.action";
    } else if (data.indexOf("<!--#POPUP RESPONSE-->", 0) == 0) { // if return response as  popup
        $("#biz_error_div").html(data);
    } else if (data.indexOf("<!--#POPUP OVERRIDE-->", 0) == 0) {
        $("#biz_error_div").html(data);
    } else {
        var jDivId = $(divId);
        if (jDivId.length > 0) {
            jDivId.html(data);
            var imageLength = jDivId.find("img").length;
            if (imageLength > 0) {
                $("img").one("load", function() {
                    if (autoIndicator) {
                        loadingUI(false);
                    }
                }).each(function(index) {
                    if (this.complete && index === imageLength) {
                        $(this).load();
                    }
                });
            } else if (autoIndicator) {
                loadingUI(false);
            }
            jDivId.parents(".ui-dialog:first").find(".ui-dialog-titlebar").removeClass("ui-state-error");
        } else {
            loadingUI(false);
        }

        if ($.isFunction(afterPost)) {
            //            afterPost(data);
            afterPost();
        }
    }

    $("form").find('.error').removeClass("error");
};


$.fn.clearForm = function() {
    return this.each(function() {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
            return $(':input', this).clearForm();
        if (type == 'text' || type == 'password' || tag == 'textarea')
            this.value = '';
        else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
        else if (tag == 'select') {
            this.selectedIndex = 0;
            if ($(this).hasClass("chosen")) {
                $(this).trigger('chosen:updated');
            }
        }

    });
};

function clearFormInElement(ele) {
    $(ele).find(':input').each(function() {
        switch (this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}

var loanAlert = function(dialogText, okFunc, dialogTitle, width, height) {
    if (width == null || width == undefined) {
        width = 550;
    }
    if (height == null || height == undefined) {
        height = 75;
    }

    $('<div style="padding: 10px; max-width: 500px; word-wrap: break-word;"><table><tr><td width="40" align="center" valign="top"><img src="img/icon_alert.png"></td><td>' + dialogText + '</td></tr></table></div>').dialog({
        //$('<div class="alert alert-success" role="alert">' + dialogText + '</div>').dialog({
        draggable: true,
        modal: true,
        resizable: false,
        width: width,
        title: dialogTitle || 'Message Box',
        minHeight: height,
        buttons: {
            ตกลง: function() {
                if ($.isFunction(okFunc)) {
                    okFunc();
                }
                $(this).dialog('destroy');
            }
        }
    });
}

var loanAlertPopUp = function(dialogText, okFunc, dialogTitle, width, height) {
    if (width == null || width == undefined) {
        width = 550;
    }
    if (height == null || height == undefined) {
        height = 75;
    }

    $('<div style="padding: 10px; max-width: 500px; word-wrap: break-word;"><table><tr><td width="40" align="center" valign="top"><img src="img/icon_alert.png"></td><td>' + dialogText + '</td></tr></table></div>').dialog({
        draggable: true,
        modal: true,
        resizable: false,
        width: width,
        title: dialogTitle || 'Message Box',
        minHeight: height,
        buttons: {
            ตกลง: function() {
                if ($.isFunction(okFunc)) {
                    okFunc();
                }
                $(this).dialog('destroy');
            }
        }
    });
}

var loanMessage = function(dialogText, okFunc, dialogTitle, width, height) {
    if (width == null || width == undefined) {
        width = 550;
    }
    if (height == null || height == undefined) {
        height = 75;
    }

//    $('<div style="padding: 10px; max-width: 500px; word-wrap: break-word;"><table width="100%"><tr><td width="40" align="center" valign="top"></td><td>' + dialogText + '</td></tr></table></div>').dialog({
    $('<div style="padding: 10px; word-wrap: break-word;"><table width="100%"><tr><td>' + dialogText + '</td></tr></table></div>').dialog({
        draggable: true,
        modal: true,
        resizable: false,
        width: width,
        title: dialogTitle || 'Message Box',
        minHeight: height,
        position: ['center', 20],
        buttons: {
            ตกลง: function() {
                if ($.isFunction(okFunc)) {
                    okFunc();
                }
                $(this).dialog('destroy');
            }
        }
    });
}

var loanConfirm = function(dialogText, okFunc, cancelFunc, dialogTitle, width, height, focusIndex) {
    if (width == null || width == undefined) {
        width = 550;
    }
    if (height == null || height == undefined) {
        height = 75;
    }
    $('<div style="padding: 10px; max-width: 500px; word-wrap: break-word;">' + dialogText + '</div>').dialog({
        draggable: true,
        modal: true,
        resizable: false,
        width: width,
        title: dialogTitle || 'Confirm',
        minHeight: height,
        open: function(event, ui) {
            if (focusIndex != undefined && focusIndex != null) {
                $(this).closest('.ui-dialog').find('.ui-dialog-buttonpane button:eq(' + focusIndex + ')').focus();
            }
        },
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
        },
        buttons: {
            ใช่: function() {
                $(this).dialog('close');
                //                $(this).dialog('destroy');
                return (typeof okFunc == 'string') ?
                        window.location.href = okFunc :
                        $.isFunction(okFunc) ? okFunc() : true;
            },
            ไม่ใช่: function() {
                $(this).dialog('close');
                if ($.isFunction(cancelFunc)) {
                    return cancelFunc();
                } else {
                    return false;
                }
            }
        }
    });
}


var loanForceConfirm = function(dialogText, okFunc, dialogTitle, width, height) {
    if (width == null || width == undefined) {
        width = 550;
    }
    if (height == null || height == undefined) {
        height = 75;
    }
    $('<div style="padding: 10px; max-width: 500px; word-wrap: break-word;">' + dialogText + '</div>').dialog({
        draggable: true,
        modal: true,
        resizable: false,
        width: width,
        title: dialogTitle || 'Confirm',
        minHeight: height,
        closeOnEscape: true,
        close: function(event, ui) {
            return false;
            $(this).dialog('destroy').remove();
        },
        buttons: {
            "ตกลง": function() {
                $(this).dialog('close');
                //                $(this).dialog('destroy');
                return (typeof okFunc == 'string') ?
                        window.location.href = okFunc :
                        okFunc();
            }
        }
    });
}

//var loanResponse = function(dialogText, dialogType, okFunc, dialogTitle, width, height) {
//    if(width==null||width==undefined){
//        width = 350;
//    }
//    if(height==null||height==undefined){
//        height = 75;
//    }
//
//    if(dialogType=="SUCCESS"){
//        dialogType = "<img src='../img/icon_true.png'>&nbsp;&nbsp;";
//    }else if(dialogType=="ERROR"){
//        dialogType = "<img src='../img/icon_alert.png'>&nbsp;&nbsp;";
//    }else{
//        dialogType = "";
//    }
//
//    return $('<div style="padding: 10px; max-width: 500px; word-wrap: break-word;">'+dialogType+'' + dialogText + '</div>').dialog({
//        draggable: true,
//        modal: true,
//        resizable: false,
//        width: width,
//        title: dialogTitle || 'Response',
//        minHeight: height,
//        buttons: {
//            ตกลง: function () {
//                if($.isFunction(okFunc)){
//                    okFunc();
//                }
//                $(this).dialog('destroy');
//            }
//        }
//    });
//}

var loanResponse = function(dialogText, dialogType, okFunc, dialogTitle, width, height) {
    if (width == null || width == undefined) {
        width = 450;
    }
    if (height == null || height == undefined) {
        height = 75;
    }

    if (dialogType == "SUCCESS") {
        dialogType = "save";
    } else if (dialogType == "ERROR") {
        dialogType = "error";
    } else {
        dialogType = "";
    }


    $.fallr('show', {
        buttons: {
            button1: {
                text: 'ตกลง',
                onclick: function() {
                    if ($.isFunction(okFunc)) {
                        okFunc();
                    }
                    $.fallr('hide');
                }
            }
        },
        content: '<p>' + dialogText + '</p>',
        useOverlay: true,
        icon: dialogType
    });
}

var postNextAjaxRequest = function(form, divId, afterPost, autoIndicator) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }
    if (autoIndicator) {
        loadingUI(true);
    }
    var queryString = $(form).serialize();
    queryString = queryString + "&isNextTabMenu=true";

    var actionUrl = $(form).attr('action');
    if (actionUrl == null || actionUrl == "") {
        if (autoIndicator) {
            loadingUI(false);
        }
        alert("ไม่ได้ระบุ action ใน form");
        return;
    }

    $.post(actionUrl, queryString, function(data) {
        displayDiv(data, divId, afterPost, autoIndicator);
    });
}

var postPreviousAjaxRequest = function(form, divId, afterPost, autoIndicator) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }
    if (autoIndicator) {
        loadingUI(true);
    }
    var queryString = $(form).serialize();
    queryString = queryString + "&isPreviousTabMenu=true";

    var actionUrl = $(form).attr('action');
    if (actionUrl == null || actionUrl == "") {
        if (autoIndicator) {
            loadingUI(false);
        }
        alert("ไม่ได้ระบุ action ใน form");
        return;
    }

    $.post(actionUrl, queryString, function(data) {
        displayDiv(data, divId, afterPost, autoIndicator);
    });
}

var getNextAjaxRequest = function(url, divId, afterGet, autoIndicator) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }

    if (autoIndicator) {
        loadingUI(true);
    }

    url = url + "&isNextTabMenu=true";
    $.get(url, function(data) {
        displayDiv(data, divId, afterGet, autoIndicator);
    });
}

var getPreviousAjaxRequest = function(url, divId, afterGet, autoIndicator) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }

    if (autoIndicator) {
        loadingUI(true);
    }

    url = url + "&isPreviousTabMenu=true"
    $.get(url, function(data) {
        displayDiv(data, divId, afterGet, autoIndicator);
    });
}

var postMenuAjaxRequest = function(form, divId, afterPost, autoIndicator, menuId, menuGroup) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }
    if (menuGroup == null || menuGroup == undefined) {
        menuGroup = "";
    }
    if (autoIndicator) {
        loadingUI(true);
    }

    var queryString = $(form).serialize();
    queryString = queryString + "&currentMenuId=" + menuId + "&currentMenuGroup=" + menuGroup;

    var actionUrl = $(form).attr('action');
    if (actionUrl == null || actionUrl == "") {
        if (autoIndicator) {
            loadingUI(false);
        }
        alert("ไม่ได้ระบุ action ใน form");
        return;
    }

    $.post(actionUrl, queryString, function(data) {
        displayDiv(data, divId, afterPost, autoIndicator);
    });
}

var getMenuAjaxRequest = function(url, divId, afterGet, autoIndicator, menuId, menuGroup) {
    if (autoIndicator == undefined) {
        autoIndicator = true;
    }
    if (menuGroup == null || menuGroup == undefined) {
        menuGroup = "";
    }

    if (autoIndicator) {
        loadingUI(true);
    }

    url = url + "&currentMenuId=" + menuId + "&currentMenuGroup=" + menuGroup;
    $.get(url, function(data) {
        displayDiv(data, divId, afterGet, autoIndicator);
    });
}

var mainMenuLink = function(menuId, link, divTarget) {

    //alert(link+"="+menuId+"="+divTarget);

    if (divTarget) {
        divTarget = "#" + divTarget;
    } else {
        divTarget = "#page_main";
    }

    getAjaxRequest("/menu.action?command=forward&link=" + link + "&menuId=" + menuId + "&clickFromMain=true", divTarget);

}

//ใช้กรณี post แล้วใน callback function มีเรียก ajax อีก LoadingUI จะไม่หายไปจนกว่าจะทำงานเสร็จ
var postLoadAjaxRequest = function(form, divId, afterPost, autoIndicator) {

    if (autoIndicator == undefined) {
        autoIndicator = true;
    }
    if (autoIndicator) {
        loadingUI(true);
    }

    var queryString = $(form).serialize();

    var actionUrl = $(form).attr('action');
    if (actionUrl == null || actionUrl == "") {
        if (autoIndicator) {
            loadingUI(false);
        }
        alert("ไม่ได้ระบุ action ใน form");
        return;
    }

    autoIndicator = false;
    $.post(actionUrl, queryString, function(data) {
        displayDiv(data, divId, afterPost, autoIndicator);
    });
}


var beforeTabMenuLinkObject = null;

var beforeTabMenuLinkFunction = function(evalFunction, formName, isConfirm) {
    this.evalFunction = evalFunction;
    this.formName = formName;
    this.isConfirm = isConfirm;
}

var setFunctionBeforTab = function(evalFunction, formName, isConfirm) {
    beforeTabMenuLinkObject = new beforeTabMenuLinkFunction(evalFunction, formName, isConfirm);
}

var tabMenuLink = function(menuId, link, divTarget, param, menuGroup, saveBack) {

    if (menuGroup == null || menuGroup == undefined || menuGroup == "undefined") {
        menuGroup = "";
    }
    if (beforeTabMenuLinkObject != null) {
        var pass = false;
        if (beforeTabMenuLinkObject.isConfirm || beforeTabMenuLinkObject.isConfirm == null) {
            loanConfirm("กรุณาบันทึกข้อมูล ก่อนทำงานต่อไป (OK = ทำงานต่อไป, Cancel = ทำงานหน้านี้ต่อ)", function() {
                beforeTabEval(menuId, param, link, menuGroup, beforeTabMenuLinkObject);
            });
        } else {
            pass = true;
        }

        if (pass) {
            beforeTabEval(menuId, param, link, menuGroup, beforeTabMenuLinkObject);
            //            if($("#currentMenuId").length>0){
            //                $("#currentMenuId").remove();
            //            }
            //            if($("#currentLinkParam").length>0){
            //                $("#currentLinkParam").remove();
            //            }
            //            if($("#isForwardTabMenu").length>0){
            //                $("#isForwardTabMenu").remove();
            //            }
            //            if($("#currentLink").length>0){
            //                $("#currentLink").remove();
            //            }
            //            if($("#currentMenuGroup").length>0){
            //                $("#currentMenuGroup").remove();
            //            }
            //
            //            var currentMenuId = $('<input type="hidden" id="currentMenuId" name="currentMenuId" />');
            //            var currentLinkParam = $('<input type="hidden" id="currentLinkParam" name="currentLinkParam" />');
            //            var isForwardTabMenu = $('<input type="hidden" id="isForwardTabMenu" name="isForwardTabMenu" />');
            //            var currentLink = $('<input type="hidden" id="currentLink" name="currentLink" />');
            //            var currentMenuGroup = $('<input type="hidden" id="currentMenuGroup" name="currentMenuGroup" />');
            //            $(currentMenuId).val(menuId);
            //            $(currentLinkParam).val(param);
            //            $(isForwardTabMenu).val("true");
            //            $(currentLink).val(link);
            //            $(currentMenuGroup).val(menuGroup);
            //
            //            if(beforeTabMenuLinkObject.formName!=null&&beforeTabMenuLinkObject.formName!=undefined){
            //                $('#'+beforeTabMenuLinkObject.formName).append(currentMenuId);
            //                $('#'+beforeTabMenuLinkObject.formName).append(currentLinkParam);
            //                $('#'+beforeTabMenuLinkObject.formName).append(isForwardTabMenu);
            //                $('#'+beforeTabMenuLinkObject.formName).append(currentLink);
            //                $('#'+beforeTabMenuLinkObject.formName).append(currentMenuGroup);
            //            }else{
            //                $('form').append(currentMenuId);
            //                $('form').append(currentLinkParam);
            //                $('form').append(isForwardTabMenu);
            //                $('form').append(currentLink);
            //                $('form').append(currentMenuGroup);
            //            }
            //
            //            var tmpFunction = beforeTabMenuLinkObject.evalFunction;
            //            beforeTabMenuLinkObject=null;
            //            eval(tmpFunction);
        }
    } else {
        if (divTarget) {
            divTarget = "#" + divTarget;
        } else {
            divTarget = "#page_main";
        }
        if (param) {
        } else {
            param = "";
        }
        var linkEncode = encodeURIComponent(link);
        var paramEncode = encodeURIComponent(param);
        getAjaxRequest("menu.action?command=forward&link=" + linkEncode + "&menuId=" + menuId + "&menuGroup=" + menuGroup + "&linkParam=" + paramEncode + "&saveBack=" + saveBack + "&fromMainMenu=false", divTarget, function() {
            $(window).scrollTop(0);
        });
    }
}

var beforeTabEval = function(menuId, param, link, menuGroup, beforeTabMenuLinkObject) {
    if ($("#currentMenuId").length > 0) {
        $("#currentMenuId").remove();
    }
    if ($("#currentLinkParam").length > 0) {
        $("#currentLinkParam").remove();
    }
    if ($("#isForwardTabMenu").length > 0) {
        $("#isForwardTabMenu").remove();
    }
    if ($("#currentLink").length > 0) {
        $("#currentLink").remove();
    }
    if ($("#currentMenuGroup").length > 0) {
        $("#currentMenuGroup").remove();
    }

    var currentMenuId = $('<input type="hidden" id="currentMenuId" name="currentMenuId" />');
    var currentLinkParam = $('<input type="hidden" id="currentLinkParam" name="currentLinkParam" />');
    var isForwardTabMenu = $('<input type="hidden" id="isForwardTabMenu" name="isForwardTabMenu" />');
    var currentLink = $('<input type="hidden" id="currentLink" name="currentLink" />');
    var currentMenuGroup = $('<input type="hidden" id="currentMenuGroup" name="currentMenuGroup" />');
    $(currentMenuId).val(menuId);
    $(currentLinkParam).val(param);
    $(isForwardTabMenu).val("true");
    $(currentLink).val(link);
    $(currentMenuGroup).val(menuGroup);

    if (beforeTabMenuLinkObject.formName != null && beforeTabMenuLinkObject.formName != undefined) {
        $('#' + beforeTabMenuLinkObject.formName).append(currentMenuId);
        $('#' + beforeTabMenuLinkObject.formName).append(currentLinkParam);
        $('#' + beforeTabMenuLinkObject.formName).append(isForwardTabMenu);
        $('#' + beforeTabMenuLinkObject.formName).append(currentLink);
        $('#' + beforeTabMenuLinkObject.formName).append(currentMenuGroup);
    } else {
        $('form').append(currentMenuId);
        $('form').append(currentLinkParam);
        $('form').append(isForwardTabMenu);
        $('form').append(currentLink);
        $('form').append(currentMenuGroup);
    }

    var tmpFunction = beforeTabMenuLinkObject.evalFunction;
    beforeTabMenuLinkObject = null;
    eval(tmpFunction);
}

var gotoBack = function() {
    getAjaxRequest("/menu.action?command=back", "#page_main", function() {
        $(window).scrollTop(0);
    });
}

function format(obj, value, decimal) {
    //decimal  - the number of decimals after the digit from 0 to 3
    //-- Returns the passed number as a string in the xxx,xxx.xx format.
    if (value == "") {
        obj.value = ""
    } else {
        var sign = "";
        if (value.toString().indexOf(',') != -1) {
            value = parseFloat(value.toString().replace(/,/g, ''));
        }
        if (value.toString().indexOf('-') != -1) {
            sign = "-";
        }
        value = Math.abs(value);
        anynum = value;
        divider = 10;
        switch (decimal) {
            case 0:
                divider = 1;
                break;
            case 1:
                divider = 10;
                break;
            case 2:
                divider = 100;
                break;
            default:  	 //for 3 decimal places
                divider = 1000;
        }

        workNum = Math.abs((Math.round(anynum * divider) / divider));

        workStr = "" + workNum;

        if (workStr.indexOf(".") == -1) {
            workStr += "."
        }

        dStr = workStr.substr(0, workStr.indexOf("."));
        dNum = dStr - 0;
        pStr = workStr.substr(workStr.indexOf("."))

        while (pStr.length - 1 < decimal) {
            pStr += "0"
        }

        if (pStr == '.')
            pStr = '';

        //--- Adds a comma in the thousands place.
        if (dNum >= 1000) {
            dLen = dStr.length;
            dStr = parseInt("" + (dNum / 1000)) + "," + dStr.substring(dLen - 3, dLen);
        }

        //-- Adds a comma in the millions place.
        if (dNum >= 1000000) {
            dLen = dStr.length;
            dStr = parseInt("" + (dNum / 1000000)) + "," + dStr.substring(dLen - 7, dLen);
        }

        //-- Adds a comma in the thousand millions place.
        if (dNum >= 1000000000) {
            dLen = dStr.length;
            dStr = parseInt("" + (dNum / 1000000000)) + "," + dStr.substring(dLen - 11, dLen);
        }

        //-- Adds a comma in place.
        if (dNum >= 1000000000000) {
            dLen = dStr.length;
            dStr = parseInt("" + (dNum / 1000000000000)) + "," + dStr.substring(dLen - 15, dLen);
        }

        //-- Adds a comma in place.
        if (dNum >= 1000000000000000) {
            dLen = dStr.length;
            dStr = parseInt("" + (dNum / 1000000000000000)) + "," + dStr.substring(dLen - 19, dLen);
        }

        //-- Adds a comma in  place.
        if (dNum >= 1000000000000000000) {
            dLen = dStr.length;
            dStr = parseInt("" + (dNum / 1000000000000000000)) + "," + dStr.substring(dLen - 23, dLen);
        }
        retval = dStr + pStr;
        //-- Put numbers in parentheses if negative.
        if (anynum < 0) {
            retval = "(" + retval + ")";
        }


        //You could include a dollar sign in the return value.
        //retval =  "$"+retval

        if (sign + retval == "NaN.00") {
            obj.value = "";
        } else {
            obj.value = sign + retval;
        }
    }


}

//Date format YYYYMMDD
function calCizExpDate(cizidIssueDt, birthDt) {
    var expDt = new Date();
    var cpBirthDateInc = 0, cp10July2554 = 6;
    var issueDate = new Date(cizidIssueDt.substr(0, 4) * 1 > 2500 ? cizidIssueDt.substr(0, 4) * 1 - 543 : cizidIssueDt.substr(0, 4) * 1, cizidIssueDt.substr(4, 2) * 1 - 1, cizidIssueDt.substr(6, 2));
    var birthDate = new Date(birthDt.substr(0, 4) * 1 > 2500 ? birthDt.substr(0, 4) * 1 - 543 : birthDt.substr(0, 4) * 1, birthDt.substr(4, 2) * 1 - 1, birthDt.substr(6, 2));
    if (issueDate.getMonth() > birthDate.getMonth()) {
        cpBirthDateInc = 1;
    } else if (issueDate.getMonth() < birthDate.getMonth()) {
        cpBirthDateInc = 0;
    } else {
        if (issueDate.getDate() > birthDate.getDate()) {
            cpBirthDateInc = 1;
        } else {
            cpBirthDateInc = 0;
        }
    }

    var july102554 = new Date(2011, 6, 10);

    if (issueDate >= july102554) {
        cp10July2554 = 8;
    }

    expDt = new Date(birthDate);
    expDt.setDate(expDt.getDate() - 1);
    expDt.setFullYear(issueDate.getFullYear() * 1 + cpBirthDateInc + cp10July2554);
    return expDt;
}


function clearElement(ele) {
    switch ($(ele).get(0).type) {
        case 'password':
        case 'select-multiple':
        case 'select-one':
        case 'hidden':
        case 'text':
        case 'textarea':
            $(ele).val('');
            break;
        case 'checkbox':
        case 'radio':
            $(ele).attr("checked", false);
    }
}

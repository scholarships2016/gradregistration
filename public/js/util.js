/**
 * Created by worakanpongnumkul on 7/1/2017 AD.
 */
function showToastFromAjaxResponse(obj) {
    if (obj.status == 'success') {
        toastr.success(obj.message);
    } else if (obj.status == 'warning') {
        toastr.warning(obj.message);
    } else if (obj.status == 'error') {
        toastr.error(obj.message);
    }
    return obj.data;
}

function serializeObject(a) {
    var o = {};
    // var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
}

function isUndefinedOrNull(obj) {
    return (obj === undefined || obj === null || obj === '') ? true : false;
}
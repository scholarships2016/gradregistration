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
@if(Session::has('warningMsg'))
    var warningMsg = "{{session('warningMsg')}}";
    toastr.warning(warningMsg);
@elseif(Session::has('successMsg'))
    var successMsg = "{{session('successMsg')}}";
    toastr.success(successMsg);
@elseif(Session::has('errorMsg'))
    var errorMsg = "{{session('errorMsg')}}";
    toastr.error(errorMsg);
@endif


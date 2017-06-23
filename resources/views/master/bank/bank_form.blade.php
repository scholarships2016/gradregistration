<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/bank/bank_form/') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $id }}">

            <div class="form-group">
                <label class="col-md-4 control-label">รหัสธนาคาร/Bank Code</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="bank_id"     value="{{ $bank ? $bank->bank_id : '' }}">
                    {!!$errors->first('bank_id', '<span class="control-label color-red" for="bank_id">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">บัญชีธนาคาร/Bank Account</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="bank_account" value="{{ $bank ? $bank->bank_account : '' }}">
                    {!!$errors->first('bank_name', '<span class="control-label color-red" for="bank_name">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">ชื่อธนาคาร/Bank Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="bank_name" value="{{ $bank ? $bank->bank_name : '' }}">
                    {!!$errors->first('bank_name_en', '<span class="control-label color-red" for="bank_name_en">*:message</span>')!!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-md-4 control-label">ค่าธรรมเนียม/Fee</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="bank_fee" value="{{ $bank ? $bank->bank_fee : '' }}">
                    {!!$errors->first('bank_name_en', '<span class="control-label color-red" for="bank_name_en">*:message</span>')!!}
                </div>
            </div>
             <div class="form-group">
                <label class="col-md-4 control-label">รูป/logo</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="bank_logo" value="{{ $bank ? $bank->bank_logo : '' }}">
                    {!!$errors->first('bank_name_en', '<span class="control-label color-red" for="bank_name_en">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-save"></i>
                        {{$id == 0 ? 'Create':'Update'}}
                    </button>

                    <a href="{{url('/bank')}}" class="btn btn-success">
                        <i class="fa fa-user-md"></i>
                        ย้อนกลับ
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>



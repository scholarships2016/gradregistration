<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/degree/degree_form/') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $id }}">

            <div class="form-group">
                <label class="col-md-4 control-label">รหัสปริญญา/Degree_id</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="degree_id"  {{ $degree ? '': 'readonly' }}  value="{{ $degree ? $degree->degree_id : '' }}">
                    {!!$errors->first('degree_id', '<span class="control-label color-red" for="degree_id">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">ชื่อปริญญาภาษาไทย /Degree_name(Thai)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="degree_name" value="{{ $degree ? $degree->degree_name : '' }}">
                    {!!$errors->first('degree_name', '<span class="control-label color-red" for="degree_name">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">ชื่อปริญญาภาษาอังกฤษ/Degree_name(English)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="degree_name_en" value="{{ $degree ? $degree->degree_name_en : '' }}">
                    {!!$errors->first('degree_name_en', '<span class="control-label color-red" for="degree_name_en">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-save"></i>
                        {{$id == 0 ? 'Create':'Update'}}
                    </button>

                    <a href="{{url('/degree')}}" class="btn btn-success">
                        <i class="fa fa-user-md"></i>
                        ย้อนกลับ
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>



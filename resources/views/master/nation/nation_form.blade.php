<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/nation/nation_form/') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $id }}">

            <div class="form-group">
                <label class="col-md-4 control-label">รหัสประเทศ/Nation_id</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nation_id"  {{ (empty($id)) ? '': 'readonly' }}  value="{{ $nation ? $nation->nation_id : '' }}">
                    {!!$errors->first('nation_id', '<span class="control-label color-red" for="nation_id">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">ชื่อประเทศ/Nation_name(Thai)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nation_name" value="{{ $nation ? $nation->nation_name : '' }}">
                    {!!$errors->first('nation_name', '<span class="control-label color-red" for="nation_name">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">ชื่อประเทศ/Nation_name(English)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nation_name_en" value="{{ $nation ? $nation->nation_name_en : '' }}">
                    {!!$errors->first('nation_name_en', '<span class="control-label color-red" for="nation_name_en">*:message</span>')!!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-save"></i>
                        {{$id == 0 ? 'Create':'Update'}}
                    </button>

                    <a href="{{url('/nation')}}" class="btn btn-success">
                        <i class="fa fa-user-md"></i>
                        ย้อนกลับ
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>



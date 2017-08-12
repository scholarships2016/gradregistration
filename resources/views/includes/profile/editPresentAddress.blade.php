<div class="portlet box red-pink">
    <div class="portlet-title">
        <div class="caption">
            {{--<i class="fa fa-user"></i>--}}
            {{Lang::get('resource.lbPerAddress')}}

        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
  
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form id="presentAddressForm" name="presentAddressForm" action="#" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$applicant->applicant_id}}">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbNoMoo')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_addr_no" name="stu_addr_no"
                                       value="{{$applicant->stu_addr_no}}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbVillage')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_addr_village" name="stu_addr_village"
                                       value="{{$applicant->stu_addr_village}}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbSoi')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_addr_soi" name="stu_addr_soi"
                                       value="{{$applicant->stu_addr_soi}}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbRoad')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_addr_road" name="stu_addr_road"
                                       value="{{$applicant->stu_addr_road}}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbProvince')}}
                            </label>
                            <div class="col-md-9">
                                <input type="hidden" id="province_id_hidden" name="province_id_hidden"
                                       value="{{$applicant->province_id}}">
                                <select class="form-control select2" id="province_id"
                                        name="province_id">
                                    @if(!empty($provinceList))
                                        @foreach ( $provinceList as $prov )
                                            <option value="{{$prov->province_id}}">{{$prov->province_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbDistrict')}}
                            </label>
                            <div class="col-md-9">
                                <input type="hidden" id="district_code_hidden" name="district_code_hidden"
                                       value="{{$applicant->district_code}}">
                                <select class="form-control select2" id="district_code"
                                        name="district_code">
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbSubdistrict')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_addr_tumbon" name="stu_addr_tumbon"
                                       value="{{$applicant->stu_addr_tumbon}}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbZipcode')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_addr_pcode" maxlength="5" name="stu_addr_pcode"
                                       value="{{$applicant->stu_addr_pcode}}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">{{Lang::get('resource.lbOtherContactNo')}}
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_phone" name="stu_phone" value="{{$applicant->stu_phone}}"
                                       class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn green" id="savePersAddress">{{Lang::get('resource.lbSave')}}</button>
                                <button type="reset" class="btn default" id="clearPersAddress">{{Lang::get('resource.lbCancel')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>

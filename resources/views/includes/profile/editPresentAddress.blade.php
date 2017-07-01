<div class="portlet box red-pink">
    <div class="portlet-title">
        <div class="caption">
            {{--<i class="fa fa-user"></i>--}}
            ที่อยู่ที่สามารถติดต่อได้
            <small>Present Address</small>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="javascript:;" class="reload"> </a>
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
                            <label class="control-label col-md-3">เลขที่/หมู่
                                <div>
                                    <small>No/Moo</small>
                                </div>
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
                            <label class="control-label col-md-3">หมู่บ้าน
                                <div>
                                    <small>Village</small>
                                </div>
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
                            <label class="control-label col-md-3">ตรอก/ซอย
                                <div>
                                    <small>Soi</small>
                                </div>
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
                            <label class="control-label col-md-3">ถนน
                                <div>
                                    <small>Road</small>
                                </div>
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
                            <label class="control-label col-md-3">จังหวัด
                                <div>
                                    <small>Province</small>
                                </div>
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
                            <label class="control-label col-md-3">อำเภอ
                                <div>
                                    <small>District</small>
                                </div>
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
                            <label class="control-label col-md-3">ตำบล
                                <div>
                                    <small>Subdistrict</small>
                                </div>
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
                            <label class="control-label col-md-3">รหัสไปรษณีย์
                                <div>
                                    <small>Zipcode</small>
                                </div>
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="stu_addr_pcode" name="stu_addr_pcode"
                                       value="{{$applicant->stu_addr_pcode}}" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">โทรศัพท์อื่นๆ ที่สามารถติดต่อได้
                                <div>
                                    <small>Other Contact No.</small>
                                </div>
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
                                <button type="button" class="btn green" id="savePersAddress">บันทึก</button>
                                <button type="reset" class="btn default" id="clearPersAddress">ยกเลิก</button>
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

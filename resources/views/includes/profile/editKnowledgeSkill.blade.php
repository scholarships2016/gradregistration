<div class="portlet box red-pink">
    <div class="portlet-title">
        <div class="caption">
            {{--<i class="fa fa-user"></i>--}}
            การทดสอบความรู้ความสามารถ
            <small>Knowledge Skill</small>
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="javascript:;" class="reload"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <form id="knowledgeForm" name="knowledgeForm" action="#" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$applicant->applicant_id}}">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">ภาษาอังกฤษ
                                <div>
                                    <small>English</small>
                                </div>
                            </label>
                            <div class="col-md-9">
                                <input type="hidden" id="eng_test_id_hidden" name="eng_test_id_hidden"
                                       value="{{$applicant->eng_test_id}}"/>
                                <select class="form-control input-small select2" id="eng_test_id" name="eng_test_id">
                                    @if(!empty($engTestList))
                                        @foreach ($engTestList as $engTest)
                                            <option value="{{$engTest->eng_test_id}}">{{$engTest->eng_test_name}}</option>
                                        @endforeach
                                    @endif
                                </select> <span class="help-block">(ตัวอย่างการเทียบคะแนน Example)</span>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="control-label">คะแนน
                                                <div>
                                                    <small>Score</small>
                                                </div>
                                            </label>
                                            <input type="text" class="form-control" id="eng_test_score"
                                                   name="eng_test_score" value="{{$applicant->eng_test_score}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">เมื่อวันที่
                                                <div>
                                                    <small>Date Taken</small>
                                                </div>
                                            </label>
                                            <input type="text" class="form-control" id="eng_date_taken"
                                                   name="eng_date_taken" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">ภาษาไทย
                                <div>
                                    <small>Thai</small>
                                </div>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="thai_test_score" name="thai_test_score"
                                       value="{{$applicant->thai_test_score}}">
                                <span class="help-block">คะแนน&nbsp;<small>Score</small></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">ความถนัดทางธุรกิจ (CU-BEST)
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="cu_best_score" name="cu_best_score" value="{{$applicant->cu_best_score}}">
                                <span class="help-block">คะแนน&nbsp;<small>Score</small></span>
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
                                <button type="button" id="saveKnowledge" name="saveKnowledge" class="btn green">บันทึก</button>
                                <button type="reset" id="clearKnowledge" name="clearKnowledge" class="btn default">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </form>

    </div>
</div>

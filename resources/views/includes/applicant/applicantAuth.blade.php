<!-- /.modal -->
<div class="modal fade" id="applicantAuthModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">ให้สิทธิสมัคร</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">เลขประจำตัวประชาชน :</label>
                        <input type="text" id="stu_citizen_card" placeholder="" class="form-control"
                               disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">ชื่อ-นามสกุล :</label>
                        <input type="text" id="fullname_thai" class="form-control"
                               disabled>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div>
                    <form class="" role="form" id="applicantAuthModalForm">
                        {{csrf_field()}}
                        <input type="hidden" id="applicant_id_hidden" name="applicant_id" value=""/>
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>ให้สิทธิสมัครพิเศษ
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="form-group mt-repeater">
                                        <div id="applicant_special_group" data-repeater-list="applicant_special_group">
                                            <div data-repeater-item class="mt-repeater-item">
                                                <input type="hidden" id="appt_spec_appl_id" name="appt_spec_appl_id"
                                                       value=""/>
                                                <input type="hidden" id="applicant_id" name="applicant_id"
                                                       value=""/>
                                                <input type="hidden" id="curriculum_id_hidden"
                                                       name="curriculum_id_hidden" value=""/>
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">หลักสูตร</label>
                                                    <br/>
                                                    <select name="curriculum_id" id="curriculum_id"
                                                            class="form-control select2" onchange="checkCurriculum(this)">
                                                    </select>
                                                </div>
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">วันที่ให้สิทธิ</label>
                                                    <br/>
                                                    <div class="input-group input-large date-picker input-daterange"
                                                         data-date="10/11/2012" data-date-format="dd-mm-yyyy">
                                                        <input type="text" class="form-control" id="start_date"
                                                               name="start_date">
                                                        <span class="input-group-addon"> ถึง </span>
                                                        <input type="text" class="form-control" id="end_date"
                                                               name="end_date">
                                                    </div>
                                                </div>
                                                <div class="mt-repeater-input">
                                                    <a href="javascript:;" data-repeater-delete
                                                       class="btn btn-danger mt-repeater-delete">
                                                        <i class="fa fa-close"></i> ลบ</a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:;" data-repeater-create
                                           class="btn btn-success mt-repeater-add">
                                            <i class="fa fa-plus"></i> เพิ่มสิทธิ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save" class="btn green">บันทึก</button>
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">ปิด</button>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->



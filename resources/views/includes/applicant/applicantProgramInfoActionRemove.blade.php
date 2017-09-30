<!-- /.modal -->
<div class="modal fade bs-modal-lg" id="applicationProgramInfoActionRemoveModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">สถานะใบสมัคร</h4>
            </div>
            <div class="modal-body form">
                <div id="ajaxLoading" class="row col-md-12 text-center">
                    <br>
                    <img src="{{asset('/assets/global/img/loading-spinner-grey.gif')}}" alt="" class="loading">
                    <span> &nbsp;&nbsp;กำลังโหลดข้อมูล... </span>
                </div>
                <form id="applicationInfoForm" class="form-horizontal form-bordered" role="form">
                    {{csrf_field()}}
                    <input type="hidden" id="application_id" name="application_id"/>
                    <input type="hidden" id="curr_prog_id" name="curr_prog_id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">สถานะใบสมัคร&nbsp;:</label>
                            <div class="col-md-9">
                                <p class="form-control-static" id="flow_name_p">-</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">รหัสหลักสูตร&nbsp;:</label>
                            <div class="col-md-9">
                                <p class="form-control-static" id="program_id_p">-</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ชื่อหลักสูตร&nbsp;:</label>
                            <div class="col-md-9">
                                <p class="form-control-static" id="prog_name_p">-</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">แผน&nbsp;:</label>
                            <div class="col-md-9">
                                <p class="form-control-static" id="plan_p">-</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ประเภทหลักสูตร&nbsp;:</label>
                            <div class="col-md-9">
                                <p class="form-control-static" id="prog_type_name_p">-</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a id="downloadDocButton" target="_blank" href="{{url("admin/docMyCourse/")}}/" class="btn green btn-outline pull-left">ดาวน์โหลดใบสมัคร & เอกสาร</a>

                <button type="button" id="deleteBtn" onclick="deleteApplication(this)" class="btn red">ลบใบสมัคร</button>
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">ปิด</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

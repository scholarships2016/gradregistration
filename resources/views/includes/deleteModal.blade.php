<div class="modal fade" id="confirmDeleteModalDiv" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="container-fluid">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><i class="fa fa-times" style="color:red"></i>&nbsp;ลบข้อมูล
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="delHidden" name="delHidden">
                            ต้องการลบช้อมูล "<strong style="color:red"><span id="deleteName"></span></strong>" ?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="modalDeleteBt" name="modalDeleteBt">
                        <i class="fa fa-times"></i>&nbsp;ลบ
                    </button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="modalCloseBt"
                            name="modalCloseBt">
                        ยกเลิก
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
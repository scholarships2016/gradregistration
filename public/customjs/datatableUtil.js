/**
 * Created by worakanpongnumkul on 5/13/2017 AD.
 */
var DatatableCustom = function () {

    return {
        init: function (tableId, options) {
            var tableObj = $(tableId).DataTable(options);
            var rows_selected = [];
            var selectedData = [];

            $(tableId + ' tbody').on('click', 'input[type="checkbox"]', function (e) {
                var $row = $(this).closest('tr');
                var data = tableObj.row($row).data();
                var rowId = data.id;
                // var index = $.inArray(rowId, rows_selected);
                var index = inObject(rowId, selectedData);
                if (this.checked && index === -1) {
                    // rows_selected.push(rowId);
                    selectedData.push(data);
                } else if (!this.checked && index !== -1) {
                    // rows_selected.splice(index, 1);
                    selectedData.splice(index, 1);
                }
                if (this.checked) {
                    $row.addClass('selected');
                } else {
                    $row.removeClass('selected');
                }
                updateDataTableSelectAllCtrl(tableObj);
                e.stopPropagation();
            });

            $(tableId).on('click', 'tbody td, thead th:first-child', function (e) {
                $(this).parent().find('input[type="checkbox"]').trigger('click');
            });

            $('thead input[name="select_all"]', tableObj.table().container()).on('click', function (e) {
                if (this.checked) {
                    $('#userTbl tbody input[type="checkbox"]:not(:checked)').trigger('click');
                } else {
                    $('#userTbl tbody input[type="checkbox"]:checked').trigger('click');
                }
                e.stopPropagation();
            });

            tableObj.on('draw', function () {
                updateDataTableSelectAllCtrl(tableObj);
            });

            $('.dataTables_wrapper').removeClass("form-inline");
            var parentTblObj = $(tableId).parent();
            parentTblObj.removeClass("col-xs-12");
            parentTblObj.addClass('col');

            function updateDataTableSelectAllCtrl(table) {
                var $table = table.table().node();
                var $chkbox_all = $('tbody input[type="checkbox"]', $table);
                var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
                var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);
                if ($chkbox_checked.length === 0) {
                    chkbox_select_all.checked = false;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = false;
                    }
                } else if ($chkbox_checked.length === $chkbox_all.length) {
                    chkbox_select_all.checked = true;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = false;
                    }
                } else {
                    chkbox_select_all.checked = true;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = true;
                    }
                }
            }

            function inObject(id, objArray) {
                var index = -1;
                for (var i = 0; i < objArray.length; i++) {
                    if (objArray[i].id == id) {
                        index = i;
                        break;
                    }
                }
                return index;
            }


            this.table = tableObj;
            this.rows_selected = rows_selected;
            this.selectedData = selectedData;
            return this;
        },
        selected: function () {
            return this.selectedData;
        }
    };
}
();
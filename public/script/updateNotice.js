/**
 * Created by worakanpongnumkul on 8/29/2017 AD.
 */

var label1 = 'รายการ';
var rejectClass = 'label label-sm label-danger',
    approvedClass = 'label label-sm label-success',
    pendingClass = 'label label-sm label-warning',
    draftClass = 'label label-sm label-default';

function getNotice(url, editLink) {
    $.ajax({
        url: url,
        method: "get",
        success: function (result) {
            var data = showToastFromAjaxResponse(result);
            if (data !== null) {
                updateNotice(data, editLink);
            }
        }
    });
}

function genNoticeItem(obj, editLink) {
    var li = document.createElement('li');
    var aLink = document.createElement('a');
    var spanItem = document.createElement('span');
    var spanDetail = document.createElement('span');
    var spanLabel = document.createElement('span');
    spanDetail.className = 'details';

    if (obj !== null) {
        spanItem.className = 'time';
        spanItem.innerText = (obj.semester == 1 ? 'ต้น' : 'ปลาย') + '/' + obj.academic_year;
        if (obj.status_id == 4) {
            spanLabel.className = approvedClass;
            spanLabel.innerText = 'Approved';
        } else if (obj.status_id == 3) {
            spanLabel.className = rejectClass;
            spanLabel.innerText = 'Reject';
        } else if (obj.status_id == 2) {
            spanLabel.className = pendingClass;
            spanLabel.innerText = 'Pending';
        } else if (obj.status_id == 1) {
            spanLabel.className = draftClass;
            spanLabel.innerText = 'Draft';
        }
        spanDetail.append(spanLabel);
        spanDetail.append('' + obj.degree_name);
        aLink.href = editLink + '/' + obj.curriculum_id;
        aLink.append(spanItem);
        aLink.append(spanDetail);
    } else {
        aLink.className = 'text-center';
        spanDetail.innerText = 'No Task';
        aLink.append(spanDetail);
    }
    li.append(aLink);
    return li;
}


function updateNotice(data, editLink) {
    var totalAmt = data.length;
    $("#noticeList").empty();
    $.each(data, function (index, value) {
        $("#noticeList").append(genNoticeItem(value, editLink));
    });
    $("#noticeAmt1").text(totalAmt == 0 ? '' : totalAmt);
    $("#noticeAmt2").text(totalAmt == 0 ? '-' : totalAmt);
}


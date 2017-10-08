
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


        <style>
            @page { margin: 20px 30px; }


            @font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: normal;
                src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
            }
            @font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: bold;
                src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
            }
            @font-face {
                font-family: 'THSarabunNew';
                font-style: italic;
                font-weight: normal;
                src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
            }
            @font-face {
                font-family: 'THSarabunNew';
                font-style: italic;
                font-weight: bold;
                src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
            }

            body {
                font-family: "THSarabunNew";
                line-height: 11px;
            }


        </style>
    </head>
    <body> <br><br><br>
        <table width="750px" border="0" >
            <tr>

            </tr>
        </table>
        <div class="caption" style="text-align: center">
            รายชื่อผู้สมัครหลักสูตร {{$lbthai}}  แยกตามหลักสูตร(GS03)<br>
            ประจำภาคการศึกษา {{($lbsemester==1)?'ต้น [First]':'ปลาย [Second]'}} ปีการศึกษา {{$lbYear}} <br><br>

            หลักสูตร  {{$reports[0]->degree_name}} - {{$reports[0]->degree_name_en}}(รหัส {{$reports[0]->program_id}} )
            สาขาวิชา  {{$reports[0]->major_name}} -{{$reports[0]->major_name_en}} <br>
            ภาควิชา   {{$reports[0]->department_name }} ({{$reports[0]->department_name_en }}) คณะ  {{$reports[0]->faculty_name}} ({{$reports[0]->faculty_full}} )<br>
              @if($reports[0]->sub_major_id!="")แขนงวิชา {{$reports[0]->sub_major_name}} - {{$reports[0]->sub_major_name_en }} ({{$reports[0]->sub_major_id}})@endif

        </div>


        <br><br>
        <table width="750px" border="1"  cellpadding="0" cellspacing="0" bgcolor="#ffffff" align="center">
            <thead>
                <tr align="center" role="row"><th class="sorting_disabled" rowspan="1" colspan="1"> ลำดับ </th><th class="sorting_disabled" rowspan="1" colspan="1"> ชื่อ-สกุล </th><th class="sorting_disabled" rowspan="1" colspan="1"> มีสิทธิ์สอบ </th><th class="sorting_disabled" rowspan="1" colspan="1"> ไม่มีสิทธิ์สอบ </th><th class="sorting_disabled" rowspan="1" colspan="1"> หมายเหตุ </th><th class="sorting_disabled" rowspan="1" colspan="1"> เลขที่ใบสมัคร </th><th class="sorting_disabled" rowspan="1" colspan="1"> คะแนนภาษาอังกฤษ </th></tr>
            </thead>

            <tbody>
            <div style="display: none"> {{$pcount=0}}{{$pnocount=0}}</div>
                @foreach($reports as $report)
              <div style="display: none">   {{$pnocount += (($report->exam_status==3)?1:0)}}
                {{$pcount += (($report->exam_status==2)?1:0)}} </div>
                <tr role="row" >
                    <td style="text-align:center; vertical-align:middle;">{{$loop->iteration}}</td>
                    <td >{{ $report->name_title .' '. $report->stu_first_name. ' '.$report->stu_last_name  }}<br>{{$report->name_title_en.' '. $report->stu_first_name_en. ' '.$report->stu_last_name_en }} </td>
                    <td align="center" style="text-align:center; vertical-align:middle;"> <input type="checkbox"   {{(($report->exam_status==2)?'checked':'')}}   class="checkboxes"></td>
                    <td align="center" style="text-align:center; vertical-align:middle;"> <input type="checkbox"   {{(($report->exam_status==3)?'checked':'')}}    class="checkboxes"></td>
                    <td >{{$report->exam_remark}}</td>
                    <td style="text-align:center;  vertical-align:middle;">{{$report->app_ida}}</td>
                    <td style="text-align:center; vertical-align:middle;">{{($report->eng_test_score_admin!= null)?$report->eng_test_score_admin:$report->eng_test_score}}</td>
                </tr>
                @endforeach
            </tbody>
    </table><br><br>
        <div  align="right">

        <table style="width:300px;" align="right">
         <tr> <td> รวมจำนวนผู้สมัคร     </td>    <td> {{$reports->count()}} คน </td> </tr>
          <tr>    <td colspan="2"> ผลการพิจารณาของภาค</td> </tr>
            <tr> <td> จํานวนผู้มีสิทธิสอบ     </td>    <td> {{$pcount}} คน</td> </tr>
            <tr> <td> จํานวนผู้ไม่มีสิทธิสอบ   </td>    <td>   {{$pnocount}} คน </td> </tr>
        </table>

            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div  align="center" style="width:1100px; border:1px">
            (ลงนาม) ............................................................
            <br>
        ({{$suser}})<br>
        <br>
       {{ $sposition}}<br>
        วันที่ {{$datenow}}
        </div>
        </div>
    </body>
</html>


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
            รายชื่อผู้สอบได้มากกว่า 1 สาขา<br>
            ประจำภาคการศึกษา {{($lbsemester==1)?'ต้น [First]':'ปลาย [Second]'}} ปีการศึกษา {{$lbYear}} <br><br>
        </div>


        <br><br> 
        <table width="750px" border="1"  cellpadding="0" cellspacing="0" bgcolor="#ffffff" align="center">
            <thead>
                <tr align="center" role="row">
                    <th> # </th>
                    <th> เลขที่ใบสมัคร </th>
                    <th> ชื่อ-สกุล </th>
                    <th> หลักสูตร </th>
                    <th> ประเภทหลักสูตร </th>
                    <th> หมายเหตุ </th></tr>
            </thead>

            <tbody>

                @foreach($reports as $report)

                <tr role="row" >
                    <td style="text-align:center; vertical-align:middle;">{{$loop->iteration}}</td>
                    <td style="text-align:center;  vertical-align:middle;">{{$report->app_ida}}</td>
                    <td >{{ $report->name_titles .' '. $report->stu_first_name. ' '.$report->stu_last_name  }}<br>{{$report->name_title_en.' '. $report->stu_first_name_en. ' '.$report->stu_last_name_en }} </td>
                    <td >{{$report->majorcode.'  '.$report->prog_name}}</td>
                    <td >{{$report->cond_id.'  '.$report->degree_level_name.' '.$report->office_time }}</td>
                    <td >{{$report->admission_remark}}</td>
   </tr>
                @endforeach
            </tbody>
        </table><br><br> วันที่ ออกรายงาน {{$datenow}}
    
    </body>
</html>

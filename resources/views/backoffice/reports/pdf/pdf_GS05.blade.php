
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

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body> <br><br><br>
        <table width="750px" border="0" >
            <tr>

            </tr>
        </table>
        <div class="caption" style="text-align: center">
            รายชือผู้มีสิทธิเข้าศึกษาในระดับบัณฑิตศึกษา จุฬาลงกรณ์มหาวิทยาลัย(GS05)<br>
            ประจำภาคการศึกษา {{($lbsemester==1)?'ต้น [First]':'ปลาย [Second]'}} ปีการศึกษา {{$lbYear}} <br><br>

            คณะ  {{$reports[0]->faculty_name}} ({{$reports[0]->faculty_full}})<br>
            ภาควิชา   {{$reports[0]->department_name }} ({{$reports[0]->department_name_en }})     <br>
            สาขาวิชา  {{$reports[0]->major_name}} ({{$reports[0]->major_name_en}}) <br>
            หลักสูตร  {{$reports[0]->degree_name}} - {{$reports[0]->degree_name_en}}(รหัส {{$reports[0]->program_id}})<br>
        
              @if($reports[0]->sub_major_id!="")แขนงวิชา {{$reports[0]->sub_major_name}} - {{$reports[0]->sub_major_name_en }} ({{$reports[0]->sub_major_id}})@endif
                <br>

        </div>


        <br><br>
        <table width="750px" border="1"  cellpadding="0" cellspacing="0" bgcolor="#ffffff" align="center">
            <thead><tr align="center" >
               <th> เลขที่ใบสมัคร </th>
                                <th> ชื่อ-สกุล </th>
                                <th> สัญชาติ </th>
                                <th> เพศ </th>
                                <th> โครงการ </th>
                                  <th> สถานะ  </th>
                                   <th> สำเร็จปริญาตรี  </th>
                                   <th> สำเร็จปริญาโท  </th>
                                    <th> คะแนนภาษาอังกฤษ </th>
                                    <th> หมายเหตุ </th></tr>
            </thead>

            <tbody>
            <div style="display: none"> {{$p1=0}}{{$p2=0}}{{$p3=0}}{{$p4=0}}{{$p5=0}}{{$p6=0}}{{$p7=0}}{{$p8=0}}{{$p9=0}}{{$p10=0}}{{$p11=0}}{{$p12=0}}{{$p13=0}}{{$p14=0}}</div>
                @foreach($reports as $report)
              <div style="display: none">
                {{$p1 += (($report->admission_status_id=='0')?1:0)}}
                {{$p2 += (($report->admission_status_id=='2')?1:0)}}
                {{$p3 += (($report->admission_status_id=='3')?1:0)}}
                {{$p4 += (($report->admission_status_id=='4')?1:0)}}
                {{$p5 += (($report->admission_status_id=='5')?1:0)}}
                {{$p6 += (($report->admission_status_id=='6')?1:0)}}
                {{$p7 += (($report->admission_status_id=='7')?1:0)}}
                {{$p8 += (($report->admission_status_id=='8')?1:0)}}
                {{$p9 += (($report->admission_status_id=='9')?1:0)}}
                {{$p10 += (($report->admission_status_id=='A')?1:0)}}
                {{$p11 += (($report->admission_status_id=='B')?1:0)}}
                {{$p12 += (($report->admission_status_id=='C')?1:0)}}
                {{$p13 += (($report->admission_status_id=='D')?1:0)}}
                {{$p14 += (($report->admission_status_id=='E')?1:0)}}
              </div>
                <tr role="row" >
                    <td style="text-align:center; vertical-align:middle;">{{$report->app_ida}}</td>
                    <td > {{ $report->name_title .' '. $report->stu_first_name. ' '.$report->stu_last_name  }} <br> {{$report->name_title_en.' '. $report->stu_first_name_en. ' '.$report->stu_last_name_en }} </td>
                    <td align="center" >{{$report->nation_name.' ['.$report->nation_name_en.']'}}</td>
                    <td align="center" >{{(($report->stu_sex==1)?'ชาย [Male]':'หญิง [Female]')}}</td>
                    <td align="center" >{{$report->project_id}}</td>
                    <td align="center" >{{$report->admission_status_id}}</td>
                    <td align="center" >{{$report->bachlor_year}}</td>
                    <td align="center" >{{$report->master_year}}</td>
                   <td style="text-align:center; vertical-align:middle;">{{($report->eng_test_score_admin!= null)?$report->eng_test_score_admin:$report->eng_test_score}}</td>
                    <td >&nbsp; {{$report->admission_remark}}</td>

                     </tr>
                @endforeach
            </tbody>
    </table>

    <div class="page-break"></div>

    <br><br>
        <div  align="right">

        <table style="width:350px;" align="right">
          <tr> <td colspan="2"> สถานะ</td> </tr>
          <tr> <td width="80%"> (0) ยังไม่ได้พิจารณา     </td>    <td> {{$p1}} คน </td> </tr>
          <tr> <td> (2) ศึกษาบางรายวิชาแบบวิจัย     </td>    <td> {{$p2}} คน </td> </tr>
          <tr> <td> (3) ศึกษาบางรายวิชาแบบข้ามมหาวิทยาลัย     </td>    <td> {{$p3}} คน </td> </tr>
          <tr> <td> (4) ศึกษาบางรายวิชาแบบร่วมฟังการบรรยาย     </td>    <td> {{$p4}} คน </td> </tr>
          <tr> <td> (5) สามัญเต็มเวลา      </td>    <td> {{$p5}} คน </td> </tr>
          <tr> <td> (6) สามัญบางเวลา     </td>    <td> {{$p6}} คน </td> </tr>
          <tr> <td> (7) ทดลองศึกษาเต็มเวลา     </td>    <td> {{$p7}} คน </td> </tr>
          <tr> <td> (8) ทดลองศึกษาบางเวลา     </td>    <td> {{$p8}} คน </td> </tr>
          <tr> <td> (9) ศึกษาบางรายวิชาแบบอืนๆ     </td>    <td> {{$p9}} คน </td> </tr>
          <tr> <td> (A) สํารอง (ผ่านการทดสอบ)     </td>    <td> {{$p10}} คน </td> </tr>
          <tr> <td> (B) บริหารหลักสูตรแบบต่อเนือง (เต็มเวลา)     </td>    <td> {{$p11}} คน </td> </tr>
          <tr> <td> (C) บริหารหลักสูตรแบบต่อเนือง (ไม่เต็มเวลา)     </td>    <td> {{$p12}} คน </td> </tr>
          <tr> <td> (D) ทดลองศึกษาเต็มเวลา (หลักสูตรต่อเนือง)     </td>    <td> {{$p13}} คน </td> </tr>
          <tr> <td> (E) ทดลองศึกษาบางเวลา(หลักสูตรต่อเนือง)     </td>    <td> {{$p14}} คน </td> </tr>

        </table>



            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br><br><br><br><br><br><br><br><br><br>
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

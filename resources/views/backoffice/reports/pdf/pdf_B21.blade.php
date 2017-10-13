
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
            รายชื่อผู้ผ่านการสอบคัดเลือกเข้าศึกษาในระดับบัณฑิตศึกษา จุฬาลงกรณ์มหวิทยาลัย<br>
            ประจำภาคการศึกษา {{($lbsemester==1)?'ต้น [First]':'ปลาย [Second]'}} ปีการศึกษา {{$lbYear}} <br><br>

            คณะ  {{$reports[0]->faculty_name}} ({{$reports[0]->faculty_full}})<br>
            ภาควิชา   {{$reports[0]->department_name }} ({{$reports[0]->department_name_en }})     <br>
            สาขาวิชา  {{$reports[0]->major_name}} ({{$reports[0]->major_name_en}}) <br>
            หลักสูตร  {{$reports[0]->degree_name}} - {{$reports[0]->degree_name_en}}(รหัส {{$reports[0]->program_id}})<br>
          
            @if($reports[0]->sub_major_id!="")แขนงวิชา {{$reports[0]->sub_major_name}} - {{$reports[0]->sub_major_name_en }} ({{$reports[0]->sub_major_id}})@endif
              <br>

            กําหนดการปฐมนิเทศของภาควิชา {{$orientation}}

        </div>


        <br><br>
        <table width="750px" border="1"  cellpadding="0" cellspacing="0" bgcolor="#ffffff" align="center">
            <thead><tr align="center" >
                    <th> ที่ </th>
                    <th> ชือ - นามสกุล <br> (เรียงตามเลขทีสมัคร) </th>
                    <th> สัญชาติ </th>
                    <th> สามัญ  </th>
                    <th> ทดลองศึกษา </th>
                    <th> สํารองเรียง<br>ตามลําดับ  </th>
                    <th> GPA เกรดเฉลีย  </th>
                    <th> คะแนน<br>ภาษาอังกฤษ  </th>
                    <th> หมายเหตุ </th>
            </thead>

            <tbody>
            <div style="display: none">{{$i=0}} {{$a1=0}} {{$a2=0}}    </div>
            @foreach($reports as $report)
            <div style="display: none">
                 
                {{$a1+=(($report->admission_status_id == 'A' )?1:0)}}
                {{$a2+=(($report->admission_status_id == '5'||$report->admission_status_id == 'B'||$report->admission_status_id == 'C')?1:0)}}
            </div>
            <tr role="row" >
                <td style="text-align:center; vertical-align:middle;">{{$i += 1}}</td>
                <td >{{ $report->name_title .' '. $report->stu_first_name. ' '.$report->stu_last_name  }}<br>{{$report->name_title_en.' '. $report->stu_first_name_en. ' '.$report->stu_last_name_en }} </td>
                <td align="center" >{{$report->nation_name}}<br>{{'['.$report->nation_name_en.']'}}</td>
                <td align="center" ><img alt="" border="0" width="15px" src="{{asset('images/check.png')}}" style="{{(($report->admission_status_id == '5'||$report->admission_status_id == 'B'||$report->admission_status_id == 'C')?'':'display:none;')}}" >       </td>
                <td align="center" ><img alt="" border="0" width="15px" src="{{asset('images/check.png')}}" style="{{(($report->admission_status_id == '7'||$report->admission_status_id == 'D'||$report->admission_status_id == 'E')?'':'display:none;')}}" > </td>
                <td align="center" ><img alt="" border="0" width="15px" src="{{asset('images/check.png')}}" style="{{(($report->admission_status_id == 'A' )?'':'display:none;')}}" > </td>
                <td align="center" >{{$report->edu_gpax}}</td>
                <td align="center" >{{(($report->eng_test_score_admin != null)?   ($report->eng_test_score_admin.'('.$report->engTAdmin.')' )   :  ($report->eng_test_score.'('.$report->engT.')'))}}</td>
                <td >{{$report->admission_remark}}</td>

            </tr>
            @endforeach
        </tbody>
    </table><br><br>
    <div  align="left">


        <table style="width:300px;" align="left">
            <tr><td>ผู้สมัครทั้งหมด   {{$cur1}} ราย</td><td>ผู้ผ่านการคัดเลือกเข้าศึกษา     {{$a2}} ราย</td></tr>
                <tr><td>ผู้มีสิทธิ์สอบ  {{$cur2}}  ราย</td><td>สำรอง     {{$a1}} ราย</td></tr>
        </table>
        <br><br><br><br>
           ทังนี้ {!!$txt1!!}
        <br><br><br><br>
        <div  align="center" style="width:1100px; border:1px">
            <table style="width:750px" ><tr><td align="center">(ลงนาม) ............................................................</td><td align="center">(ลงนาม) ............................................................</td></tr>
                <tr><td align="center">({{ $suser }})</td><td align="center">({{ $suser1}})</td></tr>
                <tr><td align="center">{{ $sposition}}</td><td align="center">{{ $sposition1}}</td></tr>
                <tr><td align="center">  ........ / ........ / ........</td><td align="center">  ........ / ........ / ........</td></tr>
            </table>

        </div>
    </div>
    <div>หมายเหตุ
        <br>1 . โปรดส่ง บ.21 พร้อมใบสมัครฉบับจริงของผู้ผ่านการสอบคัดเลือก สําเนาผลคะแนนภาษาอังกฤษและสําเนาบัตรประจําตัวประชาชน
        <br>2 . กรณีเรียกนิสิตสํารอง กรุณาแจ้งบัณฑิตวิทยาลัยอย่างช้าทีสุดภายในสัปดาห์แรกของการเปิดภาคเรียนพร้อมบันทึกขอยกเว้นค่าปรับในการลงทะเบียนเรียน
        <br>3 . กรณีทีนิสิตขอเข้าร่วมฟัง(Visitor) ให้กําหนดระยะเวลาการขอเข้าร่วมฟังในช่องหมายเหตุ</div>
</body>
</html>

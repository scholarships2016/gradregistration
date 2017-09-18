
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
    <body> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
       @foreach($apps as $app)
        <table width="750px" border="0"  cellpadding="0" cellspacing="0" bgcolor="#ffffff" align="center">
            <tbody>
                <tr>
                    <td>
                        <div align="center">(ให้ส่งเป็นกระดาษ A4 ไม่ต้องตัด)</div>
                        <hr><br>
                        <div align="center"><b>ใบแจ้งที่อยู่ของผู้สมัคร</b> (ส่งแนบมาพร้อมใบสมัคร)    </div>
                        <br> <br>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="300px" align="left">
                                      {{$app->mailing_address}}
                                    </td>
                                    <td width="220px" align="right"></td>
                                </tr>

                                <tr>
                                    <td align="left">&nbsp;</td>
                                    <td align="right">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left"><table width="100%" border="0">
                                            <tbody><tr>
                                                    <td width="200px"><div align="right">กรุณาส่ง</div></td>
                                                    <td width="500px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>{{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>เลขที่ {{$applicant->stu_addr_no}}
                                                        หมู่บ้าน  {{$applicant->stu_addr_village}}
                                                        ตรอก/ซอย  {{$applicant->stu_addr_soi }}
                                                        ถนน  {{$applicant->stu_addr_road }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>แขวง/ตำบล  {{$applicant->stu_addr_tumbon }},
                                                        เขต/อำเภอ  {{$applicant->district_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td> จังหวัด {{$applicant->province_name}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>รหัสไปรษณีย์  {{$applicant->stu_addr_pcode }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tbody></table></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><div align="center">สมัครสาขาวิชา Subject: {{$app->major_name }} ( {{$app->program_id }} )[{{$app->degree_level_name }}] ระดับ Degree: {{$app->degree_name}} - {{$app->degree_name_en}}
                                            <br>
                                            คณะ Faculty:  {{$app->faculty_name}} - {{$app->faculty_full }}    ({{   date('d-m-Y', strtotime($app->start_date )) }} - {{ date('d-m-Y', strtotime($app->end_date ))  }} ) Application ID
                                            {{ str_pad($app->app_id, 5, '0', STR_PAD_LEFT) }}             </div></td>
                                </tr>
                            </tbody></table>


                        <br><hr>
                    </td>
                <tr>
                <tr><td> <div id="page1" style="  page-break-before: always; ">&nbsp;</div>  </td>  </tr>
                <tr>
                    <td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        <hr>
                        <div align="center"><b>โปรดตัดออกสำหรับติดหน้าซองใบสมัคร</b></div><br><br><br><br>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                    <td width="380px" align="left">ชื่อผู้สมัคร
                                        {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}</td>
                                    <td width="280px" rowspan="5" align="right">ติดแสตมป์ให้เรียบร้อย</td>
                                </tr>
                                <tr>
                                    <td align="left">เลขที่ {{$applicant->stu_addr_no}}
                                                        หมู่บ้าน  {{$applicant->stu_addr_village}}
                                                        ตรอก/ซอย  {{$applicant->stu_addr_soi }}
                                                        ถนน  {{$applicant->stu_addr_road }} </td>
                                </tr>
                                <tr>
                                    <td align="left">แขวง/ตำบล  {{$applicant->stu_addr_tumbon }},
                                                        เขต/อำเภอ  {{$applicant->district_name }} </td>
                                </tr>
                                <tr>
                                    <td align="left">จังหวัด {{$applicant->province_name}}</td>
                                </tr>
                                <tr>
                                    <td align="left">รหัสไปรษณีย์  {{$applicant->stu_addr_pcode }}</td>
                                </tr>
                                <tr>
                                    <td align="left">&nbsp;</td>
                                    <td align="right">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left"><table width="100%" border="0">
                                            <tbody><tr>
                                                    <td width="200px"><div align="right">กรุณาส่ง</div></td>
                                                    <td width="500px">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td rowspan="5">
                                                      {{$app->mailing_address}}                   </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </tbody></table></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><div align="center">สมัครสาขาวิชา Subject: {{$app->major_name }} ( {{$app->program_id }} )[{{$app->degree_level_name }}] ระดับ Degree: {{$app->degree_name}} - {{$app->degree_name_en}}
                                            <br>
                                            คณะ Faculty:  {{$app->faculty_name}} - {{$app->faculty_full }}    ({{  date('d-m-Y', strtotime($app->start_date))}} - {{ date('d-m-Y', strtotime($app->end_date))}} )          </div></td>
                                </tr>

                            </tbody></table>
                        <br><br>
                        <hr>
                    </td>
                </tr>

            </tbody>
        </table>
      @endforeach
    </body>
</html>

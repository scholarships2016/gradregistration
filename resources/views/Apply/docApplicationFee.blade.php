
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
              @font-face {
                font-family: 'IDAutomationHC39M';
                font-style: normal;
                font-weight: normal;
                src: url("{{ asset('fonts/IDAutomationHC39M.ttf') }}") format('truetype');
            }

            body {
                font-family: "THSarabunNew";
                line-height: 11px;
            }


        </style>
    </head>
    <body >
         @foreach($apps as $app)
        <div align="center"><strong>ใบแจ้งการชำระค่าธรรมเนียมการสมัครระดับบัณฑิตศึกษา จุฬาลงกรณ์มหาวิทยาลัย<br>
                ชำระเงินตามที่ระบุไว้ทุกสาขาทั่วประเทศ ระหว่างวัน {{ Conutil::ConvertDateThai($app->start_date) }} - {{ Conutil::ConvertDateThai($app->end_date) }}  </strong></div>
        <table border="1" cellspacing="0" cellpadding="0" width="700px">
            <tbody><tr>
                    <td width="115"><div align="center"><strong>บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย</strong></div></td>
                    <td width="104"><div align="center"><strong>SERVICE CODE: CHULA </strong></div></td>
                    <td width="200"><div align="center"><strong><font style="font-size: 18px;font-weight: bold;">ส่วนที่ 1 สำหรับบัณฑิตวิทยาลัย</font></strong></div></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table width="100%" border="1">
                            <tbody><tr rowspan="4">
                                    <td width="210" rowspan="4"> <img src="{{asset('images/'.$app->bank_logo)}}" style="width:30px;" border="0"> {{$app->bank_name}}  COMP. CODE {{$app->bank_code }}</td>
                                    <td>วันที่</td>
                                    <td>&nbsp;............................................</td>
                                    <td>สาขาผู้ฝาก</td>
                                    <td>&nbsp;............................................</td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">ชื่อผู้สมัคร {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}
                                        </td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">หมายเลขโทรศัพท์ (Ref. No1)
                                      {{ $applicant->stu_phone}}</td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">รหัสหลักสูตร (Ref. No2) {{$app->program_id}} สาขาวิชา {{$app->major_name }} ({{$app->major_id  }}) {{$app->faculty_name}}</td>
                                </tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table width="100%" border="1">
                            <tbody><tr>
                                    <td width="270"><div align="center"><strong>รับเฉพาะเงินสดเท่านั้น</strong></div></td>
                                    <td width="65"><div align="center"><strong>จำนวนเงิน (บาท)</strong></div></td>
                                    <td width="95"><div align="center"><strong>สำหรับเจ้าหน้าที่ธนาคาร</strong></div></td>
                                </tr>
                                <tr>
                                    <td>ค่าธรรมเนียมการสมัครเข้าศึกษาระดับบัณฑิตศึกษา และค่าธรรมเนียมผ่านธนาคาร </td>
                                    <td><div align="center">
                                        {{number_format($app->apply_fee, 2)}}
                                    </div></td>
                                    <td><p>&nbsp;</p>
                                        <p>&nbsp;</p></td>
                                </tr>
                            </tbody></table>
                    </td>
                </tr>
            </tbody>
        </table><br>
         <p style="margin-top: 5px;" align="center">(ต้องมีลายเซ็นต์ผู้รับเงินและประทับตราธนาคาร จึงถือว่าถูกต้องสมบูรณ์) โปรดตัดออกเป็นส่วนๆ ก่อนนำไปชำระเงิน    <span style="font-family:IDAutomationHC39M;font-size: 12px;padding-left: 40px;" >*{{ str_pad($app->application_id, 10, '0', STR_PAD_LEFT) }}*</span>
        </p><hr>
 <div align="center"><strong>ใบแจ้งการชำระค่าธรรมเนียมการสมัครระดับบัณฑิตศึกษา จุฬาลงกรณ์มหาวิทยาลัย<br>
                ชำระเงินตามที่ระบุไว้ทุกสาขาทั่วประเทศ ระหว่างวัน   {{ Conutil::ConvertDateThai($app->start_date) }} - {{ Conutil::ConvertDateThai($app->end_date) }}  </strong></div>
        <table border="1" cellspacing="0" cellpadding="0" width="700px">
            <tbody><tr>
                    <td width="115"><div align="center"><strong>บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย</strong></div></td>
                    <td width="104"><div align="center"><strong>SERVICE CODE: CHULA </strong></div></td>
                    <td width="200"><div align="center"><strong><font style="font-size: 18px;font-weight: bold;">ส่วนที่ 2 สำหรับผู้สมัคร</font></strong></div></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table width="100%" border="1">
                            <tbody><tr rowspan="4">
                                    <td width="210" rowspan="4"> <img src="{{asset('images/'.$app->bank_logo)}}" style="width:30px;" border="0"> {{$app->bank_name}}  COMP. CODE {{$app->bank_code }}</td>
                                    <td>วันที่</td>
                                    <td>&nbsp;............................................</td>
                                    <td>สาขาผู้ฝาก</td>
                                    <td>&nbsp;............................................</td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">ชื่อผู้สมัคร {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}
                                        </td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">หมายเลขโทรศัพท์ (Ref. No1)
                                      {{ $applicant->stu_phone}}</td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">รหัสหลักสูตร (Ref. No2) {{$app->program_id}} สาขาวิชา {{$app->major_name }} ({{$app->major_id  }}) {{$app->faculty_name}}</td>
                                </tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table width="100%" border="1">
                            <tbody><tr>
                                    <td width="270"><div align="center"><strong>รับเฉพาะเงินสดเท่านั้น</strong></div></td>
                                    <td width="65"><div align="center"><strong>จำนวนเงิน (บาท)</strong></div></td>
                                    <td width="95"><div align="center"><strong>สำหรับเจ้าหน้าที่ธนาคาร</strong></div></td>
                                </tr>
                                <tr>
                                    <td>ค่าธรรมเนียมการสมัครเข้าศึกษาระดับบัณฑิตศึกษา และค่าธรรมเนียมผ่านธนาคาร </td>
                                    <td><div align="center">
                                        {{number_format($app->apply_fee, 2)}}

                                    </div></td>
                                    <td><p>&nbsp;</p>

                                        <p>&nbsp;</p></td>
                                </tr>
                            </tbody></table>
                    </td>
                </tr>
            </tbody></table><br>
          <p style="margin-top: 5px;" align="center">(ต้องมีลายเซ็นต์ผู้รับเงินและประทับตราธนาคาร จึงถือว่าถูกต้องสมบูรณ์) โปรดตัดออกเป็นส่วนๆ ก่อนนำไปชำระเงิน    <span style="font-family:IDAutomationHC39M;font-size: 12px;padding-left: 40px; " >*{{ str_pad($app->application_id, 10, '0', STR_PAD_LEFT) }}*</span>

        </p><hr>
         <div align="center"><strong>ใบแจ้งการชำระค่าธรรมเนียมการสมัครระดับบัณฑิตศึกษา จุฬาลงกรณ์มหาวิทยาลัย<br>
                ชำระเงินตามที่ระบุไว้ทุกสาขาทั่วประเทศ ระหว่างวัน  {{ Conutil::ConvertDateThai($app->start_date) }} - {{ Conutil::ConvertDateThai($app->end_date) }}  </strong></div>
        <table border="1" cellspacing="0" cellpadding="0" width="700px">
            <tbody><tr>
                    <td width="115"><div align="center"><strong>บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย</strong></div></td>
                    <td width="104"><div align="center"><strong>SERVICE CODE: CHULA </strong></div></td>
                    <td width="200"><div align="center" ><font style="font-size: 18px;font-weight: bold;"> ส่วนที่ 3 สำหรับธนาคาร</font> </div></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table width="100%" border="1">
                            <tbody><tr rowspan="4">
                                    <td width="210" rowspan="4"> <img src="{{asset('images/'.$app->bank_logo)}}" style="width:30px;" border="0"> {{$app->bank_name}}  COMP. CODE {{$app->bank_code }}</td>
                                    <td>วันที่</td>
                                    <td>&nbsp;............................................</td>
                                    <td>สาขาผู้ฝาก</td>
                                    <td>&nbsp;............................................</td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">ชื่อผู้สมัคร {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}
                                        </td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">หมายเลขโทรศัพท์ (Ref. No1)
                                      {{ $applicant->stu_phone}}</td>
                                </tr>
                                <tr rowspan="4">
                                    <td colspan="4">รหัสหลักสูตร (Ref. No2) {{$app->program_id}} สาขาวิชา {{$app->major_name }} ({{$app->major_code  }}) {{$app->faculty_name}}</td>
                                </tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table width="100%" border="1">
                            <tbody><tr>
                                    <td width="270"><div align="center"><strong>รับเฉพาะเงินสดเท่านั้น</strong></div></td>
                                    <td width="65"><div align="center"><strong>จำนวนเงิน (บาท)</strong></div></td>
                                    <td width="95"><div align="center"><strong>สำหรับเจ้าหน้าที่ธนาคาร</strong></div></td>
                                </tr>
                                <tr>
                                    <td>ค่าธรรมเนียมการสมัครเข้าศึกษาระดับบัณฑิตศึกษา และค่าธรรมเนียมผ่านธนาคาร </td>
                                    <td><div align="center">
                                        {{number_format($app->apply_fee, 2)}}
                                    </div></td>
                                    <td><p>&nbsp;</p>

                                        <p>&nbsp;</p></td>
                                </tr>
                            </tbody></table>
                    </td>
                </tr>
            </tbody></table><br>
        <p align="center">(ต้องมีลายเซ็นต์ผู้รับเงินและประทับตราธนาคาร จึงถือว่าถูกต้องสมบูรณ์) โปรดตัดออกเป็นส่วนๆ ก่อนนำไปชำระเงิน
        </p><hr>

        @endforeach
    </body>
</html>

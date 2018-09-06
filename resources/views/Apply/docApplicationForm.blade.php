
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
    <body>
        <table style="width:700px;" border="0">
            <tr>
                <td  valign="top" align="center">
                    <div style="widht:100%;">
                        <table style="widht:700px" border="0" cellpadding="0" cellspacing="1">
                            @foreach($apps as $app)
                            <tbody>
                                <tr border="1px">
                                    <td style="width:140px" border="1px" valign="top"   align="center">สำหรับเจ้าหน้าที่<br>For staff only<br>
                                        เลขประจำตัวผู้สมัคร<br>Application No.<br>
                                        {{$app->program_id }}-{{str_pad($app->curriculum_num, 4, '0', STR_PAD_LEFT)}}<br>
                                        {{$app->degree_level_name}}
                                        <hr>
                                        <div align="center">ใบสมัครเลขที่<br>Application ID<br>
                                            {{ str_pad($app->app_id, 5, '0', STR_PAD_LEFT) }}            </div></td>
                                    <td style="width:410px;"align="center"   >
                                        <div align="center">
                                            <img src="{{asset('images/bwpk.jpg')}}" border="0">

                                            <br>บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย
                                            <br>Graduate School, Chulalongkorn University
                                            <br>ใบสมัครเข้าศึกษาในระดับบัณฑิตศึกษา
                                            <br>Application Form
                                            <br>ประจำภาค[Term]:
                                            {{($app->semester == 1)?'ต้น [First]':'ปลาย [Second]'}}
                                            <br> ปีการศึกษา[Year]:{{$app->academic_year}}
                                        </div></td>

                                    <td style="widht:150px"   align="center"> <img src="{{$pictrue}}"  style="width:120px;" border="0"></td>
                                </tr>

                            </tbody>
                        </table>


                        <table style="width:700px" border="0" cellpadding="0" cellspacing="1">
                            <tbody><tr>
                                    <td>สมัครสาขาวิชา[Field of Study]:
                                        {{$app->major_name}} - {{$app->major_name_en}}</td>
                                </tr>
                                <tr>
                                    <td>หลักสูตร [Degree ]:
                                        {{$app->degree_name}} - {{$app->degree_name_en}} </td>
                                </tr>
                                <tr>
                                    <td>รหัสหลักสูตร[Program ID]:
                                        {{$app->program_id}}</td>
                                </tr>
                                <tr>
                                    <td>ภาควิชา [ Department ]:
                                        {{$app->department_name }} - {{$app->department_name_en }} </td>
                                </tr>
                                <tr>
                                    <td>คณะ [ Faculty ]:
                                        {{$app->faculty_name}} - {{$app->faculty_full }}</td>
                                </tr>
                            </tbody></table>
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
        <table width="700px" border="1" cellpadding="1" cellspacing="1">
            <tbody><tr valign="middle">
                    <td width="191px">ชื่อ - นามสกุล [Name- Surname]</td>
                    <td colspan="4">
                        {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}[ {{$applicant->name_title_en.' '. $applicant->stu_first_name_en. ' '.$applicant->stu_last_name_en }}] เพศ[Sex]:
                        {{($applicant->stu_sex=='1')?'ชาย':'หญิง'}} [{{($applicant->stu_sex=='1')?'Male':'FeMale'}}]</td>
                </tr>
                <tr>
                    <td rowspan="2">หมายเลขบัตรประชาชน/พาสปอร์ต <br>[ Citizen ID / Passport ID]
                        <br>{{$applicant->stu_citizen_card}}</td>
                    <td width="400px" colspan="4"   >วัน/เดือน/ปีเกิด [ Date of Birth]
                        {{$applicant->stu_birthdate->format('d-m-Y') }}  อายุ [Age]
                        {{ $age }}    </td>
                </tr>
                <tr>
                    <td colspan="4">สถานที่เกิด (จังหวัด) [Place of Birth(Province)]
                        {{ $applicant->stu_birthplace }}      ภูมิลำเนาปัจจุบัน[Current Address]
                        {{$applicant->stu_birthplace}}</td>
                </tr>
                <tr>
                    <td>สัญชาติ [ Nationality]
                        ไทย - Thai</td>
                    <td colspan="4">ศาสนา [Religion]
                        {{$applicant->religion_name}} - {{$applicant->religion_name_en }}    สถานภาพ [Marital Status ]
                        {{$applicant->stu_married}}</td>
                </tr>
                <tr valign="top">
                    <td>สถานที่ติดต่อ[ Address]:</td>
                    <td colspan="4">
                        {{$applicant->stu_addr_no}}
                        หมู่บ้าน[Village]:{{$applicant->stu_addr_village}} ,
                        ตรอก/ซอย[alley]:{{$applicant->stu_addr_soi }} ,
                        ถนน[Road]:{{$applicant->stu_addr_road }} ,
                        แขวง/ตำบล [Sub-District]:{{$applicant->stu_addr_tumbon }},
                        เขต/อำเภอ [District]: {{$applicant->district_name }} ,
                        จังหวัด [Province]:{{$applicant->province_name}},
                        รหัสไปรษณีย์[Zip Code]:{{$applicant->stu_addr_pcode }}
                        โทรศัพท์[Telephone No]:{{$applicant->stu_phone }}  &nbsp;, {{$applicant->stu_phone2 }}
                        อีเมล[E-mail]: {{$applicant->stu_email }}</td>
                </tr>
                <tr valign="bottom">

                    <td colspan="5">ชำระเงินผ่านธนาคาร[Pay the registration fee by Bank name ]: <img src="{{asset('images/'.$app->bank_logo)}}" style="width:15px;" border="0"> {{$app->bank_name}}[Total]:
                        {{$app->bank_fee }}บาท [Baht]</td>

                </tr>

                <tr>
                    <td colspan="5"><table width="100%" border="1px" cellspacing="1" cellpadding="0">
                            <tbody><tr>
                                    <td colspan="7">ประวัติการศึกษา[Educational Background]</td>
                                </tr>
                                <tr>
                                    <td bgcolor="EEEEEE" align="center">ระดับ<br>[Degree]</td>
                                    <td bgcolor="EEEEEE" align="center">มหาวิทยาลัย/สถาบันอุดมศึกษา<br>[Institution]</td>
                                    <td bgcolor="EEEEEE" align="center">ปีที่สำเร็จ<br>[Year of Graduation]</td>
                                    <td bgcolor="EEEEEE" align="center">แต้มเฉลี่ย<br>[GPAX]</td>
                                    <td bgcolor="EEEEEE" align="center">สาขาวิชาเอก<br>
                                        <span class="style1">[Field of Study]</span></td>
                                    <td bgcolor="EEEEEE" align="center">ประกาศนียบัตร/ปริญญาบัตร<br>
                                        [Diploma/Degree]</td>
                                    <td bgcolor="EEEEEE" align="center">หมายเหตุ<br>[Remark]</td>
                                </tr>
                                @foreach ($appEdus as $appEdu)
                                <tr>
                                    <td> {{$appEdu->degree_level_name}} - {{$appEdu->degree_level_name_en}} </td>
                                    <td>
                                        {{$appEdu->university_name}} </td>
                                    <td>
                                        {{$appEdu->edu_year}}</td>
                                    <td>
                                        {{$appEdu->edu_gpax}}
                                    </td>
                                    <td>
                                        {{$appEdu->edu_degree}}
                                    </td>
                                    <td>
                                        {{$appEdu->edu_faculty }}
                                    </td>
                                    <td>
                                        -</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table></td>
                </tr>

            </tbody>
        </table>
        <table width="700px" border="0" cellpadding="0" cellspacing="1">
            <tbody>
                <tr>
                    <td colspan="2"><strong>การทดสอบความรู้ความสามารถ[Compentency ]</strong></td>

                </tr>
                <tr>
                    <td colspan="2">ภาษาอังกฤษ&nbsp; CU-TEP  {{$applicant->eng_test_score}} คะแนน [Score] </td>
                </tr>
                <tr>
                    <td width="225">ภาษาไทย {{$applicant->thai_test_score }} คะแนน [Score] </td>
                    <td width="222">ความถนัดทางธุรกิจ [CU BEST]  {{$applicant->cu_best_score}} คะแนน [Score] </td>
                </tr>
            </tbody>
        </table>
        <table width="700px" border="0" cellpadding="0" cellspacing="1">
            <tbody>
                <tr>
                    <td><strong>ประสบการณ์การทำงาน Work Experience </strong>
                    </td>
                </tr>
                @if($appapplicantWorks->count()  > 0)
                @foreach ($appapplicantWorks as $appapplicantWork)
                <tr>
                    <td> ({{$loop->iteration}})   {{ $appapplicantWork->work_status_name . ' - ' .  $appapplicantWork->work_status_name_en}}<br>
                                               @if($appapplicantWork->work_status_id > 1)
                                                ตำแหน่ง/หน้าที่[Position] {{$appapplicantWork->work_stu_position}} สถานที่ทำงาน[Work place] {{$appapplicantWork->work_stu_detail}}   เบอร์โทรศัพท์[Telephone No]{{$appapplicantWork->work_stu_phone}}
                                                 <br>ระยะเวลาในการทำงาน[Period of Time Working] {{$appapplicantWork->work_stu_yr}} ปี[Year] {{$appapplicantWork->work_stu_mth}} เดือน[Month] เงินเดือนที่ได้รับ {{$appapplicantWork->work_stu_salary}} บาท[Baht]
                                                @endif
                    </td>
                </tr>
                @endforeach

                @endif
                <tr>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td align="center">สำหรับผู้ศึกษาระดับปริญญาเอกและที่ภาควิชาต้องการหนังสือรับรองคุณสมบัติฯ ให้ระบุชื่อและที่อยู่ของผู้รับรองทั้งหมด <br> Please specify referrences:</td>
                </tr>
                <tr>
                    <td><table width="100%" border="1" cellspacing="1" cellpadding="0">
                            <tbody><tr>
                                    <td bgcolor="EEEEEE" align="center">ลำดับ[No.]</td>
                                    <td bgcolor="EEEEEE" align="center">ชื่อ-นามสกุล[Name-Surname]</td>
                                    <td bgcolor="EEEEEE" align="center">สถานที่ติดต่อ/โทรศัพท์ [ Contact Address and Phone No. ]</td>
                                    <td bgcolor="EEEEEE" align="center">ตำแหน่ง [Position]</td>
                                </tr>
                                @foreach ($peoples as $people)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td> {{$people->app_people_name}} </td>
                                    <td>{{$people->app_people_address}}  Tel: {{$people->app_people_phone}}</td>
                                    <td>{{$people->app_people_position}}</td>
                                </tr>
                                @endforeach
                            </tbody></table></td>
                </tr>
                <tr>
                    <td align="center">ข้าพเจ้าขอรับรองว่า ข้อความที่กรอกในใบสมัครข้างต้นเป็นความจริงทุกประการ<br>
                        I certify that the information given is complete and accurate.</td>
                </tr>

                <tr>
                    <td  style="float: right" > <div width="700px" style="float: right">
                            <br>  <table border="0" cellspacing="0" cellpadding="0" style="width:480px;">
                                <tbody>
                                    <tr valign="top">
                                        <td rowspan="3">ลงชื่อผู้สมัคร<br>[Applicant's signature]</td>
                                        <td align="center">.............................................................................</td>
                                    </tr>

                                    <tr>
                                        <td align="center">( {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}[ {{$applicant->name_title_en.' '. $applicant->stu_first_name_en. ' '.$applicant->stu_last_name_en }}])</td>
                                    </tr>
                                    <tr>
                                        <td align="center">วันที่ Date................. เดือน Month................................... พ.ศ.Year.................</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div id="page1" style="  page-break-before: always; ">&nbsp;</div>

        <table width="700px">  <tr>
                <td colspan="2" align="center">
                    <strong>  ให้ Upload หลักฐานและเอกสารประกอบการสมัครต่อไปนี้<br>[Upload all documents below]</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <!--ให้ผู้สมัครทำเครื่องหมาย / หน้าข้อความหลักฐานและเอกสารที่สมัคร ตามลำดับดังนี้<br>[Please check / in front of document sent to us] --></td>
            </tr></table>
        <table width="700px" border="1" cellspacing="1" cellpadding="1">

            <tbody>

                @foreach ($Groups as $Group)
                <tr>
                    <td  style="width: 25px" align="center"><span >{{$loop->iteration}}.</span></td>
                    <td width="550px" align="left"><span  >{{$Group->doc_apply_group.'  '.  $Group->doc_apply_group_en}} &nbsp;</span></td>
                </tr>
               @foreach ($Docs as $Doc)
                                                 @if(($Doc->doc_apply_id == 9 && $apps[0]->apply_method > 1 ) || ($Doc->doc_apply_id == 9 && $apps[0]->apply_method == 1 && $applicant->nation_id != 1) )
                                                 
                                                 @else
                                                  @if($Group->doc_apply_group == $Doc->doc_apply_group   )
                                                <tr>
                                                    <td align="center"><span class="style1">
                                                           <input class="md-check"   type="checkbox"
                                                            {{$val=false}}
                                                           @foreach($Files as $file)
                                                              @if($Doc->doc_apply_id == $file->doc_apply_id ||$Doc->doc_apply_id ==1 )
                                                              {{$val=true}}
                                                               @break
                                                              @endif
                                                            @endforeach
                                                           {{ ($val)? 'checked="checked"':''}}
                                                             disabled="disabled"    >
                                                        </span></td>
                                                    <td width="94%" align="left"><span class="style1"><label for="checkbox{{$Doc->doc_apply_id}}">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> <label> {{ $Doc->doc_apply_detail}} @if( $Doc->doc_apply_id == 9)     @foreach($apps as $app) :  {{$app->bank_name}}     @endforeach   @endif  <br>{{ $Doc->doc_apply_detail_en}}  </label>
                                                        @if( $Doc->doc_apply_id == 16)
                                                        <span style="border-bottom: 1px dotted;">
                                                          @foreach($Files as $file)
                                                           {{($Doc->doc_apply_id == $file->doc_apply_id)? ' :           '. $file->other_val .'' :' '}}
                                                           @endforeach
                                                      </span>
                                                        @endif
                                                             </span></td>
                                                </tr>
                                                @endif
                                                @endif
                                                 @endforeach
                                              @endforeach
                <tr>
                    <td colspan="2">
                        <p align="center"  >
                            รวมที่ส่งมาทั้งสิ้น[Total] ..........{{$Files->count()}}......... รายการ [Items]
                        </p>
                        <p align="center">รายการที่เป็นเอกสารถ่ายสำเนา ให้ผู้สมัครลงนามรับรองสำเนาเอกสารด้วยตนเองทุกฉบับ<br>ข้าพเจ้าขอรับรองว่า หลักฐานและเอกสารต่างๆ ที่นำมาประกอบการสมัครข้างต้นเป็นเอกสารที่ถูกต้อง<br>All copy documents must have applicant's signature. I certify that the information given is complete and accurate. </p>     </td>
                </tr>

            </tbody>
        </table><br>
        <table width="700px">
            <tr>
                <td  style="float: right" >
                    <div width="700px" style="float: right">
                        <br>
                        <table border="0" cellspacing="0" cellpadding="0" style="width:480px;">
                            <tbody>
                                <tr valign="top">
                                    <td rowspan="3">ลงชื่อผู้สมัคร<br>[Applicant's signature]</td>
                                    <td align="center">.............................................................................</td>
                                </tr>

                                <tr>
                                    <td align="center">( {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}[ {{$applicant->name_title_en.' '. $applicant->stu_first_name_en. ' '.$applicant->stu_last_name_en }}])</td>
                                </tr>
                                <tr>
                                    <td align="center">วันที่ Date................. เดือน Month................................... พ.ศ.Year.................</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <table widht="700px">
            <tr>
                <td align="center">
                    <span >
                        <strong>คณะ [Faculty]
                            {{$app->faculty_name}} - {{$app->faculty_full }}
                            สมัครสาขาวิชา[Field of Study] {{$app->major_name }} - {{$app->major_name_en }}                         (
                            [Program ID]  {{$app->program_id}}                        )
                            ระดับ[Degree]
                            <strong>
                                {{$app->degree_name}} - {{$app->degree_name_en}}
                            </strong>

                        </strong>
                    </span>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <span><strong>คำเตือน Warning</strong></span></td>
            </tr>
            <tr>
                <td align="center">
                    <span>
                        <b>*** ใบสมัคร 1 ชุด สมัครได้ 1 สาขาวิชา[Field of Study] ***1 Application Form for 1 Subject *** </b>
                    </span>
                </td>
            </tr>
            <tr>
                <td align="center"><span>
                        เมื่อบัณฑิตวิทยาลัยได้รับใบสมัครแล้ว ผู้สมัครจะขอเปลี่ยนสาขาวิชาที่สมัครในภายหลังอีกไม่ได้<br>
                        [Applicant could not change subject after Graduate School received application form already ]
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                        <tbody><tr valign="top">
                                <td width="10%" class="style2"><strong>หมายเหตุ<br>[Remark]:</strong></td>
                                <td width="90%" class="style2">หากบัณฑิตวิทยาลัยได้ตรวจสอบพบภายหลังว่า ข้อความที่ได้แจ้งไว้ในใบสมัคร หรือหลักฐานเอกสารต่างๆ ของผู้สมัครไม่ถูกต้องตามความเป็นจริง หรือเป็นเอกสารปลอม บัณฑิตวิทยาลัยจะดำเนินการตามกฎหมาย และให้พ้นสภาพนิสิต หากรับผู้สมัครเป็นนิสิตแล้ว<br>The admission committee may certify any and all parts of application material. </td>
                            </tr>
                        </tbody>
                    </table>            </td>
            </tr>
        </table>

    </body>
</html>

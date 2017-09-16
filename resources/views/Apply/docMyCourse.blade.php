@extends('layouts.defaultNoMenu')

@push('pageCss')

<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css">

<style type="text/css">
    page[size="A4"] {
        background: white;
        width: 21cm;
        height: 29.7cm;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.2cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    @media print {
        body, page[size="A4"] {
            margin: 0;
            box-shadow: 0;
        }
    }
</style>
@endpush

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="/">{{Lang::get('resource.lbMHome')}}</a>
            <i class="fa fa-circle"></i>
        </li>

        <li>
            <span>{{Lang::get('resource.lbManageCouse')}}</span>
              <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{Lang::get('resource.lbdocMyCourse')}}</span>

        </li>
    </ul>
    {{--<div class="page-tool    bar">--}}
    {{--<div class="btn-group pull-right">--}}
    {{--<butto    n type="button" class="btn green btn-sm btn-outline dropdown-toggle"--}}
    {{--data-toggl    e="dropdown"> Actions--}}
    {{--<i class="fa f    a-angle-down"></i>--}}
    {{--</butt    on>-    -}}
    {{--<ul clas    s="dropdown-menu pull-right" role=    "menu">-    -}}
    {{--<li>--}}
        {{--<    a href="#">-    -}}
        {{--<i cl    ass="icon-bell"></i> Action</    a>--}}
                {{--                                                                  </li>--}}
                            {{--                <li>--}}
                                            {{--<a href="#">--}}
        {{--<i class="icon-shield"></i> Another action</a>--}}
                {{--</li>-                        -}}
                {{--<li>--}}
                {{--<a hr                        ef="#">--}}
                    {{--<i class="ico                n-user"></i> Something else h                ere</a>--}}
                {{--</li>--}}
                    {{--                <li class="divider"></li>--}}
                            {{--<li>--}}
                {{--                <a href="#">--}}
                {{--<i class="icon-bag"></i> Sepa                rated link</a>--}}
        {{--</li>--}}
                {{--</ul>--}                }
{{--</di        v>--}}
                    {{--</div>--}}
                    </div>
                    @stop
                    @section('maincontent')
                    <div class="invoice-content-2">
    <div class="row">
        <div class="col-xs-12">
<!--            <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Print</a>-->

            <a class="btn btn-lg green-haze hidden-print uppercase print-btn" href="{{url('apply/docMyCourserintPDF/'.$id)}}" target="_blank"  >Download PDF</a>



        </div>
    </div>
<table width="800" border="0"  cellpadding="0" cellspacing="0" bgcolor="#ffffff" align="center" height="100%" >
        <tbody>
            <tr>
                <td valign="top" align="center">
                    <div width="750">
                        <table width="856" border="0" cellpadding="0" cellspacing="1">
                            @foreach($apps as $app)
                            <tbody>
                                <tr>
                                    <td width="226" rowspan="4" align="center">สำหรับเจ้าหน้าที่<br>For staff only<br>
                                        เลขประจำตัวผู้สมัคร<br>Application No.<br>
                                        {{$app->program_id }}-{{str_pad($app->curriculum_num, 4, '0', STR_PAD_LEFT)}}<br>
                                        {{$app->degree_level_name}}
                                        <hr>
                                        <div align="center">ใบสมัครเลขที่<br>Application ID<br>
                                            {{ str_pad($app->app_id, 5, '0', STR_PAD_LEFT) }}            </div></td>
                                    <td width="441" height="158"><div align="center"><img src="{{asset('images/bwpk.gif')}}" border="0"><br>บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย<br>Graduate School, Chulalongkorn University <br>ใบสมัครเข้าศึกษาในระดับบัณฑิตศึกษา<br>Application Form<br>
                                            &nbsp;&nbsp;<br>
                                        </div></td>
                                    <td width="278" rowspan="4" align="center"><img src="{{$pictrue}}" width="180px" border="0"></td>
                                </tr>
                                <tr>
                                    <td><div align="center">ประจำภาค[Term]:
                                            {{($app->semester == 1)?'ต้น [First]':'ปลาย [Second]'}}             </div></td>
                                </tr>
                                <tr>
                                    <td><div align="center">ปีการศึกษา[Year]:{{$app->academic_year}}            </div></td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody></table>
                            <br/>

                        <table width="856" border="0" cellpadding="0" cellspacing="1">
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
                        <br>
                        @endforeach


                        <table width="800" border="1" cellpadding="1" cellspacing="1">
                            <tbody><tr valign="middle">
                                    <td width="191">ชื่อ - นามสกุล [Name- Surname]</td>
                                    <td colspan="3">
                                        {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}[ {{$applicant->name_title_en.' '. $applicant->stu_first_name_en. ' '.$applicant->stu_last_name_en }}]  เพศ[Sex]:
                                        {{($applicant->stu_sex=='1')?'ชาย':'หญิง'}} [{{($applicant->stu_sex=='1')?'Male':'FeMale'}}]</td>
                                </tr>
                                <tr>
                                    <td colspan="2" rowspan="2">หมายเลขบัตรประชาชน/พาสปอร์ต <br>[ Citizen ID / Passport ID]
                                        <br>{{$applicant->stu_citizen_card}}</td>
                                    <td width="618" colspan="2">วัน/เดือน/ปีเกิด [ Date of Birth]
                                        {{$applicant->stu_birthdate->format('d-m-Y') }}   อายุ [Age]
                                       {{ $age }}   </td>
                                </tr>
                                <tr>
                                    <td colspan="3">สถานที่เกิด (จังหวัด) [Place of Birth(Province)]
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
                                        @foreach($apps as $app)
                                    <td colspan="5">ชำระเงินผ่านธนาคาร[Pay the registration fee by Bank name ]: <img src="{{asset('images/'.$app->bank_logo)}}" border="0"> {{$app->bank_name}}[Total]:
                                        {{$app->bank_fee }}บาท [Baht]</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="5"><table width="100%" border="1" cellspacing="1" cellpadding="0">
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
                                                    <td> {{$appEdu->grad_level}} </td>
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
                                            </tbody></table></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><strong>
                                        </strong> <strong>
                                        </strong> </td>
                                </tr>
                            </tbody></table>
                        <table width="800" border="0" cellpadding="0" cellspacing="1">
                            <tbody><tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>การทดสอบความรู้ความสามารถ[Compentency ]</strong></td>

                                </tr>
                                <tr>
                                    <td colspan="2">ภาษาอังกฤษ&nbsp; CU-TEP  {{$applicant->eng_test_score}} คะแนน [Score] </td>
                                </tr>
                                <tr>
                                    <td width="365">ภาษาไทย {{$applicant->thai_test_score }} คะแนน [Score] </td>
                                    <td width="432">ความถนัดทางธุรกิจ [CU BEST]  {{$applicant->cu_best_score}} คะแนน [Score] </td>
                                </tr>
                            </tbody></table>
                        <table width="800" border="0" cellpadding="0" cellspacing="1">
                            <tbody><tr>
                                    <td width="573" colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="221"></td>
                                </tr>
                            </tbody></table>
                        <table width="800" border="0" cellpadding="0" cellspacing="1">
                            <tbody><tr>
                                    <td><strong>ประสบการณ์การทำงาน Work Experience </strong>
                                          </td>
                                </tr>
                                @if($appapplicantWorks->count()  > 0)
                               @foreach ($appapplicantWorks as $appapplicantWork)
                                <tr>
                                    <td> ({{$loop->iteration}}) {{$appapplicantWork->work_stu_detail}} {{$appapplicantWork->work_stu_position}}  {{$appapplicantWork->work_stu_yr}}  {{$appapplicantWork->work_stu_mth}}  {{$appapplicantWork->work_status_name}}        </td>
                                </tr>
                               @endforeach
                               @else
                               <tr><td> ไม่ได้ทำงาน - Not working</td></tr>
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
                                                    <td>{{$people->app_people_address}}  <br> Tel: {{$people->app_people_phone}}</td>
                                                    <td>{{$people->app_people_position}}</td>
                                                </tr>
                                              @endforeach
                                            </tbody></table></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                      <br/>ข้าพเจ้าขอรับรองว่า ข้อความที่กรอกในใบสมัครข้างต้นเป็นความจริงทุกประการ<br>
                                        I certify that the information given is complete and accurate.</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tbody><tr valign="top">
                                                    <td rowspan="2">ลงชื่อผู้สมัคร<br>[Applicant's signature]</td>
                                                    <td>............................................................................</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">( {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}[ {{$applicant->name_title_en.' '. $applicant->stu_first_name_en. ' '.$applicant->stu_last_name_en }}])</td>
                                                </tr>
                                            </tbody></table>      </td>
                                </tr>
                                <tr>
                                    <td align="right">วันที่ Date................. เดือน Month................................... พ.ศ.Year.................</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="page1" style=" display: block; page-break-before: auto;">&nbsp;</div>

                                        <table width="100%" border="1" cellspacing="1" cellpadding="1">
                                            <tbody><tr>
                                                    <td colspan="2" align="center"><strong> ให้นำหลักฐานและเอกสารประกอบการสมัครต่อไปนี้ส่งพร้อมใบสมัครทางไปรษณีย์<br>[Send all documents below]</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" align="center">ให้ผู้สมัครทำเครื่องหมาย / หน้าข้อความหลักฐานและเอกสารที่สมัคร ตามลำดับดังนี้<br>[Please check / in front of document sent to us]</td>
                                                </tr>
                                                   @foreach ($Groups as $Group)
                                                <tr>
                                                    <td width="6%" align="center"><span class="style1">{{$loop->iteration}}.</span></td>
                                                    <td align="left"><span class="style1">{{$Group->doc_apply_group.'  '.  $Group->doc_apply_group_en}} &nbsp;</span></td>
                                                </tr>
                                                 @foreach ($Docs as $Doc)
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
                                                        <span class="box"></span> <label> {{ $Doc->doc_apply_detail}}<br>{{ $Doc->doc_apply_detail_en}}  </label>
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
                                                 @endforeach
                                              @endforeach
                                                <tr>
                                                    <td colspan="2"><p>&nbsp;</p>
                                                        <p align="center" class="style1">
                                                            รวมที่ส่งมาทั้งสิ้น[Total] ..........{{$Files->count()}}......... รายการ [Items]
                                                        </p><p align="center" class="style1">รายการที่เป็นเอกสารถ่ายสำเนา ให้ผู้สมัครลงนามรับรองสำเนาเอกสารด้วยตนเองทุกฉบับ<br>ข้าพเจ้าขอรับรองว่า หลักฐานและเอกสารต่างๆ ที่นำมาประกอบการสมัครข้างต้นเป็นเอกสารที่ถูกต้อง<br>All copy documents must have applicant's signature. I certify that the information given is complete and accurate. </p>     </td>
                                                </tr>
                                            </tbody></table></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tbody><tr valign="top">
                                                    <td rowspan="2" class="style2">ลงชื่อผู้สมัคร<br>Applicant's signature</td>
                                                    <td>............................................................................</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">( {{ $applicant->name_titles .' '. $applicant->stu_first_name. ' '.$applicant->stu_last_name  }}[ {{$applicant->name_title_en.' '. $applicant->stu_first_name_en. ' '.$applicant->stu_last_name_en }}])</td>
                                                </tr>
                                            </tbody></table>  </td>
                                </tr>
                                <tr>
                                    <td align="right"><span class="style2">วันที่ Date................. เดือน Month................................... พ.ศ.Year.................</span></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center"><span class="style2"><strong>คณะ [Faculty]
                                                {{$app->faculty_name}} - {{$app->faculty_full }}
                                                สมัครสาขาวิชา[Field of Study] {{$app->major_name}} - {{$app->major_name_en}}                         (
                                                [Program ID]  {{$app->program_id}}                        )
                                                ระดับ[Degree]<strong>
                                                     {{$app->degree_name}} - {{$app->degree_name_en}}                   </strong></strong></span></td>
                                </tr>
                                <tr>
                                    <td align="center"><span class="style2"><strong>คำเตือน Warning</strong></span></td>
                                </tr>
                                <tr>
                                    <td align="center"><span class="style2"><b>*** ใบสมัคร 1 ชุด สมัครได้ 1 สาขาวิชา[Field of Study] ***1 Application Form for 1 Subject *** </b></span></td>
                                </tr>
                                <tr>
                                    <td align="center"><span class="style2">เมื่อบัณฑิตวิทยาลัยได้รับใบสมัครแล้ว ผู้สมัครจะขอเปลี่ยนสาขาวิชาที่สมัครในภายหลังอีกไม่ได้<br>
                                            [Applicant could not change subject after Graduate School received application form already ]</span></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
                                            <tbody><tr valign="top">
                                                    <td width="10%" class="style2"><strong>หมายเหตุ<br>[Remark]:</strong></td>
                                                    <td width="90%" class="style2">หากบัณฑิตวิทยาลัยได้ตรวจสอบพบภายหลังว่า ข้อความที่ได้แจ้งไว้ในใบสมัคร หรือหลักฐานเอกสารต่างๆ ของผู้สมัครไม่ถูกต้องตามความเป็นจริง หรือเป็นเอกสารปลอม บัณฑิตวิทยาลัยจะดำเนินการตามกฎหมาย และให้พ้นสภาพนิสิต หากรับผู้สมัครเป็นนิสิตแล้ว<br>The admission committee may certify any and all parts of application material. </td>
                                                </tr>
                                            </tbody></table>            </td>
                                </tr>
                            </tbody></table>

                    </div>
                </td></tr>

        </tbody>
    </table>


</div>
@stop


@push('pageJs')
<script src="{{asset('/assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('script/profileRepeatForm.js')}}" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>



<script type="application/javascript">

</script>
@endpush

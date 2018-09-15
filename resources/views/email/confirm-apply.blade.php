<div id="wrapper" style="text-align: left;min-height: 400px">
    <div id="yourdiv" style="display: inline-block;">

      Dear {{$stu_name}} ({{$stu_name_en}}),
      <br/><br/>
      ท่านได้ยืนยันการสมัครเรียบร้อยแล้ว ในหลักสูตร {{$coursecodeno}} {{$thai}} {{($sub_major_id!=""?"แขนงวิชา ".$sub_major_name."[".$sub_major_id."]":"")}}
        สาขาวิชา{{$major_name}}[{{$major_id}}]
          ภาควิชา {{$department_name}} [{{$department_id}}]  คณะ{{$faculty_name}}[{{$faculty_id}}]
      <br/>
       ประจำภาคการศึกษาที่ {{$semester}} ปีการศึกษา {{$year}}

<br/>
<br/>โปรดดำเนินการ Upload เอกสารประกอบการสมัครในระบบ
<br/>และ หลักฐานการชำระเงินจากธนาคาร (ในกรณีมีค่าธรรมเนียมการสมัคร)
<br/>

<hr/>

<br/>
You have already confirmed for applying to  {{$english}}[{{$coursecodeno}}] program, {{($sub_major_id!=""?"Sub-Major in ".$sub_major_name_en."[".$sub_major_id."],":"")}}
Major in {{$major_name_en}}[{{$major_id}}],
{{$department_name_en}}[{{$department_id}}],
{{$faculty_name_en}}[{{$faculty_id}}]
<br/>
 Semester No. {{$semester}}, Academic Year {{$year}}
<br/></br>
Please upload your related documents and the copy of bank receipt (in case there is an application fee)



<br/><br/>
#########################<br/>
For more information and tracking your application status, please login to registration website https://www.register.gradchula.com or contact program officer Tel. 02-2186880

  <br/><br/>
.:: Graduate Registration System, Graduate School, Chulalongkorn University ::.
    </div>
</div>

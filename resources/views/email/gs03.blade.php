<div id="wrapper" style="text-align: left;min-height: 400px">
    <div id="yourdiv" style="display: inline-block;">

Dear {{$stu_name}} ({{$stu_name_en}}),
<br/><br/>
ตามที่ท่านได้สมัครเข้าศึกษาใน หลักสูตร {{$coursecodeno}} {{$thai}} {{($sub_major_id!=""?"แขนงวิชา ".$sub_major_name."[".$sub_major_id."]":"")}}
  สาขาวิชา{{$major_name}}[{{$major_id}}]
    ภาควิชา {{$department_name}} [{{$department_id}}]  คณะ{{$faculty_name}}[{{$faculty_id}}]
<br/>
 ประจำภาคการศึกษาที่ {{$semester}} ปีการศึกษา {{$year}}
<br/><br/>
  บัณฑิตวิทยาลัย ได้พิจารณาสิทธิ์การเข้าสอบของท่านแล้ว ผลพิจารณาคือ ท่าน <b>{{$statusExam}}</b>

  <br/>
  <hr/>
  <br/>
As you register for {{$english}}[{{$coursecodeno}}], {{($sub_major_id!=""?"Sub-Major in ".$sub_major_name_en."[".$sub_major_id."],":"")}}
Major in {{$major_name_en}}[{{$major_id}}],
{{$department_name_en}}[{{$department_id}}],
{{$faculty_name_en}}[{{$faculty_id}}]
<br/>
 Semester No. {{$semester}}, Academic Year {{$year}}
<br/></br>
Your application result is <b>{{$statusExam_en}}</b>

<br/><br/>
#########################<br/>
For more information and tracking your application status, please login to registration website https://www.register.gradchula.com or contact program officer Tel. 02-2186880

<br/><br/>
.:: Graduate Registration System, Graduate School, Chulalongkorn University ::.
    </div>
</div>

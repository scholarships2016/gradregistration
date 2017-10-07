<div id="wrapper" style="text-align: left;min-height: 400px">
    <div id="yourdiv" style="display: inline-block;">

Dear {{$stu_name}},
<br/><br/>
ตามที่ท่านได้สมัครเข้าศึกษาใน หลักสูตร {{$coursecodeno}} {{$thai}} {{($sub_major_id!=""?"แขนงวิชา ".$sub_major_name."[".$sub_major_id."]":"")}}  สาขาวิชา{{$major_name}}[{{$major_id}}]  ภาควิชา {{$department_name}} [{{$department_id}}]  {{$faculty_name}}
<br/>
 ประจำภาคการศึกษา {{$semester}} ปีการศึกษา {{$year}}
<br/><br/>
  บัณฑิตวิทยาลัย ได้พิจารณาสิทธิ์การเข้าสอบของท่านแล้ว ผลการพิจารณาคือ ท่าน <b>{{$statusExam}}</b>

<br/><br/>
As you register for {{$english}}, {{($sub_major_id!=""?"Sub-Major in ".$sub_major_name."[".$sub_major_id."],":"")}},
Marjor in {{$major_name}}[{{$major_id}}],
{{$department_name}}[{{$department_id}}],
{{$faculty_name}}[{{$faculty_id}}]

<br/></br>
Graduate School has been already consider the result and your application result is <b>{{$statusExam}}</b>

<br/><br/>
For more information, please login to registration website http://161.200.133.96 or contact program officer Tel. 02-2186880


.:: Graduate Student Online Registration System ::.
    </div>
</div>

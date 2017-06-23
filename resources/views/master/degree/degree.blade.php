<html>
    <head>
        <title>title</title>
    </head>
    <body>
  
        <div >
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/degree/') }}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                <input type="text" class="form-control" name="txtSearhc">
                   <button type="submit" >
                      ค้นหา
                    </button>
            </form>
            <br><a href="{{url('/degree/degree_form')}}" class="btn btn-success"> New Degree </a>
            <table>
                <thead>
                    <tr>
                        <td>รหัสปริญญา/Degree_id</td>
                        <td>ชื่อปริญญาภาษาไทย /Degree_name(Thai)</td>
                        <td>ชื่อปริญญาภาษาอังกฤษ/Degree_name(English)</td>          
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @if($degrees)
                    @foreach($degrees as $key => $degree)
                    <tr>
                        <td>{{ $degree->degree_id }}</td>
                        <td>{{ $degree->degree_name }}</td>
                        <td>{{ $degree->degree_name_en }}</td>
                        <td>
                            <a href="{{url('degree/degree_form/'.$degree->degree_id)}}" title="" class="edit">edit</a>
                            <a href="{{url('degree/delete/'.$degree->degree_id)}}" title="" class="del">del</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <footer>{{$degrees->render()}}</footer>
            </table>
        </div>
    </body>
</html>


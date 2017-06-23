<html>
    <head>
        <title>title</title>
    </head>
    <body>
  
        <div >
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/nation/') }}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                <input type="text" class="form-control" name="txtSearhc">
                   <button type="submit" >
                      ค้นหา
                    </button>
            </form>
            <br><a href="{{url('/nation/nation_form')}}" class="btn btn-success"> New Nation </a>
            <table>
                <thead>
                    <tr>
                        <td>รหัสประเทศ</td>
                        <td>ชื่อประเทศ</td>
                        <td>ชื่อภาษาอังกฤษ</td>          
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @if($nations)
                    @foreach($nations as $key => $nation)
                    <tr>
                        <td>{{ $nation->nation_id }}</td>
                        <td>{{ $nation->nation_name }}</td>
                        <td>{{ $nation->nation_name_en }}</td>
                        <td>
                            <a href="{{url('nation/nation_form/'.$nation->nation_id)}}" title="" class="edit">edit</a>
                            <a href="{{url('nation/delete/'.$nation->nation_id)}}" title="" class="del">del</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <footer>{{$nations->render()}}</footer>
            </table>
        </div>
    </body>
</html>


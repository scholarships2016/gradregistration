<html>
    <head>
        <title>title</title>
    </head>
    <body>
        
         
    
    
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>รหัสประเทศ</td>
            <td>ชื่อประเทศ</td>
            <td>ชื่อภาษาอังกฤษ</td>          
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($nations as $key => $nation)
        <tr>
            <td>{{ $nation->nation_id }}</td>
            <td>{{ $nation->nation_name }}</td>
            <td>{{ $nation->nation_name_en }}</td>
            

             <td>

              
                <a class="btn btn-small btn-info" href="{{ URL::to('nation/' . $nation->nation_id . '/edit') }}">Edit</a>
<a class="btn btn-small btn-info" href="{{ URL::to('nation/' . $nation->nation_id . '/delete') }}">Del</a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <footer>{{$nations->render()}}</footer>
</table>
    
    </body>
</html>


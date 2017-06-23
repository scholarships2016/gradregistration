<html>
    <head>
        <title>title</title>
    </head>
    <body>

        <div >
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/bank/') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                <input type="text" class="form-control" name="txtSearhc">
                <button type="submit" >
                    ค้นหา
                </button>
            </form>
            <br><a href="{{url('/bank/bank_form')}}" class="btn btn-success"> New Bank </a>
            <table>
                <thead>
                    <tr>
                        <td>รหัสธนาคาร/Bank Code</td>
                        <td>บัญชีธนาคาร/Bank Account</td>
                        <td>ชื่อธนาคาร/Bank Name</td> 
                        <td>ค่าธรรมเนียม/Fee</td>  
                        <td>รูป/logo</td>  
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @if($banks)
                    @foreach($banks as $key => $bank)
                    <tr>
                        <td>{{ $bank->bank_id }}</td>
                        <td>{{ $bank->bank_account }}</td>
                        <td>{{ $bank->bank_name }}</td>
                        <td>{{ $bank->bank_fee }}</td>
                        <td>{{ $bank->bank_logo }}</td>
                        <td>
                            <a href="{{url('bank/bank_form/'.$bank->id)}}" title="" class="edit">edit</a>
                            <a href="{{url('bank/delete/'.$bank->id)}}" title="" class="del">del</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <footer>{{$banks->render()}}</footer>
            </table>
        </div>
    </body>
</html>


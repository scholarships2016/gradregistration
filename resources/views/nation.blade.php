<html>
    <head>
        <title>title</title>
    </head>
    <body>
        
        @foreach ($nations as $nation)
        {{$nation->nation_name}}
        @endforeach
    {{$nations->render()}}
    </body>
</html>


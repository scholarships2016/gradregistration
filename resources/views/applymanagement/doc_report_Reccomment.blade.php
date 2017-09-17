
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


        <style>

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
                line-height: 24px;
            }


        </style>
    </head>
    <body>
        <table style="widht:700px" border="0" cellpadding="0" cellspacing="1">

            <tbody>
                <tr border="1px">
                  <br/><br/>
                    <td style="align:center;font-weight:bold;font-size:32px;">
                        <div align="center">
                            <img src="{{asset('images/bwpk.gif')}}" border="0">
                            <br>บัณฑิตวิทยาลัย จุฬาลงกรณ์มหาวิทยาลัย
                            <br>
                            <br>     <br>     <br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="align:left;font-size: 20px;">
                        ที่  &nbsp;&nbsp;&nbsp;  {{$round}}  /  {{$year}}
                    </td>
                </tr>
                <tr>
                    <td style="align:center;font-weight:bold;font-size: 24px;">
                        <div align="center">
                           <br>
                            หนังสือรับรอง<br>บัณฑิตวิทยาลัย ขอรับรองว่า<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="align:center; font-weight:bold;font-size: 24px;">
                        <div align="center"style="font-size: 22px;">
                           <br>
                            {{$title}} {{$name}}<br><br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="align:left;">
                        <p style='font-size: 20px;text-justify: inter-word;text-align:center;'>  {{$detail}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="align:center;">
                        <div align="center" style="align:center;font-size: 20px;">
                            <br><br>
                            ให้ไว้ ณ วันที่ {{$dateMake}}
                            <br><br><br><br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="align:center; "> <div align="center" style="align:center;font-size: 20px;">


                            ( {{$doctor}} )<br>
                            {{$positionDoc}}<br>
                            {{$positionDoc2}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </body>
</html>

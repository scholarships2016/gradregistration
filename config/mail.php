<?php

return [

'driver' => 'smtp',
'host' => env('MAIL_HOST', 'smtp.gmail.com'),
'port' => env('MAIL_PORT', '587'),
'from' => ['address' => 'gradregister.chula@gmail.com', 'name' => 'Graduate Registration Admin'],
'encryption' => env('MAIL_ENCRYPTION','tls') ,
'username' =>   'gradregister.chula@gmail.com' ,
'password' =>  'gradregister.chula@',
'sendmail' => '/usr/sbin/sendmail -bs',

'pretend' => false,


];

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <title>Qit Schedular</title>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h1>{{$mailData['title']}}</h1>
        <p>{{$mailData['body']}}</p>
        <p><a href="{{url('/verification/')}}/{{$mailData['token']}}">Click Here</a> to verify your email</p>
        
        <script src="" async defer></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $maildata['title'] }}</h1>
    <p>{{ $maildata['body'] }}</p>
    <a href="{{$maildata['url']}}" {{ request()->session()->put('url',$maildata['url'] ) }}> {{$maildata['url']}} </a>
    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo assumenda, placeat aut quos asperiores
        nobis. Quidem quibusdam velit nulla consectetur error eos ullam, ea explicabo sed est vitae esse delectus. </p>
    <p>Thank you</p>
</body>
</html>

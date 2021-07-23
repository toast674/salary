<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>赤い屋根</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body class="main">
        {{ Form::open(['url' => ['/staff/store']]) }}
        @csrf
        <div>
            <h1>スタッフ登録画面</h1>
        </div>
        <div>
            {{Form::text('name', null, ['class' => 'form-control'])}}
            {{Form::number('hourly_wage', null, ['class' => 'form-control'])}}
        </div>

        {{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
        {{ Form::close() }}
    </body>
</html>



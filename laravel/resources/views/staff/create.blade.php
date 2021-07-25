<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.header')
    </head>
    <body class="container">
        <h1>スタッフ登録画面</h1>

        {{ Form::open(['url' => ['/staffs/store']]) }}
        @csrf

        <div class="form-group">
            <label for="name">スタッフ名</label>
            {{Form::text('name', null, ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            <label for="hourly_wage">時給</label>
            {{Form::number('hourly_wage', null, ['class' => 'form-control'])}}
        </div>

        {{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
        {{ Form::close() }}
    </body>
</html>



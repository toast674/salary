<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.header')
    </head>
    <body class="container">
        <div>
            <h1>スタッフ登録画面</h1>

            @foreach ($errors->all() as $error)
                <p style="color: red;">{{$error}}</p>
            @endforeach
            
            {{ Form::open(['url' => ['/staffs/store']]) }}
            @csrf

            <div class="row">
                <div class="form-group col-4">
                    <label for="name">スタッフ名</label>
                </div>
                <div class="form-group col-8">
                    {{Form::text('name', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group col-4">
                    <label for="hourly_wage">時給</label>
                </div>
                <div class="form-group col-8">
                    {{Form::text('hourly_wage', null, ['class' => 'form-control'])}}
                </div>
            </div>

            <div class="text-center">
                {{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
            </div>
            {{ Form::close() }}
        </div>
    </body>
</html>



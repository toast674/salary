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
    <body class="container">
        <h1>スタッフ編集</h1>

        {{ Form::open(['url' => ['/staffs/update']]) }}
        @csrf

        <div class="form-group">
            <input type="hidden" value={{ $staff->id }} name="staff_id">
        </div>

        <div class="form-group">
            <label for="name">スタッフ名</label>
            {{Form::text('name', $staff->name, ['class' => 'form-control'])}}
        </div>
        
        <div class="form-group">
            <label for="hourly_wage">時給</label>
            {{Form::number('hourly_wage', $staff->hourly_wage, ['class' => 'form-control'])}}
        </div>

        {{ Form::submit('更新', ['name' => 'update', 'class' => 'btn btn-success btn-sm']) }}
        {{ Form::close() }}
    </body>
</html>



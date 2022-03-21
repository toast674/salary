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
        <div>
            <h1>スタッフ編集</h1>
            {{ Form::open(['url' => ['/staffs/update']]) }}
            @csrf

            <div class="form-group">
                <input type="hidden" value={{ $staff->id }} name="staff_id">
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="name">スタッフ名</label>
                </div>
                <div class="form-group col-8">
                    {{Form::text('name', $staff->name, ['class' => 'form-control', 'required' => 'required'])}}
                </div>
            </div>

            <div class="text-center">
                {{ Form::submit('更新', ['name' => 'update', 'class' => 'btn btn-success btn-s']) }}
            </div>
            {{ Form::close() }}
        </div>
    </body>
</html>



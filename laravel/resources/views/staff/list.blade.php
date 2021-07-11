<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>赤い屋根</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    </head>
    <body class="main">
        <div class="container">
            <p>{{ $staff->name }}の勤務情報</p>
            @foreach ($staff->time_sheets as $time_sheet)
                {{ $time_sheet->workday }}
                {{ $time_sheet->work_start }}
                {{ $time_sheet->work_end }}
                {{ $time_sheet->work_hour }}
                <button>修正</button>
                <br>
            @endforeach
            <a href=<?php echo route('time_sheet.create', ['id' => $staff->id]); ?>>追加</a>
        </div>
    </body>
</html>

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
        <div class="container">
            <p>{{ $staff->name }}の勤務情報</p>
             <!-- フラッシュメッセージ -->
            @if (session('flash_message'))
                <div class="flash_message">
                    {{ session('flash_message') }}
                </div>
            @endif
            @foreach ($staff->time_sheets as $time_sheet)
                {{ $time_sheet->id }}
                {{ $time_sheet->workday }}
                {{ $time_sheet->work_start }}
                {{ $time_sheet->work_end }}
                {{ $time_sheet->work_hour }}
                <button onclick="location.href = '<?php echo route('time_sheet.edit', ['id' => $time_sheet->id]); ?>'">修正</button>
                {{ Form::open(['url' => ['/time_sheets/delete/'. $time_sheet->id], 'name' => 'del']) }}
                @csrf
                <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell" id="delete_button">
                {{ Form::close() }}
            @endforeach
            <a href=<?php echo route('time_sheet.create', ['id' => $staff->id]); ?>>追加</a>
        </div>
    </body>
</html>

<script>
    
$(function(){
  $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    } else {
    return false;
    }
  });
});

</script>


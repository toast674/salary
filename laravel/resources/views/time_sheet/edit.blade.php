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
        {{ Form::open(['url' => ['/time_sheets/update']]) }}
        @csrf
        <div>
            <input type="hidden" value={{ $time_sheet->id }} name="id">
            <input type="hidden" value={{ $staff->id }} name="staff_id">
            <h1>出退勤編集画面</h1>
            <p>{{ $staff->name }}</p>
            {{ Form::date('workday', $time_sheet->workday) }}
        </div>

        <div>   
            <label for="work_start_time">出勤</label>
            {{ Form::select('work_start_hour', $hour_array, $work_start_hour_i) }}
            :
            {{ Form::select('work_start_minute', $minute_array, $work_start_minute_i) }}
        </div>

        <div>
            <label for="work_end_time">退勤</label>
            {{ Form::select('work_end_hour', $hour_array, $work_end_hour_i) }}
            :
            {{ Form::select('work_end_minute', $minute_array, $work_end_minute_i) }}
        </div>

        {{ Form::submit('編集', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
        {{ Form::close() }}
    </body>
</html>

<script>
    // dateの初期値を今日にする
    (function () {
        let today = new Date();
        today.setDate(today.getDate());
        let yyyy = today.getFullYear();
        let mm = ("0"+(today.getMonth()+1)).slice(-2);
        let dd = ("0"+today.getDate()).slice(-2);
        document.getElementById("today").value=yyyy+'-'+mm+'-'+dd;
    })()
</script>


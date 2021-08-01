<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.header')
    </head>
    <body class="container">
        {{ Form::open(['url' => ['/time_sheets/update']]) }}
        @csrf
        <h1 class="text-center">出退勤編集画面</h1>
        <input type="hidden" value={{ $time_sheet->id }} name="id">
        <input type="hidden" value={{ $staff->id }} name="staff_id">
        <h2>{{ $staff->name }}</h2>

        @foreach ($errors->all() as $error)
            <p style="color: red;">{{$error}}</p>
        @endforeach

        <div class="form-group">
            <label for="workday">日付</label>
            {{ Form::date('workday', $time_sheet->workday, ['class' => 'form-control']) }}
        </div>
        
        <div class="form-group">   
            <label for="work_start_time">出勤</label>
            <div class="form-inline">     
                <div>     
                    {{ Form::select('work_start_hour', $hour_array, $work_start_hour_i, ['class' => 'form-control']) }}
                </div>
                <div>     
                    :
                </div>
                <div>   
                    {{ Form::select('work_start_minute', $minute_array, $work_start_minute_i, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <label for="work_end_time">退勤</label>
            <div class="form-inline">
                <div>     
                    {{ Form::select('work_end_hour', $hour_array, $work_end_hour_i, ['class' => 'form-control']) }}
                </div>
                <div>     
                    :
                </div>
                <div>   
                {{ Form::select('work_end_minute', $minute_array, $work_end_minute_i, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        {{ Form::submit('編集', ['name' => 'regist', 'class' => 'btn btn-success btn-lg form-control mt-5']) }}
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


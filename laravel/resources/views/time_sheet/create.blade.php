<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.header')
    </head>
    <body class="container">
        {{ Form::open(['url' => ['/time_sheets/store']]) }}
        @csrf
        <input type="hidden" value={{ $staff->id }} name="staff_id">
        <h1 class="text-center">出退勤登録画面</h1>
        <h2>{{ $staff->name }}</h2>

        @foreach ($errors->all() as $error)
            <p style="color: red;">{{$error}}</p>
        @endforeach

        <div class="form-group">
            <label for="workday">日付</label>
            {{ Form::date('workday', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">   
            <label for="work_start_time">出勤</label>
            <div class="form-inline">     
                <div>     
                    {{ Form::select('work_start_hour', $hour_array, 9, ['class' => 'form-control']) }}
                </div>
                <div>     
                    :
                </div>
                <div>   
                    {{ Form::select('work_start_minute', $minute_array, 0, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <label for="work_end_time">退勤</label>
            <div class="form-inline">
                <div>     
                    {{ Form::select('work_end_hour', $hour_array, 18, ['class' => 'form-control']) }}
                </div>
                <div>     
                    :
                </div>
                <div>   
                {{ Form::select('work_end_minute', $minute_array, 30, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        {{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg form-control mt-5']) }}
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


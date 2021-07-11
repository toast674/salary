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
        {{ Form::open(['url' => ['/time_sheets/store']]) }}
        @csrf
        <div>
            <input type="hidden" value={{ $staff->id }} name="staff_id">
            <h1>出退勤登録画面</h1>
            <p>{{ $staff->name }}</p>
            <input type="date" name="workday" id="today">
        </div>

        <div>
            <label for="work_start_time">出勤</label>
            <select name="work_start_hour">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10" selected>10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
            </select>
            :
            <select name="work_start_minute">
                <option value="00">00</option>
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
            </select>
        </div>

        <div>
            <label for="work_end_time">退勤</label>
            <select name="work_end_hour">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18" selected>18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
            </select>
            :
            <select name="work_end_minute">
                <option value="0">00</option>
                <option value="15">15</option>
                <option value="30" selected>30</option>
                <option value="45">45</option>
            </select>
        </div>

        {{ Form::submit('登録', ['name' => 'regist', 'class' => 'btn btn-success btn-lg']) }}
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


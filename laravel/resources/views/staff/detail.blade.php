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
            <h1>{{ $staff->name }}の勤務情報</h1>
			<form method="POST" action='<?php echo route('staff.detail', ['id' => $staff->id]); ?>'>
				@csrf
				<div class="row">
					<div class="col-auto">
						{{ Form::select('year', config('const.YEAR_LIST'), $now_year, ['class' => 'form-control']) }}
					</div>
					<div>
						年
					</div>
					<div class="col-auto">
						{{ Form::select('month', config('const.MONTH_LIST'), $now_month, ['class' => 'form-control'])}}
					</div>
					<div>
						月
					</div>
					<div>
						<button type="submit" class="btn btn-primary btn-sm">検索</button>
					</div>
					<div>
						<button type="button" class="btn btn-primary btn-sm text-right" onclick="location.href='<?php echo route('time_sheet.create', ['id' => $staff->id]); ?>'">新規登録</button>
					</div>
				</div>
			</form>
            <!-- フラッシュメッセージ -->
            @if (session('flash_message'))
                <div class="flash_message">
                    {{ session('flash_message') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">日付</th>
                        <th scope="col">出勤</th>
                        <th scope="col">退勤</th>
                        <th scope="col">時間</th>
                        <th scope="col">修正・削除</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($time_sheets as $time_sheet)
                        <tr>
                            <td>{{ $time_sheet->workday }}</td>
                            <td>{{ $time_sheet->work_start }}</td>
                            <td>{{ $time_sheet->work_end }}</td>
                            <td>{{ $time_sheet->work_hour }}</td>
                            {{ Form::open(['url' => ['/time_sheets/delete/'. $time_sheet->id], 'name' => 'del']) }}
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '<?php echo route('time_sheet.edit', ['id' => $time_sheet->id]); ?>'">修正</button>
                                <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                            </td>
                            @csrf
                            {{ Form::close() }}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                合計: {{ $total_work_hour }} 時間  {{ $total_month_sulary }}  円
            </div>
            <div class="d-flex justify-content-center">
                {{ $time_sheets->links() }}
			</div>
            <button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?php echo route('staff.index'); ?>'">スタッフ一覧に戻る</button>
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


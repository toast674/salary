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
    <body class="staff_list">
      <div class="container">
        @foreach($staffs as $staff)
          <p>{{ $staff->name }}</p>
          <a href=<?php echo route('staff.detail', ['id' => $staff->id]); ?>>{{ $staff->name }}</a>
          <button onclick="location.href = '<?php echo route('staff.edit', ['id' => $staff->id]); ?>'">修正</button>
          {{ Form::open(['url' => ['/staff/delete/'. $staff->id], 'name' => 'del']) }}
          @csrf
          <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell" id="delete_button">
          {{ Form::close() }}
        @endforeach
        <button onclick="location.href = '<?php echo route('staff.create'); ?>'">スタッフ追加</button>
      </div>
    </body>
</html>

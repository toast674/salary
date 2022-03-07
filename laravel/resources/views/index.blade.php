<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      @include('layout.header')
    </head>
    <body class="staff_list">
      <div class="container">
        <h1>スタッフ一覧</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">スタッフ名</th>
              <th scope="col">オプション</th>
            </tr>
          </thead>
          <tbody>
            @foreach($staffs as $staff)
            {{ Form::open(['url' => ['/staffs/delete/'. $staff->id], 'name' => 'del']) }}
            @csrf
            <tr>
              <td>{{ $staff->name }}</td>
              <td> 
                <button type="button" onclick="location.href = '<?php echo route('staff.detail', ['id' => $staff->id]); ?>'" class="btn btn-s btn-primary">勤務一覧</button>
                <button type="button" onclick="location.href = '<?php echo route('staff.edit', ['id' => $staff->id]); ?>'" class="btn btn-s btn-success">修正</button>
                <input type="submit" value="削除" class="btn btn-s btn-danger btn-dell">
              </td>
            </tr>
            {{ Form::close() }}
            @endforeach
          </tbody>
        </table>
        <div class="text-center">
          <button onclick="location.href = '<?php echo route('staff.create'); ?>'" class="btn btn-s btn-primary">スタッフ追加</button>
        </div>
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
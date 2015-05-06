@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">用户管理</div>

        <div class="panel-body">

        <a href="{{ URL('admin/users/create') }}" class="btn btn-lg btn-primary">新增</a>

          @foreach ($users as $user)
            <hr>
            <div class="page">
              <h4>{{ $user->name }}</h4>
              <div class="content">
                <p>
                  {{ $user->come_for }}
                </p>
              </div>
            </div>
            <a href="{{ URL('admin/users/'.$user->id.'/edit') }}" class="btn btn-success">编辑</a>

            <form action="{{ URL('admin/users/'.$user->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">删除</button>
            </form>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('app')
	
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑 权限</div>

        <div class="panel-body">

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ URL('admin/permissions/'.$permission->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="name" class="form-control" required="required" value="{{ $permission->name }}">
            <br>
            <input type="text" name="display_name" class="form-control" value="{{ $permission->display_name }}">
            <br>
            <input type="text" name="description" class="form-control" value="{{ $permission->description }}">
            <br>
            <button class="btn btn-lg btn-info">编辑 权限</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
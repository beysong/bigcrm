@extends('app')
	
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑 用户</div>

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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/users/'.$roles['user']->id) }}">
            			<input name="_method" type="hidden" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">用户名</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $roles['user']->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">邮箱</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ $roles['user']->email }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">新密码</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">确认密码</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">角色</label>
							<div class="col-md-6">
								<select class="form-control" name="role">
									<option value="">请选择</option>
								@foreach($roles['all'] as $role)
									<option value="{{ $role['name'] }}" @if(in_array($role['name'],$roles['now'])) selected="selected" @endif >{{ $role['display_name'] }}</option>
								@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									更新
								</button>
							</div>
						</div>
					</form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
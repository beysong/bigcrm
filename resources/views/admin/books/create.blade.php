@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增 Book</div>

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

          <form action="{{ URL('admin/books') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="name" class="form-control" required="required">
            <br>
            <input type="text" name="tel" class="form-control" required="required">
            <br>
            <button class="btn btn-lg btn-info">新增 Book</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
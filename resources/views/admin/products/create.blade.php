@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增 Product</div>

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

          <form action="{{ URL('admin/products') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required="required">
            <br>
            <label>Display Name</label>
            <input type="text" name="display_name" class="form-control">
            <br>
            <label>Description</label>
            <input type="text" name="description" class="form-control">
            <br>
            <button class="btn btn-lg btn-info">新增 Product</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
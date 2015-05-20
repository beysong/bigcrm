@extends('app')

@section('content')
<div class="container">

<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><a href="{{ URL('admin/products/create') }}" class="btn btn-xs btn-success">添加</a></div>

        <div class="panel-body">

            <div class="page">
              <div class="content">
<table width="100%">
	<tr>
		<th width="50" class="num1">操作</th>
		<th width="50">id</th>
		<th width="150" class="num1">Name(每类商品唯一编号)</th>
		<th width="150">Display Name（显示名称，方便识别）</th>
		<th width="150">Description（商品描述）</th>
	</tr>

	@foreach ($products as $product)
	<tr>
		<td class="num1">
		<a href="{{ URL('admin/products/'.$product->id.'/edit') }}" class="btn btn-xs btn-success">编辑</a>
		</td>
		<td>{{ $product->id }}</td>
		<td class="num1">{{ $product->name }}</td>
		<td>{{ $product->display_name }}</td>
		<td>{{ $product->description }}</td>
	</tr>

	@endforeach
		
</table>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>
<style>
table tr:nth-child(odd) td{background:#f7f7f7;}
table tr th{text-align:center;border:1px solid #f1f1f1;}
table tr td{padding:3px;border:1px solid #f1f1f1;}
table tr th{padding:3px;background:#f5f5f5;}
</style>
</div>
@endsection
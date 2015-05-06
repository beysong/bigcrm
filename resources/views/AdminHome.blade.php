@extends('app')

@section('content')
<!--<div class="container">-->

<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">后台首页</div>

        <div class="panel-body">
<form action="{{ URL('admin/') }}" method="GET">
<div class="container">
		<div class="col-sm-4">
            <h5><span class="label label-info">店铺</span></h5>
            <select name="shop" class="form-control">
            	<option @if(old('shop') == 'all') selected="selected" @endif value="all">所有店铺</option>
            	<option @if(old('shop') == 'shop 1') selected="selected" @endif value="shop 1">店铺1</option>
            	<option @if(old('shop') == 'shop 2') selected="selected" @endif value="shop 2">店铺2</option>
            	<option @if(old('shop') == 'shop 3') selected="selected" @endif value="shop 3">店铺3</option>
            	<option @if(old('shop') == 'shop 4') selected="selected" @endif value="shop 4">店铺4</option>
            	<option @if(old('shop') == 'shop 5') selected="selected" @endif value="shop 5">店铺5</option>
            </select>
         </div>
		<div class="col-sm-4">
        </div>
		<div class="col-sm-4">
            <div class="col-sm-12"><button class="btn btn-sm btn-info">查询</button></div>
         </div>
</div>
<div class="container">
		<div class="col-sm-4">
            <h5><span class="label label-info">开始日期</span></h5>
                <div class="input-group date start_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="{{ old('dtp_input1') }}" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input1" name="dtp_input1" value="{{ old('dtp_input1') }}" /><br/>
         </div>
		<div class="col-sm-4">
            <h5><span class="label label-info">结束日期</span></h5>
                <div class="input-group date end_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="{{ old('dtp_input2') }}" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" name="dtp_input2" value="{{ old('dtp_input2') }}" /><br/>
         </div>
		<div class="col-sm-4">
         
         </div>
</div>
<div class="container">
		<div class="col-sm-4">
            <h5><span class="label label-info">状态</span></h5>
            <select name="status" class="form-control">
            	<option @if(old('status') == 'all') selected="selected" @endif value="all">所有</option>
            	<option @if(old('status') == '1') selected="selected" @endif value="1">状态1</option>
            	<option @if(old('status') == '2') selected="selected" @endif value="2">状态2</option>
            	<option @if(old('status') == '3') selected="selected" @endif value="3">状态3</option>
            </select>
         </div>
		<div class="col-sm-4">
         </div>
		<div class="col-sm-4">
         
         </div>
</div>
</form>
<br style="clear:both;">
            <div class="page">
              <div class="content">
<table width="2700">
	<tr>
		<th width="50" class="num1">操作</th>
		<th width="50">id</th>
		<th width="150" class="num1">店铺</th>
		<th width="150">日期</th>
		<th width="150" class="num1">时段</th>
		<th width="150">姓名</th>
		<th width="150" class="num1">电话</th>
		<th width="100">会员ID</th>
		<th width="150" class="num1">来源商品</th>
		<th width="150">预约目的</th>
		<th width="50" class="num1">是否消费</th>
		<th width="50">状态</th>
		<th width="150" class="num1">状态修改人员</th>
		<th width="150">状态修改时间</th>
		<th width="150" class="num1">状态修改备注</th>
		<th width="150">例行电话人员</th>
		<th width="150" class="num1">例行电话结果</th>
		<th width="150">例行电话修改时间</th>
		<th width="150" class="num1">未到店人员</th>
		<th width="150">未到店沟通结果</th>
		<th width="150" class="num1">未到店修改时间</th>
	</tr>

	@foreach ($books as $book)
	<tr>
		<td class="num1">
		<a href="{{ URL('admin/books/'.$book->id.'/edit') }}" class="btn btn-xs btn-success">编辑</a>
		<form action="{{ URL('admin/books/'.$book->id) }}" method="POST" style="display: none;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">删除</button>
        </form>
		</td>
		<td>{{ $book->id }}</td>
		<td class="num1">{{ $book->shop }}</td>
		<td>{{ $book->come_date }}</td>
		<td class="num1">{{ $book->come_time }}</td>
		<td>{{ $book->name }}</td>
		<td class="num1">{{ $book->tel }}</td>
		<td>{{ $book->userid }}</td>
		<td class="num1">{{ $book->come_product }}</td>
		<td>{{ $book->come_for }}</td>
		<td class="num1">{{ $book->is_xiaofei }}</td>
		<td>{{ $book->status }}</td>
		<td class="num1">{{ $book->status_opt }}</td>
		<td>{{ $book->status_time }}</td>
		<td class="num1">{{ $book->status_note }}</td>
		<td>{{ $book->lixing_opt }}</td>
		<td class="num1">{{ $book->lixing_time }}</td>
		<td>{{ $book->lixing_note }}</td>
		<td class="num1">{{ $book->not_opt }}</td>
		<td>{{ $book->not_note }}</td>
		<td class="num1">{{ $book->not_time }}</td>
	</tr>

	@endforeach
		
</table>
<?php echo $books->appends(['shop' => old('shop')])
	->appends(['status' => old('status')])
	->appends(['dtp_input1' => old('dtp_input1')])
	->appends(['dtp_input2' => old('dtp_input2')])
	->render(); ?>
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
<!--</div>-->

<script type="text/javascript" src="/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">

	$('.start_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.end_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });

</script>
@endsection
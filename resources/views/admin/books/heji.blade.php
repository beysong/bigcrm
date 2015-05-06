@extends('app')

@section('content')
<!--<div class="container">-->

<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">后台首页</div>

        <div class="panel-body">
<form action="{{ URL('admin/books/heji') }}" method="GET">
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

</form>
<br style="clear:both;">
            <div class="page">
              <div class="content">
<table width="100%">
	<tr>
		<th width="100">日期</th>
		<th width="150">店铺</th>
		<th width="100">预约人数</th>
		<th width="100">到店人数</th>
		<th width="100">预约到达率</th>
		<th width="100">购买率</th>
		<th width="200">TOP商品1</th>
		<th width="200">TOP商品2</th>
		<th width="200">TOP商品3</th>
	</tr>
	@foreach ($books as $book)
	<tr>
		<td>{{ $book->come_date2 }}</td>
		<td>{{ $book->shop }}</td>
		<td>{{ $book->allbook }}</td>
		<td>{{ $book->allcome }}</td>
		<td>{{ sprintf("%.2f", $book->allcome/$book->allbook*100) }} %</td>
		<td>@if($book->allcome == 0) 0 @else {{sprintf("%.2f", $book->xiaofei/$book->allcome*100)}} @endif %</td>
<?php
	$allpro = explode('|',$book->all_pro,4);
	//echo '<pre>';print_r($allpro);
?>
		<td><?php echo isset($allpro['0']) ? $allpro['0'] : '';?></td>
		<td><?php echo isset($allpro['1']) ? $allpro['1'] : '';?></td>
		<td><?php echo isset($allpro['2']) ? $allpro['2'] : '';?></td>
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
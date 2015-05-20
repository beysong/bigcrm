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
             	<option value="all">所有店铺</option>
             	@foreach (Config::get('constants.SHOP') as $k=>$v)
             		<option value="{{ $k }}">{{ $v }}</option>
             	@endforeach
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
		<td><?php $status_arr = Config::get('constants.SHOP'); echo isset($status_arr[$book->shop])?$status_arr[$book->shop]:'';?></td>
		<td>{{ $book->allbook }}</td>
		<td>{{ $book->allcome }}</td>
		<td>{{ sprintf("%.2f", $book->allcome/$book->allbook*100) }} %</td>
		<td>@if($book->allcome == 0) 0 @else {{sprintf("%.2f", $book->xiaofei/$book->allcome*100)}} @endif %</td>
<?php
	$allpro = explode('|',$book->all_pro,4);
	//echo '<pre>';print_r($allpro);
	$product = Config::get('constants.PRODUCT');
?>

		<td>
			<?php 
				//echo isset($allpro['0']) && isset($product[$allpro['0']]) ? $product[$allpro['0']] : '未知商品';
				if(isset($allpro['0'])){
					$top0 = explode(',', $allpro['0']);
					echo isset($product[$top0['0']])?$product[$top0['0']]:'未知商品';
					echo ':',$top0['1'];
				}
			?>
		</td>
		<td>
			<?php 
				//echo isset($allpro['0']) && isset($product[$allpro['0']]) ? $product[$allpro['0']] : '未知商品';
				if(isset($allpro['1'])){
					$top1 = explode(',', $allpro['1']);
					echo isset($product[$top1['0']])?$product[$top1['0']]:'未知商品';
					echo ':',$top1['1'];
				}
			?>
		</td>
		<td>
			<?php 
				//echo isset($allpro['0']) && isset($product[$allpro['0']]) ? $product[$allpro['0']] : '未知商品';
				if(isset($allpro['2'])){
					$top2 = explode(',', $allpro['0']);
					echo isset($product[$top2['0']])?$product[$top2['0']]:'未知商品';
					echo ':',$top2['1'];
				}
			?>
		</td>
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
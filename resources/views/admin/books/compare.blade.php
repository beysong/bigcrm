@extends('app')

@section('content')
<!--<div class="container">-->

<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">后台首页</div>

        <div class="panel-body">
<form action="{{ URL('admin/books/compare') }}" method="GET">
<div class="container">
		<div class="col-sm-4">
            <h5><span class="label label-info">店铺</span></h5>
            <select name="shop[]" class="form-control" multiple=true>
             	@foreach (Config::get('constants.SHOP') as $k=>$v)
             		<option @if( in_array( $k, !empty(Input::old('shop'))?Input::old('shop'):array() ) ) selected="selected" @endif  value="{{ $k }}">{{ $v }}</option>
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
		<th width="100">商品名称</th>
		<?php 
		$shop_arr = Config::get('constants.SHOP'); 
		if(!empty($books)){
			$allshop2 = explode('|',$books[0]->all_shop);
			foreach($allshop2 as $k=>$v){
		?>
	
			<th width="100"><?php $shop = explode(',',$v);echo isset($shop_arr[$shop[0]])?$shop_arr[$shop[0]]:'未知店铺'; ?></th>
				
		<?php }} ?>
		
	</tr>
	@foreach ($books as $book)
	<tr>
		<td>
			<?php 
				$product = Config::get('constants.PRODUCT');
				echo isset($product[$book->come_product])?$product[$book->come_product]:'未知商品'; 
			?>
		</td>
		<?php
			$allshop = explode('|',$book->all_shop);
			//echo '<pre>';print_r($allpro);
			foreach($allshop as $k=>$v){
		?>
			<td><?php $shopcount = explode(',',$v);echo $shopcount[1]; ?></td>
		<?php } ?>
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
@extends('app')

@section('content')
<!--<div class="container">-->

<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
<script type="text/javascript" src="/js/Chart/Chart.js" charset="UTF-8"></script>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">后台首页</div>

        <div class="panel-body">
<form action="{{ URL('admin/books/chart') }}" method="GET">
<div class="container">
		<div class="col-sm-4">
            <h5><span class="label label-info">店铺</span></h5>
            <select name="shop" class="form-control">
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
              <div class="content" style="text-align:center;">
				<div style="text-align:center;">
					<?php 
						//echo '<pre>';
						//print_r(json_decode($books));
						if(isset(json_decode($books)->datasets))
						foreach(json_decode($books)->datasets as $k=>$v){
							
					?>
					<span style="display:inline-block;margin-right:36px;"><em style="width:12px;height:12px;display:inline-block;background:<?php echo $v->pointColor; ?>;"></em> <?php echo $v->sname; ?></span> 
					<?php } ?>
				</div>
				<canvas id="myChart" width="1200" height="600"></canvas>

<script>
/*
var data = {
	labels : ["January","February","March","April","May","June","July"],
	datasets : [
		{
			fillColor : "rgba(220,220,220,0.5)",
			strokeColor : "rgba(220,220,220,1)",
			pointColor : "rgba(220,220,220,1)",
			pointStrokeColor : "#fff",
			data : [65,59,90,81,56,55,40]
		},
		{
			fillColor : "rgba(151,187,205,0.5)",
			strokeColor : "rgba(151,187,205,1)",
			pointColor : "rgba(151,187,205,1)",
			pointStrokeColor : "#fff",
			data : [28,48,40,19,96,27,100]
		}
	]
}*/
var loption={
	scaleShowLabels : true,
		datasetFill : false,
}
//Get the context of the canvas element we want to select
var ctx = document.getElementById("myChart").getContext("2d");
new Chart(ctx).Line(<?php echo $books; ?>,loption);

</script>

              </div>
            </div>

        </div>
      </div>
    </div>
  </div>

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
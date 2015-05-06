@extends('app')
	
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑 预约信息</div>

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

          <form action="{{ URL('admin/books/'.$book->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-sm-4">
            <h5><span class="label label-info">店铺</span></h5>
            <select name="shop" class="form-control">
            	<option @if($book->shop == 'shop 1') selected="selected" @endif  value="shop 1">店铺1</option>
            	<option @if($book->shop == 'shop 2') selected="selected" @endif  value="shop 2">店铺2</option>
            	<option @if($book->shop == 'shop 3') selected="selected" @endif  value="shop 3">店铺3</option>
            	<option @if($book->shop == 'shop 4') selected="selected" @endif  value="shop 4">店铺4</option>
            	<option @if($book->shop == 'shop 5') selected="selected" @endif  value="shop 5">店铺5</option>
            </select>
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">日期</span></h5>
                <div class="input-group date come_date2 col-md-10" data-date="" data-date-format="dd MM yyyy" data-link-field="come_date" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="{{ $book->come_date }}" required="required" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="come_date" name="come_date" value="{{ $book->come_date }}" />
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">时段</span></h5>
            <select name="come_time" class="form-control" required="required">
             	@foreach (Config::get('constants.SHIDUAN') as $k=>$v)
             		<option @if($book->come_time == $k) selected="selected" @endif  value="{{ $k }}">{{ $v }}</option>
             	@endforeach
            </select>
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">姓名</span></h5>
            <input type="text" name="name" class="form-control" required="required" value="{{ $book->name }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">电话</span></h5>
            <input type="text" name="tel" class="form-control" required="required" value="{{ $book->tel }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">会员ID</span></h5>
            <input type="text" name="userid" class="form-control" required="required" value="{{ $book->userid }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">来源商品</span></h5>
            <input type="text" name="come_product" class="form-control" required="required" value="{{ $book->come_product }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">预约目的</span></h5>
            <select name="come_for" class="form-control" required="required">
             	@foreach (Config::get('constants.MUDI') as $k=>$v)
             		<option @if($book->come_time == $k) selected="selected" @endif  value="{{ $k }}">{{ $v }}</option>
             	@endforeach
            </select>
         </div>
         <div class="col-sm-5">
            <h5><span class="label label-info">是否消费</span></h5>
            <select name="is_xiaofei" class="form-control">
            	<option @if($book->is_xiaofei == 1) selected="selected" @endif  value="1">是</option>
            	<option @if($book->is_xiaofei == 0) selected="selected" @endif  value="0">否</option>
            </select>
         </div>
         <div class="col-sm-5">
            <h5><span class="label label-info">状态</span></h5>
            <select name="status" class="form-control" required="required">
             	@foreach (Config::get('constants.BOOK_STATUS') as $k=>$v)
             		<option @if($book->status == $k) selected="selected" @endif  value="{{ $k }}">{{ $v }}</option>
             	@endforeach
            </select>
         </div>
            <br style="clear:both;">
            <div class="col-sm-12">
            <h5><span class="label label-info">修改备注</span></h5>
            <textarea row="3" name="status_note" class="form-control">{{ $book->status_note }}</textarea>
            <a href="#" style="float:right;" class="btn btn-xs btn-danger">修改</a>
            </div>
            <br style="clear:both;">
            <div class="col-sm-12">
            <h5><span class="label label-info">例行电话备注</span></h5>
            <textarea row="3" name="lixing_note" class="form-control">{{ $book->lixing_note }}</textarea>
            <a href="#" style="float:right;" class="btn btn-xs btn-danger">修改</a>
            </div>
            <br style="clear:both;">
            <div class="col-sm-12">
            <h5><span class="label label-info">未到店电话备注</span></h5>
            <textarea row="3" name="not_note" class="form-control">{{ $book->not_note }}</textarea>
            <a href="#" style="float:right;" class="btn btn-xs btn-danger">修改</a>
            </div>
            <br style="clear:both;">

            <br>
            <div class="col-sm-4"><button class="btn btn-sm btn-info">保存</button></div>
            <div class="col-sm-4"><a href="/admin" class="btn btn-sm btn-info">返回</a></div>
            <div class="col-sm-4"></div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">

	$('.come_date2').datetimepicker({
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
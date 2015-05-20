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
                  <li style="color:red;">{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          			
          <form id="bookformid" action="{{ URL('admin/books/'.$book->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-sm-4">
            <h5><span class="label label-info">店铺</span></h5>
            <select name="shop" class="form-control">
             	@foreach (Config::get('constants.SHOP') as $k=>$v)
             		<option @if($book->shop == $k) selected="selected" @endif  value="{{ $k }}">{{ $v }}</option>
             	@endforeach
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
            <input type="text" readonly name="name" class="form-control" required="required" value="{{ $book->name }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">电话</span></h5>
            <input type="text" readonly name="tel" class="form-control" required="required" value="{{ $book->tel }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">会员ID</span></h5>
            <input type="text" name="userid" class="form-control" value="{{ $book->userid }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">来源商品</span></h5>
            <?php $product = Config::get('constants.PRODUCT');?>
            <input type="text" readonly name="come_product" class="form-control" value="{{ isset($product[$book->come_product])?$product[$book->come_product]:'未知商品' }}">
         </div>
         <div class="col-sm-4">
            <h5><span class="label label-info">预约目的</span></h5>
            <input type="text" readonly name="come_for" class="form-control" value="<?php $come_for = Config::get('constants.MUDI');echo isset($come_for[$book->come_for])?$come_for[$book->come_for]:''; ?>">
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
            <textarea row="3" name="status_note" onblur="setOptStatus('status','{{ $book->status_note }}')" id="status_note" class="form-control" readonly>{{ $book->status_note }}</textarea>
			<div id="status_star" style="float:left;"></div>
            <input type="hidden" name="status_opt" id="status_opt" value="{{ $book->status_opt }}">
            <input type="hidden" name="status_time" id="status_time" value="{{ $book->status_time }}">
            <input type="hidden" name="status_score" id="status_score" value="{{ $book->status_score }}">
            <a href="#" style="float:right;" id="edit_status_note" class="btn btn-xs btn-danger">编辑</a>
            <a href="#" style="float:right;display:none;" id="modify_status_note" class="btn btn-xs btn-danger">修改</a>
            <script type="text/javascript">
            	var before_status_note = '{{ $book->status_note }}';
            	var opt_email = '{{ Auth::user()->email }}';
            	
            	$("#edit_status_note").toggle(function(){
            		$('textarea#status_note').attr("readonly",false); 
            	},function(){
            		$('textarea#status_note').attr("readonly",true); 
            	});
            	
            	function setOptStatus(type_opt,opttext){
            		if($('#'+type_opt+'_note').val() != before_status_note){
            			$('#'+type_opt+'_opt').val(opt_email);
            			$('#'+type_opt+'_time').val(Date.parse(new Date())/1000);
            		}
            	}
            	//alert({{ Auth::user() }});
            	
			    $(document).ready(function() {
			    	status_note = $('textarea#status_note').val();
		            $("#modify_status_note").click(function(){
		            	$.ajax({
						type: 'POST',
						url: '/admin/books/modify_status',
						data: { 'id' : {{ $book->id }}, 'status_note' : status_note},
						dataType: 'json',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						},
						success: function(data){
							console.log(data.status);
							alert('修改成功!')
						},
						error: function(xhr, type){
							alert('修改失败!')
						}
						});
					});
			});
			</script>
            </div>
            <br style="clear:both;">
            <div class="col-sm-12">
            <h5><span class="label label-info">例行电话备注</span></h5>
            <textarea row="3" name="lixing_note"id="lixing_note" onblur="setOptLixing('lixing','{{ $book->lixing_note }}')" class="form-control" readonly>{{ $book->lixing_note }}</textarea>
			<div id="lixing_star" style="float:left;"></div>
            <input type="hidden" name="lixing_opt" id="lixing_opt" value="{{ $book->lixing_opt }}">
            <input type="hidden" name="lixing_time" id="lixing_time" value="{{ $book->lixing_time }}">
            <input type="hidden" name="lixing_score" id="lixing_score" value="{{ $book->lixing_score }}">
            <a href="#" style="float:right;" id="edit_lixing_note" class="btn btn-xs btn-danger">编辑</a>
            <a href="#" style="float:right;display:none;" id="modify_lixing_note" class="btn btn-xs btn-danger">修改</a>
            <script type="text/javascript">
            	var before_lixing_note = '{{ $book->lixing_note }}';
            	var opt_email = '{{ Auth::user()->email }}';
            	
            	$("#edit_lixing_note").toggle(function(){
            		$('textarea#lixing_note').attr("readonly",false); 
            	},function(){
            		$('textarea#lixing_note').attr("readonly",true); 
            	});
            	
            	function setOptLixing(type_opt,opttext){
            		if($('#'+type_opt+'_note').val() != before_lixing_note){
            			$('#'+type_opt+'_opt').val(opt_email);
            			$('#'+type_opt+'_time').val(Date.parse(new Date())/1000);
            		}
            	}
            	//alert({{ Auth::user() }});
            	
			    $(document).ready(function() {
			    	lixing_note = $('textarea#lixing_note').val();
		            $("#modify_lixing_note").click(function(){
		            	$.ajax({
						type: 'POST',
						url: '/admin/books/modify_lixing',
						data: { id : {{ $book->id }}, lixing_note : lixing_note},
						dataType: 'json',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						},
						success: function(data){
						//	console.log(data.status);
							alert('修改成功!')
						},
						error: function(xhr, type){
							alert('修改失败!')
						}
						});
					});
			});
			</script>
            </div>
            <br style="clear:both;">
            <div class="col-sm-12">
            <h5><span class="label label-info">未到店电话备注</span></h5>
            <textarea row="3" name="not_note" id="not_note" onblur="setOptNot('not','{{ $book->not_note }}')" class="form-control" readonly>{{ $book->not_note }}</textarea>
			<div id="not_star" style="float:left;"></div>
            <input type="hidden" name="not_opt" id="not_opt" value="{{ $book->not_opt }}">
            <input type="hidden" name="not_time" id="not_time" value="{{ $book->not_time }}">
            <input type="hidden" name="not_score" id="not_score" value="{{ $book->not_score }}">
            <a href="#" style="float:right;" id="edit_not_note" class="btn btn-xs btn-danger">编辑</a>
            <a href="#" style="float:right;display:none;" id="modify_not_note" class="btn btn-xs btn-danger">修改</a>
            <script type="text/javascript">
            	var before_not_note = '{{ $book->not_note }}';
            	var opt_email = '{{ Auth::user()->email }}';
            	
            	$("#edit_not_note").toggle(function(){
            		$('textarea#not_note').attr("readonly",false); 
            	},function(){
            		$('textarea#not_note').attr("readonly",true); 
            	});
            	
            	function setOptNot(type_opt,opttext){
            		if($('#'+type_opt+'_note').val() != before_not_note){
            			$('#'+type_opt+'_opt').val(opt_email);
            			$('#'+type_opt+'_time').val(Date.parse(new Date())/1000);
            		}
            	}
            	//alert({{ Auth::user() }});
			
			    $(document).ready(function() {
			    not_note = $('textarea#not_note').val();
		            $("#modify_not_note").click(function(){
		            	$.ajax({
						type: 'POST',
						url: '/admin/books/modify_not',
						data: { id : {{ $book->id }}, not_note : not_note},
						dataType: 'json',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						},
						success: function(data){
							console.log(data.status);
							alert('修改成功!')
						},
						error: function(xhr, type){
							alert('修改失败!')
						}
						});
					});
			});
			</script>
            </div>
            <br style="clear:both;">

			@if(Session::has('success'))
				<script>
					alert('{{ Session::get('success') }}');
				</script>
			@endif
					
            <br>
            <div class="col-sm-4"><button class="btn btn-sm btn-info">保存</button></div>
            <div class="col-sm-4"><a href="javascript:void(0);" onclick="submitform()" class="btn btn-sm btn-info">保存并关闭</a></div>
            <div class="col-sm-4"></div>
          </form>
<script>
function submitform(){
	var input1 = $("<input>")
               .attr("type", "hidden")
               .attr("name", "redirect_type").val("re");
	$('#bookformid').append($(input1));
	$('#bookformid').submit();
}


</script>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript" src="/js/jquery.raty.min.js" charset="UTF-8"></script>
<script type="text/javascript">
	//评分
	//alert({{ $book->status_score }});
	$('#status_star').raty({
		path:"/img",
		hints: ['1', '2', '3', '4', '5'],
		size:24,
		score:{{ (!empty($book->status_score)&&is_numeric($book->status_score))?$book->status_score:0 }},
		click: function (score, evt) {
			$("#status_score").val(score);
		}
	});
	$('#lixing_star').raty({
		path:"/img",
		hints: ['1', '2', '3', '4', '5'],
		size:24,
		score:{{ (!empty($book->lixing_score) && is_numeric($book->lixing_score))?$book->lixing_score:0 }},
		click: function (score, evt) {
			$("#lixing_score").val(score);
		}
	});
	$('#not_star').raty({
		path:"/img",
		hints: ['1', '2', '3', '4', '5'],
		size:24,
		score:{{ (!empty($book->not_score)&&is_numeric($book->not_score))?$book->not_score:0 }},
		click: function (score, evt) {
			$("#not_score").val(score);
		}
	});
	
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
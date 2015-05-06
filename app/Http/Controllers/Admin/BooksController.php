<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Book;
use Redirect, Input, Auth;

class BooksController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
//	public function index()
//	{
		//
//	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.books.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'tel' => 'required',
		]);

		$book = new Book;
		$book->name = Input::get('name');
		$book->tel = Input::get('tel');
		$book->userid = 1;//Auth::user()->id;

		if ($book->save()) {
			return Redirect::to('admin');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
	}


	public function outstore(Request $request)
	{
	if(Input::has('come_name') && Input::has('come_shiduan')){
		$book = new Book;
		$book->name = Input::get('come_name');
		$book->tel = Input::get('come_tel');
		$book->come_date = Input::get('come_date');
		$book->come_time = Input::get('come_shiduan');
		$book->come_for = Input::get('come_mudi');
		$callback = Input::get("callback");
		if($book->save()){
			$message="成功";
		}else{
			$message="失败";
		}
			//return json_encode($callback);
			return \Response::json( $message )->setCallback( Input::get('callback') );
	}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('admin.books.edit')->withBook(Book::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'name' => 'required',
			'tel' => 'required',
		]);

		$book = Book::find($id);
		$book->shop = Input::get('shop');
		$book->come_date = Input::get('come_date');
		$book->come_time = Input::get('come_time');
		$book->name = Input::get('name');
		$book->tel = Input::get('tel');
		$book->is_xiaofei = Input::get('is_xiaofei');
		$book->status = Input::get('status');
		$book->status_note = Input::get('status_note');
		$book->lixing_note = Input::get('lixing_note');
		$book->not_note = Input::get('not_note');
		$book->come_product = Input::get('come_product');
		
		$book->status_opt = Auth::user()->email;

		if ($book->save()) {
			return Redirect::to('admin');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
	}

	/**
	 * 每天店铺信息统计
	 */
	public function heji(){
		$shop = Input::get('shop');
		$start_date = Input::get('dtp_input1');
		$end_date = Input::get('dtp_input2');
		
	//	$allBooks = Book::paginate(8);
		$where = '';
		if($shop != 'all' && $shop != ''){
			$where .= ' `shop` = "' . $shop . '"';
			if($start_date != '' && $end_date != ''){
				$where .= ' and `come_date` between "' . $start_date . '" and "' . $end_date .'"';
			}
		}else{
			if($start_date != '' && $end_date != ''){
				$where .= ' `come_date` between "'. $start_date . '" and "' . $end_date . '"';
			}else{
				$where .= ' `come_date` between "' .date('Y-m-d',time() - 3600*24*7) . '" and "' . date('Y-m-d') .'"';
			}
		}
		//echo $where;
		//echo date('Y-m-d',time() - 3600*24*3);
		//print_r(Input::all());
		
		//使view里面old函数可以获得旧数据
		Input::flash();
		
		$results = \DB::select("select f.come_date2,f.`shop`,f.allbook,f.allcome,f.xiaofei,GROUP_CONCAT(CONCAT(g.`come_product`, ',', g.product) order by g.product desc SEPARATOR '|') as all_pro from (SELECT `shop`, date_format(`come_date`,'%Y-%m-%d') AS come_date2,count(`shop`) as allbook,sum(`status` = '1') as allcome,sum(`is_xiaofei` = '1') as xiaofei FROM `books` where ". $where ." group by come_date2,`shop` order by come_date2 asc,allbook desc) f 
								join 
								(SELECT `shop`,`come_product`, date_format(`come_date`,'%Y-%m-%d') AS come_date2,count(`come_product`) as product FROM `books` WHERE " . $where . " group by come_date2,`shop`,`come_product` order by come_date2,`shop`, product desc) g
								on g.`shop` = f.`shop` and g.come_date2 = f.come_date2 group by f.`shop`,f.come_date2 order by f.come_date2
								");
	//echo '<pre>';	print_r($results);
		return view('admin.books.heji')->withBooks($results);
	}

	/**
	 * 店铺预约商品数量对比
	 */
	public function compare(){
		$shop = Input::get('shop');
		$start_date = Input::get('dtp_input1');
		$end_date = Input::get('dtp_input2');
		//print_r($shop);
		
		$where = '';
		if(isset($shop) && $shop[0] != 'all'){
			$where .= ' where `shop` in ( "' . implode('","',$shop) . '") ';
			if($start_date != '' && $end_date != ''){
				$where .= ' and `come_date` between "' . $start_date . '" and "' . $end_date .'"';
			}
		}else{
			if($start_date != '' && $end_date != ''){
				$where .= ' where `come_date` between "'. $start_date . '" and "' . $end_date . '"';
			}else{
				$where .= ' where `come_date` between "' .date('Y-m-d',time() - 3600*24*30) . '" and "' . date('Y-m-d') .'"';
			}
		}
		//echo $where;
		//echo date('Y-m-d',time() - 3600*24*3);
		//print_r(Input::all());
		
		//使view里面old函数可以获得旧数据
		Input::flash();
		
		$results = \DB::select("
								select `come_product`,GROUP_CONCAT(CONCAT(f.`shop`, ',', f.one_count) order by f.one_count desc SEPARATOR '|') as all_shop from 
								(SELECT `come_product`,`shop`,count(`come_product`) as one_count FROM `books` ".$where." group by `come_product`,`shop` order by one_count desc) f 
								group by `come_product` order by f.one_count desc
								");
	//echo '<pre>';	print_r($results);
		return view('admin.books.compare')->withBooks($results);
	}


	/**
	 * 店铺预约商品数量对比
	 */
	public function chart(){
		$shop = Input::get('shop');
		$start_date = Input::get('dtp_input1');
		$end_date = Input::get('dtp_input2');
		//print_r($shop);
		
		$where = '';
		if(isset($shop) && $shop != ''){
			$where .= ' where `shop` = "' . $shop . '" ';
		}else{
			$where .= ' where `shop` = "shoptest" ';
		}
		if($start_date != '' && $end_date != ''){
			$where .= ' and `come_date` between "'. $start_date . '" and "' . $end_date . '"';
		}else{
			$where .= ' and `come_date` between "' .date('Y-m-d',time() - 3600*24*10) . '" and "' . date('Y-m-d') .'"';
			$start_date = date('Y-m-d',time()-3600*24*10);
			$end_date = date('Y-m-d');
		}
		//echo $where;
		//echo date('Y-m-d',time() - 3600*24*3);
		//print_r(Input::all());
		
		//使view里面old函数可以获得旧数据
		Input::flash();
		
		$chart_data = array();
		while (strtotime($start_date) <= strtotime($end_date)){
        	$chart_data['labels'][] = $start_date;
        	$start_date = date('Y-m-d',strtotime($start_date) + 3600*24);
    	}
    	//echo '<pre>';
    	//print_r($chart_data);
		
		$results = \DB::select("select f.come_time, group_concat(f.day_num order by f.come_date2 SEPARATOR '|') as count_date from 
							(SELECT come_time, date_format(`come_date`,'%Y-%m-%d') AS come_date2, count(`shop`) as day_num FROM `books` ". $where ." group by come_date2,come_time) f 
							group by f.come_time"
							);
		//echo '<pre>';print_r($results);
		
		foreach($results as $k=>$v){ 
		//echo $k;
			if($k % 5 == 0){
				$chart_data['datasets'][] = array(
					'sname' => $v->come_time,
					'fillColor' => "rgba(128,128,0,0.1)",
					'strokeColor' => "rgba(128,128,0,1)",
					'pointColor' => "rgba(128,128,0,1)",
					'pointStrokeColor' => "#fff",
					'data' => explode('|',$v->count_date)
				);
			}elseif($k % 4 == 0){
				$chart_data['datasets'][] = array(
					'sname' => $v->come_time,
					'fillColor' => "rgba(255,128,0,0.1)",
					'strokeColor' => "rgba(255,128,0,1)",
					'pointColor' => "rgba(255,128,0,1)",
					'pointStrokeColor' => "#fff",
					'data' => explode('|',$v->count_date)
				);
			}elseif($k % 3 == 0){
				$chart_data['datasets'][] = array(
					'sname' => $v->come_time,
					'fillColor' => "rgba(128,0,0,0.1)",
					'strokeColor' => "rgba(128,0,0,1)",
					'pointColor' => "rgba(128,0,0,1)",
					'pointStrokeColor' => "#fff",
					'data' => explode('|',$v->count_date)
				);
			}elseif($k % 2 == 0){
				$chart_data['datasets'][] = array(
					'sname' => $v->come_time,
					'fillColor' => "rgba(0,128,0,0.1)",
					'strokeColor' => "rgba(0,128,0,1)",
					'pointColor' => "rgba(0,128,0,1)",
					'pointStrokeColor' => "#fff",
					'data' => explode('|',$v->count_date)
				);
			}elseif($k % 1 == 0){
				$chart_data['datasets'][] = array(
					'sname' => $v->come_time,
					'fillColor' => "rgba(128,255,0,0.1)",
					'strokeColor' => "rgba(128,255,0,1)",
					'pointColor' => "rgba(128,255,0,1)",
					'pointStrokeColor' => "#fff",
					'data' => explode('|',$v->count_date)
				);
			}else{
				$chart_data['datasets'][] = array(
					'sname' => $v->come_time,
					'fillColor' => "rgba(128,0,64,0.1)",
					'strokeColor' => "rgba(128,0,64,1)",
					'pointColor' => "rgba(128,0,64,1)",
					'pointStrokeColor' => "#fff",
					'data' => explode('|',$v->count_date)
				);
			}
		}
		
		/*
		foreach(\Config::get('constants.SHIDUAN') as $k=>$v){
			$chart_data['datasets'][] = array(
				'fillColor' => "rgba(220,220,220,0.5)",
				'fillColor' => "rgba(220,220,220,0.5)",
				'strokeColor' => "rgba(220,220,220,1)",
				'pointColor' => "rgba(220,220,220,1)",
				'pointStrokeColor' => "#fff",
				'data' => explode('|',$results[$k]->count_date)
			);
		}
		*/
		//echo '<pre>';print_r($chart_data);
		
		//echo '<pre>';	print_r(json_encode($chart_data));
		return view('admin.books.chart')->withBooks(json_encode($chart_data));
	}
	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$book = Book::find($id);
		$book->delete();

		return Redirect::to('admin');
	}

}

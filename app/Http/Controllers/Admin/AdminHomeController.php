<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Book;
use Redirect, Input, Auth;

class AdminHomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shop = Input::get('shop');
		$start_date = Input::get('dtp_input1');
		$end_date = Input::get('dtp_input2');
		$status = Input::get('status');
		
	//	$allBooks = Book::paginate(8);
		$where = array();
		if($shop != 'all' && $shop != ''){
			$where['shop'] = $shop;
		}
		if($status != 'all' && $status != ''){
			$where['status'] = $status;
		}
		//print_r(Input::all());
		//使view里面old函数可以获得旧数据
		Input::flash();
		
		if(trim($start_date) != '' && trim($end_date) != ''){
			$allBooks = Book::where($where)->whereBetween('come_date', [$start_date, $end_date])->orderBy('come_date', 'desc')->paginate(50);
		}else{
			$allBooks = Book::where($where)->orderBy('come_date', 'desc')->paginate(50);
		}
		//echo '<pre>';print_r($where);
		
		
		return view('AdminHome')->withBooks($allBooks);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

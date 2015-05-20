<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Product;
use Redirect, Input, Auth;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::all();
		return view('admin.products.index')->withProducts($products);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:products',
		]);

		$product = new Product;
		$product->name = Input::get('name');
		$product->display_name = Input::get('display_name');
		$product->description = Input::get('description');

		if ($product->save()) {
			return Redirect::to('admin/products');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
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
		return view('admin.products.edit')->with('products',Product::find($id));
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
			'name' => 'required|unique:products,name,'.$id,
		]);

		$product = Product::find($id);
		$product->name = Input::get('name');
		$product->display_name = Input::get('display_name');
		$product->description = Input::get('description');

		if ($product->save()) {
			//删除老的权限
			return Redirect::to('admin/products');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
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

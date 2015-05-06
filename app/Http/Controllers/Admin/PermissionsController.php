<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Permission;
use Redirect, Input, Auth;

class PermissionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.permissions.index')->withPermissions(Permission::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.permissions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:permissions',
		]);

		$permission = new Permission;
		$permission->name = Input::get('name');
		$permission->display_name = Input::get('display_name');
		$permission->description = Input::get('description');

		if ($permission->save()) {
			return Redirect::to('admin/permissions');
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
		return view('admin.permissions.edit')->withPermission(Permission::find($id));
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
			'name' => 'required|unique:permissions,name,'.$id,
		]);

		$permission = Permission::find($id);
		$permission->name = Input::get('name');
		$permission->display_name = Input::get('display_name');
		$permission->description = Input::get('description');

		if ($permission->save()) {
			return Redirect::to('admin/permissions');
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
		$permission = Permission::find($id);
		$permission->delete();

		return Redirect::to('admin/permissions');
	}

}

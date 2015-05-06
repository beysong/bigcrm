<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Role;
use App\Permission;
use Redirect, Input, Auth;

class RolesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.roles.index')->withRoles(Role::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.roles.create')->withPermissions(Permission::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:roles',
		]);

		$role = new Role;
		$role->name = Input::get('name');
		$role->display_name = Input::get('display_name');
		$role->description = Input::get('description');
		$permissios = Permission::whereIn('name',Input::get('permissions'))->get();
//echo '<pre>';
//print_r($permissios);

		if ($role->save()) {
			foreach($permissios as $k=>$v){
				$role->attachPermission($v);
			}
			return Redirect::to('admin/roles');
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
		$permission_name = array();
		foreach(Role::find($id)->permissions->toArray() as $k=>$v){
			//print_r($v);
			$permission_name[] = $v['name'];
		}
		
		$permissions['now'] = $permission_name;
		$permissions['all'] = Permission::all()->toArray();
		$permissions['role'] = Role::find($id);
		return view('admin.roles.edit')->with('permissions',$permissions);
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
			'name' => 'required|unique:roles,name,'.$id,
		]);

		$role = Role::find($id);
		if($role->name != Input::get('name')){
			$role->name = Input::get('name');
		}
		
		$role->display_name = Input::get('display_name');
		$role->description = Input::get('description');
		$permissios = Permission::whereIn('name',Input::get('permissions'))->get();

		if ($role->save()) {
			//删除老的权限
			$role->perms()->sync([]);
			foreach($permissios as $k=>$v){
				$role->attachPermission($v);
			}
			return Redirect::to('admin/roles');
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
		$role = Role::find($id);
		$role->delete();

		return Redirect::to('admin/roles');
	}

}

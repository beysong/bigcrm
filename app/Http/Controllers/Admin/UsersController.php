<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use Redirect, Input, Auth;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.users.index')->withUsers(User::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create')->withRoles(Role::all());
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
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);

		$user = new User;
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->password = \Hash::make(Input::get('password'));
		//获取角色实例
		$roles = Role::where('name',Input::get('role'))->get();
		
		if ($user->save()) {
			foreach($roles as $k=>$v){
				$user->attachRole($v);
			}
			return Redirect::to('admin/users');
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
		
		$user_role = array();
		foreach(User::find($id)->roles->toArray() as $k=>$v){
			//print_r($v);
			$user_role[] = $v['name'];
		}
	//	print_r($user_role);
		$roles['now'] = $user_role;
		$roles['all'] = Role::all()->toArray();
		$roles['user'] = User::find($id);
		
		
		return view('admin.users.edit')->withRoles($roles);
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
			'email' => 'required|email|max:255|unique:users,email,'.$id,
			'password' => 'confirmed|min:6',
		]);

		$user = User::find($id);
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		if(!empty(Input::get('password')) && !empty(Input::get('password_confirmation'))){
			$user->password = \Hash::make(Input::get('password'));
		}
		$roles = Role::where('name',Input::get('role'))->get();

		if ($user->save()) {
			foreach($roles as $k=>$v){
				//先删除老的角色
				$user->detachAllRoles();
				//$v->users()->sync([]);
				$user->attachRole($v);
			}
			return Redirect::to('admin/users');
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
		$user = User::find($id);
		$user->delete();

		return Redirect::to('admin/users');
	}

}

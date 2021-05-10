<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JsValidator;
use Carbon\Carbon;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->get('filters');
        $per_page = 10;

        $records = resolve('users')->getListing($filters, true, $per_page);
        $filters['filters'] = $filters;
        $records->appends($filters);

      //  dd($records);
        $user_roles = \App\Models\MasterRoles::get()->pluck('title','id');

        if($request->ajax()){
            return view('admin.user.ajax.list', [
                'records' => $records,
                'user_roles' => $user_roles
            ]);
        }
        return view('admin.user.list', ['user_roles' => $user_roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            $user = \Auth::user();
            $data = [
                'role_id' => $request->get('role_id'),
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'email' => $request->get('email'),
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password')),
                'created_at' => Carbon::now(),
                'created_by' => $user->id
            ];

            User::insert($data);
            return response()->json(['status' => 'success', 'message' => 'User added successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $rules = [
                'role_id' => 'required',
                'name' => 'required',
                'username' => 'required|unique:users,username,'.$id.'|min:3',
                'mobile' => 'required|numeric|digits:10|unique:users,mobile,'.$id,
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'sometimes|min:6',
                'password_confirmation' => 'required_with:password|same:password',
            ];
            $custom_messages = [];
            $custom_attribute = ['role_id' => 'role'];
            $validator = JsValidator::make($rules,$custom_messages,$custom_attribute,'#edit-user-form');

            $record = User::with('role')->where('id', $id)->first();
            $user_roles = \App\Models\MasterRoles::get()->pluck('title','id');

            return view('admin.user.ajax.edit-modal', [
                'record' => $record,
                'user_roles' => $user_roles,
                'validator' => $validator
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try{
            $user = \Auth::user();
            $data = [
                // 'role_id' => $request->get('role_id'),
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'email' => $request->get('email'),
                'is_active' => $request->get('is_active'),
                'username' => $request->get('username'),
                'updated_at' => Carbon::now(),
                'updated_by' => $user->id
            ];
            if($request->has('password') && $request->get('password') != ''){
                $data['password'] = Hash::make($request->get('password'));
            }

            User::where('id', $id)->update($data);
            return response()->json(['status' => 'success', 'message' => 'User updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id)->forceDelete();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }
}

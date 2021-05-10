<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use App\User;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use JsValidator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for update user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUpdateProfile()
    {
        try{
            $user = \Auth::user();
            $rules = [
                'name' => 'required',
                'username' => 'required|unique:users,username,'.$user->id.'|min:3',
                'mobile' => 'required|numeric|digits:10|unique:users,mobile,'.$user->id,
                'email' => 'required|email|unique:users,email,'.$user->id,
            ];

            $custom_messages = [];
            $custom_attribute = [];
            $validator = JsValidator::make($rules,$custom_messages,$custom_attribute,'#update-profile-form');

            $record = User::with('role')->where('id', $user->id)->first();
            $user_roles = \App\Models\MasterRoles::get()->pluck('title','id');

            return view('admin.user.ajax.edit-modal', [
                'record' => $record,
                'user_roles' => $user_roles,
                'validator' => $validator
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'danger')->with('message', __('messages.Something went wrong, please try again.'));
        }
    }

    /**
     * Update profile.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function SaveUpdateProfile(UpdateProfileRequest $request)
    {
        try{
            $user = \Auth::user();
            $data = [
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'email' => $request->get('email'),
                'username' => $request->get('username'),
                'updated_at' => Carbon::now(),
                'updated_by' => $user->id
            ];

            User::where('id', $user->id)->update($data);
            return redirect('/')->with('status', 'success')->with('message', __('messages.Profile has updated successfully.'));

        } catch (\Exception $e) {
            return redirect('/')->with('status', 'danger')->with('message', __('messages.Something went wrong, please try again.'));
        }
    }

    /**
     * Change Password.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try{
            $user = \Auth::user();

            User::where('id', $user->id)->update(['password'=> Hash::make($request->get('password'))]);
            
            return redirect('/')->with('status', 'success')->with('message', __('messages.Password has changed successfully.'));

        } catch (\Exception $e) {
            return redirect('/')->with('status', 'danger')->with('message', __('messages.Something went wrong, please try again.'));
        }
    }
}

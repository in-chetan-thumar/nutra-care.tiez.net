<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use App\User;
use App\Models\ApiLogs;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use JsValidator, Auth;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function generateApiLog($request){

        $apiLog = new ApiLogs();
        $user = Auth::user();

        $apiLog->user_id = isset($user->id) ? $user->id : 0;
        $apiLog->action = $request->get('action', '');
        $apiLog->url = $request->path() ?? '';
        $apiLog->method = $request->method() ?? '';
        $apiLog->request = json_encode($request->all());
        $apiLog->ip_address = $_SERVER['REMOTE_ADDR'];
        $apiLog->machine_details = $request->header('User-Agent');
        $apiLog->start_date = date("Y-m-d h:i:s");
        $apiLog->save();

        return $apiLog->id;
    }

    public function updateApiLog($id, $params) {
        $apiLog = ApiLogs::whereId($id)->first();

        if (is_array($params)) {
            foreach ($params as $column => $value) {
                $apiLog->$column = is_array($value) ? json_encode($value) : $value;
            }
        }
        $apiLog->end_date = date("Y-m-d h:i:s");
        $apiLog->save();
    }

    
}

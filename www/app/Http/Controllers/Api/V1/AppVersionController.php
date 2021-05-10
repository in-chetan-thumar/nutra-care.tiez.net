<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AppVersionController extends Controller {

    /**
     * set Application API version
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function appversioncheck(Request $request){
        try {            
            $data['android_version'] = ['V1'];
            $data['ios_version'] = ['V1'];
            return response()->json(["status" => "success", "data" => $data], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", 'message' => $e->getMessage()],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }  

}

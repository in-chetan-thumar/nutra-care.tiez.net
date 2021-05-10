<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use App\Models\PushMessages;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class NotificationController extends Controller {

    protected $response;
    protected $response_code;

    /**
     * [__construct description]
     * @param Application $app [description]
     */
    public function __construct(Application $app) {
        $this->response = ['status' => 'fail'];
        $this->response_code = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    /*
     * List of notifications
     */
    public function list(Request $request){
        try{
            $api_log_id = $this->generateApiLog($request);
            $skip = $request->get('skip', 0);
            $take = 15;

            $user = Auth::user();

            $notification_list = PushMessages::where('user_id',$user->id)->where('success',1)->orderBy('is_read', 'DESC')->orderBy('created_at', 'DESC')->skip($take*$skip)->take($take)->get();

            $notifications = [];
            foreach ($notification_list as $notification) {
                $notifications[] = [
					'message_text' => $notification->message_text,
					'age' => $notification->created_at->diffForHumans(),
                    'is_read' => $notification->is_read,
				];
                if($notification->is_read == 'N'){
                    $notification->is_read = 'Y';
                    $notification->save();
                }
            }

            // Get dashboard data
            $dashboard_response = app('App\Http\Controllers\Api\V1\ComplianceCheckListController')->getDashboardData();
            $this->response['data'] = [
                'notifications' => $notifications,
                'unread_notification' => PushMessages::where('user_id',$user->id)->where('is_read', "N")->where('success',1)->count(),
                'dashboard_data' => $dashboard_response['data']
            ];
            $this->response_code = Response::HTTP_OK;
            $this->response['status'] = 'success';
        } catch (\Exception $e) {
            $this->response['status'] = 'fail';
        	$this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];
        $this->updateApiLog($api_log_id, $params);
        return response()->json($this->response, $this->response_code);
    }
}

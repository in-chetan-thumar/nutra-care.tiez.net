<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\User;
use App\Models\UserDetails;

use App\Http\Requests\Api\V1\RegisterRequest;
use App\Events\FcmEvent;
use Carbon\Carbon;

class RegisterController extends Controller {

    protected $auth;
    protected $db;
    protected $client;
    protected $response;
    protected $response_code;

    /**
     * [__construct description]
     * @param Application $app [description]
     */
    public function __construct(Application $app) {
        $this->auth = $app->make('auth');
        $this->db = $app->make('db');
        $this->client = new Client(['verify' => false]);
        $this->response = ['status' => 'fail'];
        $this->response_code = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    /**
     * [Login with Password]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(RegisterRequest $request){
        try {
            \DB::beginTransaction();
            $api_log_id = $this->generateApiLog($request);

            $username = $request->get('username', '');
            $name = $request->get('name', '');
            $email = $request->get('email', '');
            $mobile = $request->get('mobile', '');
            $password = $request->get('password', '');


            $user = new User();
            $user->name = $name;
            $user->mobile = $mobile;
            $user->email = $email;
            $user->username = $username;
            $user->password = bcrypt($password);
            $user->role_id = config('constants.APP_USER_ROLE_ID');
            $user->created_at = Carbon::now();
            $user->created_by = 0;
            $user->save();

            
            $this->response_code = Response::HTTP_OK;
            $this->response['status'] = 'success';
            $this->response['data'] = "";
            $this->response['message'] = "Your account created successfully, Please proceed to the login page.";
        

            \DB::commit();

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            \DB::rollback();
            $this->response['message'] = $e->getResponse()->getBody();
        } catch (\Exception $e) {
            \DB::rollback();
            $this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];
        $this->updateApiLog($api_log_id, $params);
        return response()->json($this->response, $this->response_code);
    }


    public function checkPushMessage(Request $request){
        try {

            $device_token = $request->get('device_token');
            $click_action = $request->get('click_action', "DASHBOARD");
            $push_msg_params = [
                'device_token' => $device_token, //'c02S0voqw0PFprgTzfhXZS:APA91bFHsrL0nz71L6mPyLkUjndv9Zy2rndhBtmaY_feCJXaQA_ftGheB1DpSbfmkyL2AsRtK4BD_JzHCmGFSPhEqOBVmaT6nDustXuO-lMNcwJZefaXxWk2tYYe35W0ZkpfM5LOZ67g',
                'message' => "Hey, You got new message from Care N Compliance ",
                'push_message_type' => 'AUTO',
                'url' => '',
                'user_id' => 1,
                'click_action' => $click_action
            ];
            event(new FcmEvent($push_msg_params));

            $message = PushMessages::where('user_id', 1)->orderBy('id', 'desc')->first();

            $this->response_code = Response::HTTP_OK;
            $this->response['status'] = 'success';
            $this->response['data'] = $message->response;
            $this->response['message'] = "Message successfully sent";

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            $this->response['message'] = $e->getResponse()->getBody();
        } catch (\Exception $e) {

            $this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];

        return response()->json($this->response, $this->response_code);
    }
}

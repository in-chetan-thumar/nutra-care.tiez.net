<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\UserDeviceDetails;
use App\Models\UserAccessToken;

use App\Http\Requests\Api\V1\LoginWithPasswordRequest;
use App\Http\Requests\Api\V1\LogoutRequest;

use Carbon\Carbon;

class LoginController extends Controller {

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
    public function loginWithPassword(LoginWithPasswordRequest $request){
        try {
            
            $api_log_id = $this->generateApiLog($request);
            
            $username = $request->get('username');
            $login_params= [];
            //$login_params['client_id'] = $request->get('client_id');
            //$login_params['client_secret'] = $request->get('client_secret');
            //$login_params['grant_type'] = $request->get('grant_type');
            //$login_params['scope'] = $request->get('scope');

            $login_params['username'] = $username;
            $login_params['password'] = $request->get('password');

            $login_params['device_token'] = $request->get('device_token', '');
            $login_params['device_platform'] = $request->get('device_platform', '');
            $login_params['device_version'] = $request->get('device_version', '');
            $login_params['device_model'] = $request->get('device_model', '');

            $login_params['last_login_ip'] = $request->ip();
            $login_from = $request->get('login_from', '');
            $login_params['token'] = $request->get('_token');
            //$role_code['role_code'] = $request->get('role_code', '');

            $user = user::where('username', $username)->first();
            
            if ($user) {
                if ($user->is_active == 'Y') {
                    $credentials = $request->only('username', 'password');
                    $login_response = Auth::attempt($credentials);
                    if($login_response){

                        // Update last lgogin
                        $user = User::where('username', $login_params['username'])->where('is_active', 'Y')->first();
                        $user->last_login_at = date('Y-m-d H:i:s');
                        $user->last_login_ip = $login_params['last_login_ip'];
                        $user->updated_by = $user->id;
                        $user->updated_at = date('Y-m-d H:i:s');
                        $user->save();
                        $user->increment('logins');                        
                        
                        // Update access_token
                        $access_token = str_random(100);
                        $user_access_token = new UserAccessToken();
                        $user_access_token->access_token = $access_token;
                        $user_access_token->user_id = $user->id;
                        $user_access_token->save();

                        // Update user device details) {
                        $primary_data = [ 'user_id' => $user->id];
                        $secondary_data = [
                            "device_token" => $login_params['device_token'],
                            "device_platform" => $login_params['device_platform'],
                            "device_version" => $login_params['device_version'],
                            "device_model" => $login_params['device_model'],
                            "updated_by" => $user->id,
                            "updated_at" => date('Y-m-d H:i:s'),
                        ];
                        UserDeviceDetails::updateOrCreate($primary_data, $secondary_data);

                        $this->response['data']['access_token'] = $access_token;
                        $this->response['status'] = 'success';
                        $this->response_code = Response::HTTP_OK;
                    }else{
                        $this->response['message'] = "The user credentials were incorrect";
                    }
                }else {
                    $this->response['message'] = 'You must be active to login';
                }
            } else {
                $this->response['message'] = 'User does not exist';
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $this->response['message'] = $e->getResponse()->getBody();
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];
        $this->updateApiLog($api_log_id, $params);
        return response()->json($this->response, $this->response_code);
    }

    /**
     * [Logout]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(logoutRequest $request){
        try {
            
            $api_log_id = $this->generateApiLog($request);
            
            $access_token = $request->get('access_token');

            $access_token_obj = UserAccessToken::where('access_token', $access_token)->first();
            
            if (!empty($access_token_obj)) {
                $access_token_obj->forceDelete();

                $this->response['data'] = [];
                $this->response['status'] = 'success';
                $this->response['message'] = "You have successfully loggedout.";
                $this->response_code = Response::HTTP_OK;
            } else {
                $this->response['message'] = 'Invalid of access token';
            }
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage();
        }

        $params = ['status_code' => $this->response_code, 'response' => $this->response];
        $this->updateApiLog($api_log_id, $params);
        return response()->json($this->response, $this->response_code);
    }
    
}

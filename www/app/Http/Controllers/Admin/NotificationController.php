<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JsValidator;
use Carbon\Carbon;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;

use File, Storage;

use App\Events\FcmEvent;

class NotificationController extends Controller
{
    public function new(Request $request)
    {
        return view('admin.notification.notification-new');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $message ="Test";
        $android_msg = [
            'body' => $message,
            'message' => $message,
            'title' => config('app.name'),
            'content-available' => 1,
            "image" => "www/assets/imgs/lcon.png",
            "sound" => "default",
            "badge" => 1,
            //"type" => $click_action,
            //"click_action" => "/#/question",
			//"click_action" => "FCM_PLUGIN_ACTIVITY",
        ];


        $response = fcm()
                        //->to([$device_token])
                        //->to(["deIPmIga60twlX56XdpKts:APA91bF21cgRIZwNWBaxhqW_ezdGy_zdLdkVyp6L6USgHLfK8F5ns-nuVG8MRYxltgUJdpy4Huc5Sqo5z-1xb3-GhYbgKuSrc1Lg7QqH6AMLrS2XQtQ46SDxJy8PUajpNAm-ZwMvjdes"])
						->toTopic("tollynews") // $topic must an string (topic name)
                        ->notification($android_msg)
                        ->data($android_msg)
                        ->send();
//dd($response);
        $filters = $request->get('filters');
        $per_page = 10;
        $records = resolve('notification')->getListing($filters, true, $per_page);

        if($request->ajax()){
            return view('admin.notification.ajax.list', [
                'records' => $records
            ]);
        }
        return view('admin.notification.list');
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
    public function store(NotificationRequest $request)
    {
        try{
            $filename = "";
            if($request->hasFile('notification_doc')) {
                $fileDir = config('constants.NOTIFICATION_PHOTO');
                if (!File::exists($fileDir)){
                    Storage::makeDirectory($fileDir,0777);
                }

                $filename = basename($request->file('notification_doc')->store($fileDir));
            }
            $user = \Auth::user();
            /*$data = [
                'notification_text' => $request->get('notification_text'),
                'notification_doc' => $filename,
                'created_at' => Carbon::now(),
                'created_by' => $user->id
            ];

            Notification::insert($data);*/
			$notification = new Notification();
			$notification->notification_text = $request->get('notification_text');
			$notification->notification_doc = $filename;
			$notification->created_at = Carbon::now();
			$notification->created_by = $user->id;
			$notification->save();

			$push_msg_params = [
								'device_token' => '',
								'message' => $notification->notification_text,
								'push_message_type' => 'AUTO',
								'url' => '',
								'user_id' => '',
								'click_action' => "DASHBOARD",
								'notification_id' => $notification->id
							];
							event(new FcmEvent($push_msg_params));
            return response()->json(['status' => 'success', 'message' => 'Notification sent successfully.']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.'. "\n Error: " . $e->getMessage() . "\n Line:" . $e->getLine()]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

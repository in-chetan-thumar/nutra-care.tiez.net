<?php

namespace App\Listeners;

use App\Events\FcmEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Notification;

class FcmSendPushMessage
{
    public function __construct()
    {
        //
    }

    public function handle(FcmEvent $event)
    {
        $android_msg = $ios_msg = [];
        $device_token = $event->params['device_token'];
        $message = $event->params['message'];
        $push_type = $event->params['push_message_type'];
        $url = isset($event->params['url']) ? $event->params['url'] : '';
        $click_action = isset($event->params['click_action']) ? $event->params['click_action'] : "DASHBOARD";

        $android_msg = [
            'body' => $message,
            'message' => $message,
            'title' => config('app.name'),
            'content-available' => 1,
            "image" => "www/assets/imgs/lcon.png",
            "sound" => "default",
            "badge" => 1,
            "type" => $click_action,
            //"click_action" => "/#/question",
			//"click_action" => "FCM_PLUGIN_ACTIVITY",
        ];


        $response = fcm()
						//->to([$device_token])
						->toTopic("tollynews") // $topic must an string (topic name)
                        ->notification($android_msg)
                        ->data($android_msg)
                        ->send();
						
		$notification = Notification::find($event->params['notification_id']);
		$notification->success = !empty($response['message_id']) ? "1" : "0";
		$notification->response = $response['message_id'];
		$notification->save();
    }
}

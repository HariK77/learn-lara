<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\WebhookServer\WebhookCall;

class WebHookController extends Controller
{
    public function index()
    {
        // dd('hi');
        // dd(env('WEBHOOK_CLIENT_SECRET'));

        $payload = [
            "event_id" => "3a3f3da4-14ac-4056-bbf2-d0b9cdcb0777",
            "event_time" => 1427343990,
            "event_type" => "guests.trips.status_changed",
            "meta" => [
                "user_id" => "d13dff8b-das-asd-1212e",
                "resource_id" => "5152dcc5-b88d-4754-8b33-975f4067c943",
                "status" => "accepted"
            ],
            "resource_href" => "https://api.uber.com/v1/guests/trips/5152dcc5-b88d-4754-8b33-975f4067c943"
        ];

        $result = WebhookCall::create()
        ->url('https://eurecab.local/uber-webhook')
        ->payload($payload)
        ->useSecret(env('UBER_API_CLIENT_SECRET'))
        ->dispatch();

        dd($result, "Web Hook has been called");
    }
}

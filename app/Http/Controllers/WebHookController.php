<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\WebhookServer\WebhookCall;

class WebHookController extends Controller
{
    public function index()
    {
        $payload = [
            "id" => 1,
            "event_type" => "user Added"
        ];

        $result = WebhookCall::create()
        ->url(env('WEBHOOK_URL').'/webhook-receiver')
        ->payload($payload)
        ->useSecret(env('WEBHOOK_CLIENT_SECRET'))
        ->dispatch();

        dd($result, "Web Hook has been called");
    }
}

<?php

namespace App\Console\Commands;

use App\Notifications\SlackNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendSlackNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slack:send_notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send slack nofocation to test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('Sending Notification');
        Notification::route('slack', env('SLACK_WEBHOOK_URL'))
            ->notify(new SlackNotification());

        $this->line('Notification sent successfully');
    }
}

<?php

namespace App\Jobs\StripeWebHooks;

use App\Models\Package;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class CustomerSubscriptionDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $charge = $this->webhookCall->payload['data']['object'];
        $user =  User::where('stripe_id', $charge['customer'])->first();

        if ($user && isset($user->subscriptions()->active()->latest()->first()->stripe_status)) {
            if ($user->subscriptions()->active()->latest()->first()->stripe_status === 'active') {
                $userSubscription =  $user->subscriptions()->active()->latest()->first();

                $userSubscription->stripe_status = 'canceled';
                $userSubscription->save();
                $user->package_id =  1;
                $user->package_interval =  'monthly';
                $user->save();
            }
        }
    }
}

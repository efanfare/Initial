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

class CustomerSubscriptionUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        $charge = $this->webhookCall->payload['data']['object'];
        $priceId =    $charge['items']['data'][0]['plan']['id'];
        $user =  User::where('stripe_id', $charge['customer'])->first();

        if ($user) {
            $userSubscription =  $user->subscriptions()->active()->latest()->first();
            $packageMonthly = Package::where('stripe_plan_monthly', $priceId)->first();
            $packageYearly = Package::where('stripe_plan_yearly', $priceId)->first();
            if ($userSubscription->stripe_price !== $priceId) {
                $user->subscription($userSubscription->name)->swapAndInvoice($priceId);
            }

            if ($packageMonthly) {
                $user->package_id =  $packageMonthly->id;
                $user->package_interval =  'monthly';
            } else {
                $user->package_id =  $packageYearly->id;
                $user->package_interval =  'yearly';
            }
            $user->save();

            return false;
        }
    }
}

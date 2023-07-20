<?php

namespace App\Listeners;

use App\Models\User;
use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

   
    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
           
        }

      

        // $user =  User::where('stripe_id', 'cus_Ncv7AXji144zlZ')->first();
        // $user->subscription('Regular')->cancelNow();
    }
}

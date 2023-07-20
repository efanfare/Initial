<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{

    public function index(Request $request)
    {
        $packages = Package::get();
        $invoices = $request->user()->invoices();
        $user = $request->user();

        return view("user.subscriptions.plan", compact("user", "packages", "invoices"));
    }


    public function show(Package $package, Request $request)
    {

        if (!$package) {
            abort(403);
        }
        $user = $request->user();

        $userSubscription =  $user->subscriptions()->active()->latest()->first();

        if ($request->interval  === 'monthly') {
            $name = $package->package_name;
            $stripePlan = $package->stripe_plan_monthly;
        } else {
            $name = $package->package_name;
            $stripePlan = $package->stripe_plan_yearly;
        }

        if (isset($userSubscription) &&  $user->subscriptions()->active()->latest()->first()->stripe_status === 'active') {

            $user->subscription($userSubscription->name)->swapAndInvoice($stripePlan);
            $user = $request->user();
            $user->package_id =  $package->id;
            $user->package_interval =  $request->interval;
            $user->save();
            return redirect()->route('plans.index')->with('message', 'Your subscription updated successfully.');;
        }
        $package->interval = $request->interval;
        $intent =  $user->createSetupIntent();

        return view("user.subscriptions.payment", compact("package", "intent"));
    }

    public function createOrUpdate(Request $request)
    {

        $package = Package::find($request->package);
        if ($request->interval  === 'monthly') {
            $name = $package->package_name;
            $stripePlan = $package->stripe_plan_monthly;
        } else {
            $name = $package->package_name;
            $stripePlan = $package->stripe_plan_yearly;
        }

        $subscription = $request->user()->newSubscription($name,  $stripePlan)
            ->create($request->token);
        $user = $request->user();
        $user->package_id =  $package->id;
        $user->package_interval =  $request->interval;
        $user->save();

        return redirect()->route('plans.index')->with('message', 'Your subscription updated successfully.');;
    }

    public function cancel(Request $request)
    {
        if (isset($request->user()->subscriptions()->active()->latest()->first()->stripe_status) && $request->user()->subscriptions()->active()->latest()->first()->stripe_status === 'active') {
            $user =  $request->user();
            $user->subscription($user->subscriptions()->active()->latest()->first()->name)->cancelNowAndInvoice();
            $user->package_id = Package::BASIC;
            $user->package_interval = Package::MONTHLY;
            $user->save();
            return redirect()->route('plans.index')->with('message', 'Your subscription has been cancelled successfully.');
        }
        return redirect()->route('plans.index')->with('message', 'Your subscription has been cancelled successfully.');
    }
}

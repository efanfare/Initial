<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $packages = Package::get();

        return view("packages.index", compact("packages"));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(Package $package, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();


        return view("packages.subscription", compact("package", "intent"));
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function subscription(Request $request)
    {
       
        $package = Package::find($request->package);

        $subscription = $request->user()->newSubscription($request->package, $package->stripe_package)
            ->create($request->token);

        return view("packages.subscription_success");
    }
}

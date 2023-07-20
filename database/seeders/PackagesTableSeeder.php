<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                "id" => 1,
                "package_name" => "Basic",
                "price_monthly" => 0.0,
                "price_yearly" => 0.0,
                "options" => null,
                "status" => "1",
                "yearly_discount" => 0.0,
                "stripe_plan_monthly" => null,
                "stripe_plan_yearly" => null,
                "scene_limit_monthly" => 3,
                "item_limit_monthly" => 6,
                "scene_limit_yearly" => 3,
                "item_limit_yearly" => 6,
                "google_ads_free" => 0,
                // "description" => "<ul><li>Google ads</li><li>create three scenes limit</li><li>upload six custom items</li><li>Free hand use</li></ul>",
            ],
            [
                "id" => 2,
                "package_name" => "Regular",
                "price_monthly" => 200.0,
                "price_yearly" => 2200.0,
                "options" => null,
                "status" => "1",
                "yearly_discount" => 12.0,
                "stripe_plan_monthly" => "price_1NIBwvAfbheJXQWTf9MPeGaT",
                "stripe_plan_yearly" => "price_1NIC11AfbheJXQWTLpL9DFyk",
                "scene_limit_monthly" => 6,
                "item_limit_monthly" => 12,
                "scene_limit_yearly" => 12,
                "item_limit_yearly" => 24,
                "google_ads_free" => 1,
                // "description" => "<ul><li>Google ads free</li><li>create twenty scenes limit</li><li>upload 20 custom items</li><li>Free hand use</li></ul>",
            ],
            
            [
                "id" => 3,
                "package_name" => "Advance",
                "price_monthly" => 600.0,
                "price_yearly" => 4000.0,
                "options" => null,
                "status" => "1",
                "yearly_discount" => 12.0,
                "stripe_plan_monthly" => "price_1NIC2dAfbheJXQWTIHhKcTED",
                "stripe_plan_yearly" => "price_1NIC3xAfbheJXQWTBjoaWPQn",
                "scene_limit_monthly" => 10,
                "item_limit_monthly" => 20,
                "scene_limit_yearly" => 200,
                "item_limit_yearly" => 500,
                "google_ads_free" => 1,
                // "description" => "<p>No Google ads</p><p>create unlimited scenes limit</p><p>upload unlimited custom items</p><p>Free hand use</p>",
            ]
        ];

        Package::insert($packages);
    }
}

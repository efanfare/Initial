<?php

namespace Database\Seeders;

use App\Models\Scene;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SceneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scenes = [
            [
                'uuid'     => Str::uuid(),
                'title'     => 'Marraige Scene',
                'user_id'  => 2,
                'backgorund_id' => 1,

            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Birthday',
                'user_id' => 3,
                'backgorund_id' => 1,
            ],
        ];

        Scene::insert($scenes);
    }
}

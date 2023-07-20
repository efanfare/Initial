<?php

namespace Database\Seeders;

use App\Models\Background;
use Illuminate\Database\Console\Seeds\WithoutbackgroundEvents;
use Illuminate\Database\Seeder;

class BackgroundTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $background = Background::create([
            'title' => 'Wedding Template',
            'user_id' => 1,
            'service_type' => 'System',
            'price' => 0.00,
            'tags' => json_encode(['tag1', 'tag2']),
        ]);

        $background->addMedia(public_path('images/systembackground/wedding-template.jpg'))
            ->toMediaCollection('background_image');

        $background = Background::create([
            'title' => 'Beach',
            'user_id' => 1,
            'service_type' => 'System',
            'price' => 0.00,
            'tags' => json_encode(['tag1', 'tag2']),
        ]);

        $background->addMedia(public_path('images/systembackground/beach.jpg'))
            ->toMediaCollection('background_image');

        $background = Background::create([
            'title' => 'Happy Birthday',
            'user_id' => 1,
            'service_type' => 'System',
            'price' => 0.00,
            'tags' => json_encode(['tag1', 'tag2']),
        ]);

        $background->addMedia(public_path('images/systembackground/birthday2.jpg'))
            ->toMediaCollection('background_image');

        // $background = Background::create([
        //     'title' => 'Color',
        //     'user_id' => 1,
        //     'service_type' => 'System',
        //     'price' => 0.00,
        //     'tags' => json_encode(['tag1', 'tag2']),
        // ]);

        // $background->addMedia(public_path('images/systembackground/color.jpg'));

        $background = Background::create([
            'title' => 'Protest',
            'user_id' => 1,
            'service_type' => 'System',
            'price' => 0.00,
            'tags' => json_encode(['tag1', 'tag2']),
        ]);

        $background->addMedia(public_path('images/systembackground/protest.jpg'))
            ->toMediaCollection('background_image');
    }
}

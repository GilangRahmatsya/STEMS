<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Canon EOS R5 Camera',
                'description' => 'Professional mirrorless camera with 45MP sensor',
                'rent_price' => 150.00,
                'condition' => 'Excellent',
                'status' => 'Ready',
            ],
            [
                'name' => 'Sony FE 24-70mm Lens',
                'description' => 'Versatile zoom lens for full-frame cameras',
                'rent_price' => 60.00,
                'condition' => 'Excellent',
                'status' => 'Ready',
            ],
            [
                'name' => 'Professional Tripod',
                'description' => 'Heavy-duty tripod with ball head',
                'rent_price' => 25.00,
                'condition' => 'Good',
                'status' => 'Ready',
            ],
            [
                'name' => 'Shure SM7B Microphone',
                'description' => 'Professional cardioid microphone',
                'rent_price' => 45.00,
                'condition' => 'Excellent',
                'status' => 'Ready',
            ],
            [
                'name' => 'Audio Interface 2x4',
                'description' => 'USB audio interface with 2 inputs and 4 outputs',
                'rent_price' => 35.00,
                'condition' => 'Good',
                'status' => 'Ready',
            ],
            [
                'name' => 'LED Ring Light 18"',
                'description' => 'Dimmable LED ring light with stand',
                'rent_price' => 30.00,
                'condition' => 'Excellent',
                'status' => 'Ready',
            ],
            [
                'name' => 'Soft Box Kit',
                'description' => 'Professional 2-light softbox kit with stands',
                'rent_price' => 55.00,
                'condition' => 'Good',
                'status' => 'Ready',
            ],
            [
                'name' => 'DJI Mavic 3 Drone',
                'description' => 'Professional 4K cinema camera drone',
                'rent_price' => 120.00,
                'condition' => 'Excellent',
                'status' => 'Ready',
            ],
            [
                'name' => 'Laptop Stand Aluminum',
                'description' => 'Portable aluminum laptop stand',
                'rent_price' => 20.00,
                'condition' => 'Good',
                'status' => 'Ready',
            ],
            [
                'name' => 'Wireless Keyboard & Mouse',
                'description' => 'Full-size wireless keyboard with mouse',
                'rent_price' => 15.00,
                'condition' => 'Good',
                'status' => 'Ready',
            ],
            [
                'name' => 'Projector 4K',
                'description' => '4K projector with HDMI and wireless connectivity',
                'rent_price' => 80.00,
                'condition' => 'Excellent',
                'status' => 'Ready',
            ],
            [
                'name' => 'Screen Stand 100"',
                'description' => 'Portable projector screen stand',
                'rent_price' => 35.00,
                'condition' => 'Good',
                'status' => 'Ready',
            ],
        ];

        foreach ($items as $item) {
            Item::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}

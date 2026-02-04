<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Camera',
                'description' => 'Professional cameras for photography',
                'icon' => '📷',
                'color' => '#EF4444'
            ],
            [
                'name' => 'Equipments',
                'description' => 'General photography equipment',
                'icon' => '🎥',
                'color' => '#F59E0B'
            ],
            [
                'name' => 'Tools & Support',
                'description' => 'Photography tools and support equipment',
                'icon' => '🔧',
                'color' => '#10B981'
            ],
            [
                'name' => 'Lighting',
                'description' => 'Professional lighting equipment',
                'icon' => '💡',
                'color' => '#3B82F6'
            ],
            [
                'name' => 'Tripod',
                'description' => 'Camera tripods and stands',
                'icon' => '📐',
                'color' => '#8B5CF6'
            ],
            [
                'name' => 'Background',
                'description' => 'Photography backgrounds and backdrops',
                'icon' => '🎨',
                'color' => '#06B6D4'
            ],
            [
                'name' => 'Lens',
                'description' => 'Camera lenses and accessories',
                'icon' => '🔍',
                'color' => '#EC4899'
            ],
            [
                'name' => 'Booth',
                'description' => 'Photobooth equipment and setups',
                'icon' => '📸',
                'color' => '#F97316'
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}

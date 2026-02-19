<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => 'Individual Therapy',
                'icon' => 'bi-person-bounding-box',
                'description' => 'Personalized sessions focused on your self-growth and emotional healing in a safe environment.',
            ],
            [
                'title' => 'Couples & Family',
                'icon' => 'bi-heart-fill',
                'description' => 'Building stronger connections and resolving conflicts through effective communication strategies.',
            ],
            [
                'title' => 'Stress & Anxiety',
                'icon' => 'bi-wind',
                'description' => 'Proven techniques to manage daily pressure and regain control over your peace of mind.',
            ],
            [
                'title' => 'Trauma & Grief',
                'icon' => 'bi-diagram-3-fill',
                'description' => 'Professional support to help you navigate through life\'s most difficult and painful transitions.',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
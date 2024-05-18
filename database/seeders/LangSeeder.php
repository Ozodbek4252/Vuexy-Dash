<?php

namespace Database\Seeders;

use App\Models\Lang;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lang::query()->create([
            'code' => 'en',
            'name' => 'English',
            'icon' => 'images/flags/us.jpg',
            'is_published' => true,
        ]);

        Lang::query()->create([
            'code' => 'uz',
            'name' => 'O\'zbekcha',
            'icon' => 'images/flags/Custom-Icon-Design-All-Country-Flag-Uzbekistan-Flag.256.png',
            'is_published' => true,
        ]);

        Lang::query()->create([
            'code' => 'ru',
            'name' => 'Русский',
            'icon' => 'images/flags/Custom-Icon-Design-All-Country-Flag-Russia-Flag.256.png',
            'is_published' => true,
        ]);
    }
}

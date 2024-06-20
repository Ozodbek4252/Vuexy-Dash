<?php

namespace Database\Seeders;

use App\Models\Lang;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seo = Seo::create([
            'keywords' => 'SEO keywords',
        ]);

        // En Translation for seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'SEO Title en',
            'column_name' => 'title',
        ]);
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'SEO Description en',
            'column_name' => 'description',
        ]);

        // Uz Translation for seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'SEO Sarlavha uz',
            'column_name' => 'title',
        ]);
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'SEO Tavsif uz',
            'column_name' => 'description',
        ]);

        // Ru Translation for seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'SEO Заголовок ru',
            'column_name' => 'title',
        ]);
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'SEO Описание ru',
            'column_name' => 'description',
        ]);
    }
}

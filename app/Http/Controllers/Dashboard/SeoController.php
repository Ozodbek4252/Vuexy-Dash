<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoRequest;
use App\Models\Lang;
use App\Models\Seo;
use App\ViewModels\SEO\SeoViewModel;
use Flasher\Laravel\Facade\Flasher;

class SeoController extends Controller
{
    public function index()
    {
        $seo = Seo::first();
        $seo = new SeoViewModel($seo);
        $langs = Lang::where('is_published', true)->get();

        return view('dashboard.SEO.index', compact('seo', 'langs'));
    }

    public function update(SeoRequest $request, Seo $seo)
    {
        $seo->update(['keywords' => $request->keywords]);
        $seo->refresh();

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            if ($request->input('title_' . $lang->code)) {
                $seo->translations()->updateOrCreate(
                    [
                        'lang_id' => $lang->id,
                        'column_name' => 'title',
                    ],
                    [
                        'content' => $request->input('title_' . $lang->code),
                    ]
                );
            }
            if ($request->input('description_' . $lang->code)) {
                $seo->translations()->updateOrCreate(
                    [
                        'lang_id' => $lang->id,
                        'column_name' => 'description',
                    ],
                    [
                        'content' => $request->input('description_' . $lang->code),
                    ]
                );
            }
        }

        Flasher::addSuccess(trans('body.Updated successfully'));

        return redirect()->back();
    }
}

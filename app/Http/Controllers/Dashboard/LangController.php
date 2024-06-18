<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use App\Http\Requests\LangRequest;
use Flasher\Laravel\Facade\Flasher;
use Exception;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Lang::orderBy('created_at', 'desc')->paginate(20);

        return view('dashboard.langs.index', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LangRequest $request)
    {
        try {
            // generate name for the icon
            $generatedName = 'icon_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();

            // Move the uploaded file to the public/images/flags directory, not in storage
            $request->file('icon')->move(public_path('images/flags'), $generatedName);
            $iconPath = 'images/flags/' . $generatedName;

            Lang::create([
                'code' => $request->code,
                'name' => $request->name,
                'icon' => $iconPath,
                'is_published' => $request->is_published == 'on' ? true : false,
            ]);

            Flasher::addSuccess(trans('body.Created successfully'));

            return redirect()->back();
        } catch (Exception $e) {
            Flasher::addError(trans('body.Error. Can\'t store'));
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LangRequest $request, Lang $lang)
    {
        try {
            $iconPath = $lang->icon;

            if ($request->hasFile('icon')) {
                if (File::exists($lang->icon)) {
                    File::delete($lang->icon);
                }

                // generate name for the icon
                $generatedName = 'icon_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();

                // Move the uploaded file to the public/images/flags directory, not in storage
                $request->file('icon')->move(public_path('images/flags'), $generatedName);
                $iconPath = 'images/flags/' . $generatedName;
            }

            $lang->update([
                'code' => $request->code,
                'name' => $request->name,
                'icon' => $iconPath,
                'is_published' => $request->is_published == 'on' ? true : false,
            ]);

            Flasher::addSuccess(trans('body.Updated successfully'));

            return redirect()->back();
        } catch (Exception $e) {
            Flasher::addError(trans('body.Error. Can\'t update'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lang $lang)
    {
        try {
            if (File::exists($lang->icon)) {
                File::delete($lang->icon);
            }

            $lang->delete();

            Flasher::addSuccess(trans('body.Deleted successfully'));

            return redirect()->back();
        } catch (Exception $e) {
            Flasher::addError(trans('body.Error. Can\'t delete'));
            return back();
        }
    }

    /**
     * Change the language
     */
    public function changeLang(Lang $lang)
    {
        session()->put('locale', $lang->code);
        App::setLocale($lang->code);

        return redirect()->back();
    }
}

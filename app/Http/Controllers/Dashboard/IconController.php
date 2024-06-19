<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\IconRequest;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Storage;
use App\Models\Icon;

class IconController extends Controller
{
    public function index()
    {
        $icons = Icon::orderBy('created_at', 'desc')->paginate(20);

        return view('dashboard.icons.index', compact('icons'));
    }

    public function store(IconRequest $request)
    {
        try {
            $icon = Icon::create([
                'name' => $request->name,
            ]);

            $this->storeImage($request->file('icon'), 'icons', Icon::class, $icon->id);
            // $this->convertToWebP($request->file('icon'), 'icons', Icon::class, $icon->id);

            Flasher::addSuccess(trans('body.Created successfully'));

            return redirect()->back();
        } catch (\Exception $e) {
            Flasher::addError(trans('body.Error. Can\'t update'));
            return back();
        }
    }

    public function update(IconRequest $request, Icon $icon)
    {
        try {
            $icon->update([
                'name' => $request->name,
            ]);

            if ($request->hasFile('icon')) {
                foreach ($icon->images as $image) {
                    $this->deleteImage($image);
                }

                $this->storeImage($request->file('icon'), 'icons', Icon::class, $icon->id);
                // $this->convertToWebP($request->file('icon'), 'icons', Icon::class, $icon->id);
            }

            Flasher::addSuccess(trans('body.Updated successfully'));

            return redirect()->back();
        } catch (\Exception $e) {
            Flasher::addError(trans('body.Error. Can\'t update'));
            return back();
        }
    }

    public function destroy(Icon $icon)
    {
        try {
            foreach ($icon->images as $image) {
                if (Storage::exists('/public/' . $image->path)) {
                    Storage::delete('/public/' . $image->path);
                }
                $image->delete();
            }
            Flasher::addSuccess(trans('body.Deleted successfully'));
            $icon->delete();

            return redirect()->back();
        } catch (\Exception $e) {
            Flasher::addError(trans('body.Error. Can\'t delete'));
            return back();
        }
    }
}

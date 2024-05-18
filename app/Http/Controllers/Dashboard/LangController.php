<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LangRequest;
use App\Models\Lang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Exception;

class LangController extends Controller
{
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

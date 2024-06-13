<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lang;
use Illuminate\Support\Facades\App;

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

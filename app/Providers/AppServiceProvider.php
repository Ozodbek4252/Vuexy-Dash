<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Lang;
use App\ViewModels\User\IndexUserViewModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = auth()->user();
            if ($user) {
                $user_auth = new IndexUserViewModel($user);
            } else {
                $user_auth = null;
            }

            $langsForHeader = Lang::where('is_published', true)->get();
            $currenctLang = Lang::where('code', session('locale'))->first();
            $company = Company::first();

            $view->with([
                'user_auth' => $user_auth,
                'langsForHeader' => $langsForHeader,
                'currenctLang' => $currenctLang,
                'company' => $company,
            ]);
        });
    }
}

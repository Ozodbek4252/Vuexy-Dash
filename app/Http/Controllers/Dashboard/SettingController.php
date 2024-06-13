<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanySettingsRequest;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\File;
use App\Models\Company;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function companySetting()
    {
        $company = Company::first();
        return view('dashboard.company-settings.index', compact('company'));
    }

    public function updateCompanySetting(CompanySettingsRequest $request)
    {
        $company = Company::first();
        $company->update(['name' => $request->name]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if (File::exists($company->logo)) {
                File::delete($company->logo);
            }

            // generate name for the logo
            $generatedName = 'logo_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();

            // Move the uploaded file to the public/assets/images/flags directory, not in storage
            $request->file('logo')->move(public_path('images'), $generatedName);
            $logoPath = 'images/' . $generatedName;

            $company->update(['logo' => $logoPath]);
        }

        if ($request->hasFile('logo_secondary')) {
            // Delete old logo_secondary
            if (File::exists($company->logo_secondary)) {
                File::delete($company->logo_secondary);
            }

            // generate name for the logo_secondary
            $generatedName = 'logo_secondary_' . time() . '.' . $request->file('logo_secondary')->getClientOriginalExtension();

            // Move the uploaded file to the public/assets/images/flags directory, not in storage
            $request->file('logo_secondary')->move(public_path('images'), $generatedName);
            $logo_secondaryPath = 'images/' . $generatedName;

            $company->update(['logo_secondary' => $logo_secondaryPath]);
        }

        Flasher::addSuccess(trans('body.Updated successfully'));

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\ViewModels\User\IndexUserViewModel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user = new IndexUserViewModel($user);
        return view('dashboard.profile.index', compact('user'));
    }
}

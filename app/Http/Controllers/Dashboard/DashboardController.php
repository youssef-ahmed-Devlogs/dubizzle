<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.home', [
            'users_count' => User::count(),
            'ads_count' => Ad::count(),
            'published_ads_count' => Ad::where('status', 'published')->count(),
            'categories_count' => Category::count()
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function profile()
    {
        return view('dashboard.profile', ['user' => Auth::user()]);
    }

    public function settings()
    {
        return view('dashboard.settings');
    }
}

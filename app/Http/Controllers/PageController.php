<?php

namespace App\Http\Controllers;

use App\Support\Demo;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard', Demo::dashboard());
    }

    public function analytics(): View
    {
        return view('analytics', Demo::analytics());
    }

    public function orders(): View
    {
        return view('orders', Demo::orders());
    }

    public function customers(): View
    {
        return view('customers', Demo::customers());
    }

    public function settings(): View
    {
        return view('settings', Demo::settings());
    }
}

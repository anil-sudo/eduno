<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home(Request $request)
    {
        return Inertia::render('welcome');
    }

    public function about(Request $request)
    {
        return Inertia::render('welcome');
    }
}

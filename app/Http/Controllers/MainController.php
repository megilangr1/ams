<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return to_route('backend.main');
        }

        return view('welcome');
    }

    public function adminIndex()
    {
        return view('backend.index');
    }
}

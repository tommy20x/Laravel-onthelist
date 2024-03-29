<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            return redirect('admin');
        } else if ($role == 'vendor') {
            return redirect('vendors');
        } else if ($role == 'dj') {
            return redirect('dj');
        } else if ($role == 'customer') {
            return redirect('customers');
        }
        return view('home');
    }
}

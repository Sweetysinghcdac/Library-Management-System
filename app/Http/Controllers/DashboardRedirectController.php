<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardRedirectController extends Controller
{
    public function __invoke()
    {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/books');
        }

        return redirect('/visitor/books');
    }
}

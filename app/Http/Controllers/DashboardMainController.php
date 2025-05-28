<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardMainController extends Controller
{
    public function index()
    {
        // This method will return the dashboard view
        return view('admin.dashboard');
    }
}

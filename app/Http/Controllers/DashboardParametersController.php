<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardParametersController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboardParameters');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('admin.dashboard')->with('title', 'Рабочий стол');
    }

}

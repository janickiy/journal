<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('dashboard.home')->with('title','Главаня страница');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Image;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use App\User;
use App\Models\{Role, RoleUser};
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

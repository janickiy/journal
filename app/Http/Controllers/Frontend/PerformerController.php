<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;

class PerformerController extends Controller
{
    public function applications()
    {
        return view('performer.applications')->with('title', 'Мои заявки');
    }

    public function applyForm()
    {

    }

    public function apply()
    {

    }

}

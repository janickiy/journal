<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Journal;
use App\Http\Controllers\Controller;

class JournalController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        Journal::where(['id' => $id])->delete();
    }
}
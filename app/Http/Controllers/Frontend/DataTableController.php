<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests;
use App\Models\Journal;
use App\Http\Start\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use URL;

class DataTableController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getApplications()
    {
        $applications = Journal::where('manufacture_member_id', Auth::id());

        return Datatables::of($applications)

            ->addColumn('equipment', function ($applications) {
                return isset($applications->equipment->name) && $applications->equipment->name ? $applications->equipment->name : '';
            })
            ->addColumn('area', function ($applications) {
                return isset($applications->area->name) && $applications->area->name ? $applications->area->name : '';
            })
            ->addColumn('service_member', function ($applications) {
                return isset($applications->servicemember->name) && $applications->servicemember->name ? $applications->servicemember->name : '';
            })
            ->addColumn('actions', function ($applications) {
                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('frontend.applicant.edit', ['id' => $applications->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;';
                $deleteBtn = '<a title="Отменить" class="btn btn-xs btn-danger deleteRow" id="' . $applications->id . '"><span class="fa fa-remove"></span></a>';

                return empty($applications->time_fixed) ? $editBtn . $deleteBtn : '';
            })
            ->rawColumns(['actions'])->make(true);
    }

}

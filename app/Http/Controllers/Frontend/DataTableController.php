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

            ->addColumn('status_journal', function ($applications) {
                return $applications->status;
            })

            ->addColumn('equipment', function ($applications) {
                return isset($applications->equipment->name) && $applications->equipment->name ? $applications->equipment->name : '';
            })
            ->addColumn('area', function ($applications) {
                return isset($applications->area->name) && $applications->area->name ? $applications->area->name : '';
            })
            ->addColumn('service_member', function ($applications) {
                return isset($applications->servicemember->name) && $applications->servicemember->name ? $applications->servicemember->name : '';
            })
            ->editColumn('status', function ($applications) {
                return appStatus($applications->status);
            })
            ->addColumn('actions', function ($applications) {

                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('frontend.applicant.edit', ['id' => $applications->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;';

                if (diff_d($applications->created_at, date('Y-m-d H:i:s')) < 10) {
                    $deleteBtn = '<a title="Отменить" class="btn btn-xs btn-danger deleteRow" id="' . $applications->id . '"><span class="fa fa-times-circle"></span></a>';
                } else {
                    $deleteBtn = '';
                }

                if ($applications->status == 1)  {
                    //return '<a title="Оборудование принял" class="btn btn-xs btn-primary"  href="' . URL::route('frontend.applicant.accept', ['id' => $applications->id]) . '"><span  class="fa fa-check"></span></a>';

                    return '<a title="Принять оборудование" class="btn btn-xs btn-primary acceptRow" id="' . $applications->id . '"><span  class="fa fa-check"></span></a>';

                } else {
                    return (empty($applications->time_fixed) && $applications->status == 0) ? $editBtn . $deleteBtn : '';
                }
            })
            ->rawColumns(['actions'])->make(true);
    }

    /**
     * @return mixed
     */
    public function getPerformerApplications()
    {
        $applications = Journal::where('status','>',-1);

        return Datatables::of($applications)

            ->addColumn('status_journal', function ($applications) {
                return $applications->status;
            })

            ->addColumn('equipment', function ($applications) {
                return isset($applications->equipment->name) && $applications->equipment->name ? $applications->equipment->name : '';
            })
            ->addColumn('area', function ($applications) {
                return isset($applications->area->name) && $applications->area->name ? $applications->area->name : '';
            })

            ->addColumn('actions', function ($applications) {
                $editBtn = (!empty($applications->time_fixed) && $applications->status == 0) ? '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('frontend.performer.edit', ['id' => $applications->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;':'';
                $fixBtn = empty($applications->time_fixed) ? '<a title="Неисправность устранена" class="btn btn-xs btn-primary fixRow" id="' . $applications->id . '"><span class="fa fa-check"></span></a>':'';

                return $editBtn . $fixBtn;
            })
            ->rawColumns(['actions'])->make(true);
    }

}

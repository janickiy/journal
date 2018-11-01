<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests;
use App\User;
use App\Models\Role;
use App\Models\Settings;
use App\Models\Equipment;
use App\Models\Area;
use App\Models\WorkTypes;
use App\Http\Start\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use URL;

class DataTableController extends Controller
{
    public function __construct()
    {

    }

    public function getUsers()
    {
        $users = User::all();

        return Datatables::of($users)

            ->editColumn('notifyDetectedFault', function ($users) {
                return $users->notifyDetectedFault ? 'да' : 'нет';
            })

            ->editColumn('notifyFaultFix', function ($users) {
                return $users->notifyFaultFix ? 'да' : 'нет';
            })

            ->addColumn('actions', function ($users) {
                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('admin.user.edit', ['id' => $users->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;';

                if ($users->id != Auth::id())
                    $deleteBtn = '<a class="btn btn-xs btn-danger deleteRow" id="' . $users->id . '"><span class="fa fa-remove"></span></a>';
                else
                    $deleteBtn = '';

                return $editBtn . $deleteBtn;
            })

            ->addColumn('role', function ($users) {
                return isset($users->role->name) && $users->role->name ? $users->role->name : '';
            })

            ->rawColumns(['actions'])->make(true);
    }

    public function getEquipment()
    {
        $equipment = Equipment::all();

        return Datatables::of($equipment)

            ->editColumn('status', function ($equipment) {
                return $equipment->status ? 'активно' : 'неактивно';
            })

            ->addColumn('actions', function ($equipment) {
                $editBtn = Helpers::has_permission(Auth::user()->id, 'edit_equipment') ? '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('admin.equipment.edit', ['id' => $equipment->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;' : '';
                $deleteBtn = Helpers::has_permission(Auth::user()->id, 'delete_equipment') ? '<a class="btn btn-xs btn-danger deleteRow" id="' . $equipment->id . '"><span class="fa fa-remove"></span></a>' : '';

                return $editBtn . $deleteBtn;
            })

            ->rawColumns(['actions'])->make(true);
    }

    public function getArea()
    {
        $area = Area::all();

        return Datatables::of($area)

            ->addColumn('actions', function ($area) {
                $editBtn = Helpers::has_permission(Auth::user()->id, 'edit_area') ? '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('admin.area.edit', ['id' => $area->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;' : '';
                $deleteBtn = Helpers::has_permission(Auth::user()->id, 'delete_area') ? '<a class="btn btn-xs btn-danger deleteRow" id="' . $area->id . '"><span class="fa fa-remove"></span></a>' : '';

                return $editBtn . $deleteBtn;
            })

            ->rawColumns(['actions'])->make(true);
    }

    public function getWorktypes()
    {
         $workTypes = WorkTypes::all();

        return Datatables::of($workTypes)

            ->addColumn('actions', function ($workTypes) {
                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('admin.worktypes.edit', ['id' => $workTypes->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;';
                $deleteBtn = '<a class="btn btn-xs btn-danger deleteRow" id="' . $workTypes->id . '"><span class="fa fa-remove"></span></a>';

                return $editBtn . $deleteBtn;
            })

            ->rawColumns(['actions'])->make(true);
    }

    public function getRole()
    {
        $role = Role::all();

        return Datatables::of($role)

            ->addColumn('actions', function ($role) {
                $editBtn = Helpers::has_permission(Auth::user()->id, 'edit_role') ? '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('admin.role.edit', ['id' => $role->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;' : '';
                $deleteBtn = Helpers::has_permission(Auth::user()->id, 'delete_role') ? '<a class="btn btn-xs btn-danger deleteRow" id="' . $role->id . '"><span class="fa fa-remove"></span></a>' : '';

                return in_array($role->id,[1]) == false ? $editBtn . $deleteBtn : '';
            })

            ->rawColumns(['actions'])->make(true);
    }

    public function getSettings()
    {
        $settings = Settings::all();

        return Datatables::of($settings)

            ->addColumn('actions', function ($settings) {
                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . url("admin/settings/edit/$settings->id") . '"><span  class="fa fa-edit"></span></a> &nbsp;';
                $deleteBtn = '<a class="btn btn-xs btn-danger deleteRow" id="' . $settings->id . '"><span class="fa fa-remove"></span></a>';

                return $editBtn . $deleteBtn;
            })

            ->rawColumns(['actions'])->make(true);
    }

}

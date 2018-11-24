<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests;
use App\User;
use App\Models\Cards;
use App\Models\Role;
use App\Models\Balance;
use App\Http\Start\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use URL;
use Carbon\Carbon;

class DataTableController extends Controller
{
    public function __construct()
    {

    }

    public function getUsers()
    {
        $users = User::all();

        return Datatables::of($users)

            ->addColumn('actions', function ($users) {
                $editBtn = '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('dashboard.user.edit', ['id' => $users->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;';

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

    public function getRole()
    {
        $role = Role::all();

        return Datatables::of($role)

            ->addColumn('actions', function ($role) {
                $editBtn = Helpers::has_permission(Auth::user()->id, 'edit_role') ? '<a title="Редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('dashboard.role.edit', ['id' => $role->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;' : '';
                $deleteBtn = Helpers::has_permission(Auth::user()->id, 'delete_role') ? '<a class="btn btn-xs btn-danger deleteRow" id="' . $role->id . '"><span class="fa fa-remove"></span></a>' : '';

                return in_array($role->id,[1]) == false ? $editBtn . $deleteBtn : '';
            })

            ->rawColumns(['actions'])->make(true);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\WorkTypes;
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;

class WorktypesController extends Controller
{
    public function __construct()
    {

    }

    public function list()
    {
        return view('admin.worktypes.list')->with('title', ' Типы выполненных работ');
    }

    public function create()
    {
        return view('admin.worktypes.create_edit');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'code' => 'required'
        ];

        $message = [
            'name.required' => 'Это поле должно быть заполнено!',
            'code.required' => 'Это поле должно быть заполнено!',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            WorkTypes::create($request->all());

            return redirect('admin/worktypes/list')->with('success', 'Информация успешно добавлена');
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
    public function edit($id)
    {
        if (!is_numeric($id)) abort(500);

        $worktypes = WorkTypes::where('id', $id)->first();

        if ($worktypes) {
            return view('admin.worktypes.create_edit', compact('worktypes'));
        }

        abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'code' => 'required'
        ];

        $message = [
            'name.required' => 'Это поле должно быть заполнено!',
            'code.required' => 'Это поле должно быть заполнено!',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['name'] = $request->name;
            $data['code'] = $request->code;

            WorkTypes::where('id', $request->id)->update($data);

            return redirect('admin/worktypes/list')->with('success', 'Данные обновлены');
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!is_numeric($id)) abort(500);

        WorkTypes::where(['id' => $id])->delete();
    }
}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Area;
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function __construct()
    {

    }

    public function list()
    {
        return view('admin.area.list')->with('title', 'Участки');
    }

    public function create()
    {
        return view('admin.area.create_edit');
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
            'validation.required' => 'Это поле должно быть заполнено!'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            Area::create($request->all())->id;

            return redirect('admin/area/list')->with('success', 'Информация успешно добавлена');
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
    public function edit($id)
    {
        if (!is_numeric($id)) abort(500);

        $area = Area::where('id', $id)->first();

        if ($area) {
            return view('admin.area.create_edit', compact('area'));
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
            'validation.required' => 'Это поле должно быть заполнено!'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['name'] = $request->name;
            $data['code'] = $request->code;

            Area::where('id', $request->id)->update($data);

            return redirect('admin/area/list')->with('success', 'Данные обновлены');
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!is_numeric($id)) abort(500);

        Area::where(['id' => $id])->delete();
    }
}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Equipment;
use App\Models\Area;
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    public function __construct()
    {

    }

    public function list()
    {
        return view('admin.equipment.list')->with('title', 'Оборудование');
    }

    public function create()
    {
        $areas = Area::get();
        $options = [];

        foreach($areas as $area) {
            $options[$area->id] = $area->name;
        }

        return view('admin.equipment.create_edit', compact('options'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'area_id' => 'required|numeric',
            'time_weight' => 'required|numeric',
        ];

        $message = [
            'name.required' => 'Это поле должно быть заполнено!',
            'area_id.required' => 'Это поле должно быть заполнено!',
            'time_weight.required' => 'Это поле должно быть заполнено!',
        ];

        $validator = Validator::make($request->all(),  $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $status = 0;

            if ($request->input('status')){
                $status = 1;
            }

            Equipment::create(array_merge($request->all(),['status' => $status]));

            return redirect('admin/equipment/list')->with('success', 'Информация успешно добавлена');
        }
    }

    /**
 * @param $id
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
    public function edit($id)
    {
        if (!is_numeric($id)) abort(500);

        $equipment = Equipment::where('id', $id)->first();

        if ($equipment) {
            $areas = Area::get();
            $options = [];

            foreach($areas as $area) {
                $options[$area->id] = $area->name;
            }

            return view('admin.equipment.create_edit', compact('equipment','options'));
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
            'area_id' => 'required|numeric',
            'time_weight' => 'required|numeric',
        ];

        $message = [
            'name.required' => 'Это поле должно быть заполнено!',
            'area_id.required' => 'Это поле должно быть заполнено!',
            'time_weight.required' => 'Это поле должно быть заполнено!',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['status'] = 0;
            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['area_id'] = $request->area_id;
            $data['time_weight'] = $request->time_weight;

            if ($request->input('status')){
                $data['status'] = 1;
            }

            Equipment::where('id', $request->id)->update($data);

            return redirect('admin/equipment/list')->with('success', 'Данные обновлены');
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!is_numeric($id)) abort(500);

        Equipment::where(['id' => $id])->delete();
    }
}
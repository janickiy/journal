<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applications()
    {

        return view('applicant.applications')->with('title', 'Мои заявки');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applyForm()
    {
        $areas = Area::get();
        $area_options = [];

        foreach ($areas as $area) {
            $area_options[$area->id] = $area->name;
        }

        $equipments = Equipment::select('equipment.id', 'equipment.name')
            ->join('users', 'users.area_id', '=', 'equipment.area_id')
            ->where('users.id', Auth::user()->id)
            ->status()
            ->get();

        $equipment_options = [];

        foreach ($equipments as $equipment) {
            $equipment_options[$equipment->id] = $equipment->name;
        }

        return view('applicant.create_edit', compact('area_options', 'equipment_options'))->with('title', 'Создание заявки');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request)
    {
        $rules = [
            'equipment_id' => 'required|integer',
            'disrepair_description' => 'required|max:255'
        ];

        $message = [
            'equipment_id.required' => 'Это поле должно быть заполнено!',
            'disrepair_description.required' => 'Это поле должно быть заполнено!',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['area_id'] = Auth::user()->area_id;
            $data['status'] = 0;
            $data['less30min'] = 0;
            $data['manufacture_member_id'] = Auth::user()->id;

            Journal::create(array_merge($request->all(), $data));

            $users = User::select('*')
                // ->join('roles','roles.id','=','users.role_id')
                //  ->where('users.area_id',Auth::user()->area_id)
                ->where('notifyDetectedFault', 1)
                //->where('roles.name','=','performer')
                ->get();

            $equipment = Equipment::where('id', $request->equipment_id)->first();
            $msg = "Поступила заявка на ремонт: " . ucfirst($equipment->area->name) . "\n " . $equipment->name . "\n " . $request->disrepair_description;

            foreach ($users as $user) {
                if ($user->phone) sendSMS($user->phone, $msg);
            }

            if (getSetting('TELEGRAM_API_URL') && getSetting('TELEGRAM_TOKEN') && getSetting('TELEGRAM_CHAT_ID')) {

                if( $curl = curl_init() ) {
                    curl_setopt($curl, CURLOPT_URL, 'http://janicky.com/proxy.php');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "TELEGRAM_API_URL=" . getSetting('TELEGRAM_API_URL') . "&TELEGRAM_TOKEN=" . getSetting('TELEGRAM_TOKEN') . "&TELEGRAM_CHAT_ID=" . getSetting('TELEGRAM_CHAT_ID') . "&msg=" . $msg);
                    $out = curl_exec($curl);
                    //echo $out;
                    curl_close($curl);
                }

                /**
                if ($curl = curl_init()) {
                    curl_setopt($curl, CURLOPT_URL, getSetting('TELEGRAM_API_URL') . getSetting('TELEGRAM_TOKEN') . '/sendMessage');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, "chat_id=" . getSetting('TELEGRAM_CHAT_ID') . "&text=" . $msg);
                    $out = curl_exec($curl);
                    //echo $out;
                    curl_close($curl);
                }
                **/
            }

            return redirect('applicant')->with('success', 'Заявка отправлена');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function editForm($id)
    {
        if (!is_numeric($id)) abort(500);

        $journal = Journal::where('id', $id)->first();

        if ($journal) {

            $areas = Area::get();
            $area_options = [];

            foreach ($areas as $area) {
                $area_options[$area->id] = $area->name;
            }

            $equipments = Equipment::select('equipment.id', 'equipment.name')
                ->join('users', 'users.area_id', '=', 'equipment.area_id')
                ->where('users.id', Auth::user()->id)
                ->status()
                ->get();

            $equipment_options = [];

            foreach ($equipments as $equipment) {
                $equipment_options[$equipment->id] = $equipment->name;
            }

            return view('applicant.create_edit', compact('journal', 'area_options', 'equipment_options'));

        }

        abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function update(Request $request)
    {
        if (!is_numeric($request->id)) abort(500);

        $rules = [
            'equipment_id' => 'required|integer',
            'disrepair_description' => 'required|max:255'
        ];

        $message = [
            'equipment_id.required' => 'Это поле должно быть заполнено!',
            'disrepair_description.required' => 'Это поле должно быть заполнено!',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data['equipment_id'] = $request->equipment_id;
            $data['disrepair_description'] = $request->disrepair_description;
            $data['continues_used'] = 0;

            if ($request->continues_used) {
                $data['continues_used'] = 1;
            }

            Journal::where('id', $request->id)->update($data);

            return redirect('applicant')->with('success', 'Заявка отправлена');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function accept(Request $request)
    {
        $journal = Journal::where('id', $request->id)->first();

        if ($journal) {
            if (diff_d($journal->created_at, date('Y-m-d H:i:s')) > 30)
                $data['less30min'] = 0;
            else
                $data['less30min'] = 1;

            $data['status'] = 2;
            $data['master_comment'] = $request->comment;

            Journal::where('id', $request->id)->update($data);

            return redirect('applicant')->with('success', 'Оборудование принято');
        }

        abort(404);

    }

    /**
     * @param Request $request
     */
    public
    function cancel(Request $request)
    {
        Journal::where('id', $request->id)->update(['status' => -1]);
    }
}

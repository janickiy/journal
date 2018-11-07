<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Start\Helpers;
use App\Models\Journal;
use App\Models\WorkTypes;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth;

class PerformerController extends Controller
{
    public function applications()
    {
        return view('performer.applications')->with('title', 'Заявки');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $application = Journal::where('id',$id)->first();

        if ($application) {
            $worktypes = WorkTypes::get();
            $options = [];

            foreach($worktypes as $worktype) {
                $options[$worktype->id] = $worktype->name;
            }

            return view('performer.edit', compact('application','options'));
        }

        abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (!is_numeric($request->id)) abort(500);

        $rules = [
            'work_comment' => 'required|max:255',
            'worktypes_id' => 'required|integer',
            'service_comment' => 'required'
        ];

        $message = [
            'validation.required' => 'Это поле должно быть заполнено!'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $data['work_comment'] = $request->work_comment;
            $data['worktypes_id'] = $request->worktypes_id;
            $data['service_comment'] = $request->service_comment;
            $data['status'] = 1;

            Journal::where('id', $request->id)->update($data);

            return redirect('performer')->with('success', 'Заявка обновлена');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fix($id)
    {
        $journal = Journal::where('id',$id)->first();

        if ($journal) {
            $msg = 'Неисправность устранена: ' . $journal->equipment->name . ' готово к работе';

            if ($journal->manufacturemember->notifyFaultFix) sendSMS($journal->manufacturemember->phone,$msg);

            return Journal::where('id', $id)->update(['service_member_id' => Auth::user()->id, 'time_fixed' => Carbon::now()]);

        }
    }
}

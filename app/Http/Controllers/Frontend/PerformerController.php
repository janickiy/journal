<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
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
        $application = Journal::where('id', $id)->first();

        if ($application) {
            $worktypes = WorkTypes::get();
            $options = [];

            foreach ($worktypes as $worktype) {
                $options[$worktype->id] = $worktype->name;
            }

            return view('performer.edit', compact('application', 'options'));
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

        $journal = Journal::where('id', $request->id)->first();

        if (!$journal) abort(404);

        $rules = [
            'work_comment' => 'required|max:255',
            'worktypes_id' => 'required|integer',
        ];

        $message = [
            'work_commen.required' => 'Это поле должно быть заполнено!',
            'worktypes_id.required' => 'Это поле должно быть заполнено!',
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

            $journal = Journal::where('id', $request->id)->first();

            $msg = "Неисправность устранена:\n" . $journal->equipment->name . "\nОборудование готово к работе";

            if ($journal->manufacturemember->notifyFaultFix)  {
                if ($journal->manufacturemember->phone) sendSMS($journal->manufacturemember->phone, $msg);
                if ($journal->servicemember->phone) sendSMS($journal->servicemember->phone, $msg);
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
                    if( $curl = curl_init() ) {
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
            }

            return redirect('performer')->with('success', 'Заявка обновлена');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fix($id)
    {
        return Journal::where('id', $id)->update(['service_member_id' => Auth::user()->id, 'time_fixed' => Carbon::now()]);
    }
}

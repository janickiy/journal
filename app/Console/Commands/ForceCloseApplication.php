<?php

namespace App\Console;

use Illuminate\Console\Command;
use App\Models\Journal;
use Carbon\Carbon;

class ForceCloseApplication extends Command
{
    protected $description = 'Закрывать принудительно заявки';

    public function handle()
    {
        $force_close_application = getSetting('FORCE_CLOSE_APPLICATION');

        if ($force_close_application) {
            $journals = Journal::where('time_fixed', '>', Carbon::now()->subMinutes($force_close_application)->where('status', 1)->get());

            $array_id = [];

            foreach ($journals as $journal) {
                $array_id[] = $journal->id;
            }

            $less30min = $force_close_application > 30 ? 0 : 1;

            Journal::whereId('id', $array_id)->update(['status' => 2, 'master_comment' => 'Заявка закрыта принудительно', 'less30min' => $less30min]);
        }
    }
}
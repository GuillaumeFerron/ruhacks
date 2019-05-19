<?php

namespace App\Console\Commands;

use App\Notifications\SendMedicationSMS;
use App\User;
use App\Utils\RemindersManagement;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the proper reminders to users that need it';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start_time = Carbon::now()->setMinutes(0)->setSeconds(0);
        $end_time = $start_time->copy()->addMinutes(59);

        // TODO TO BE REFACTORED !
        $reminders = RemindersManagement::getRemindersBetweenTimes($start_time, $end_time);
        $user = User::where('id', 1)->first();
        $user->notify(new SendMedicationSMS($user, $reminders, $start_time));
    }
}

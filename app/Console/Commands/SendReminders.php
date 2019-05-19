<?php

namespace App\Console\Commands;

use App\Notifications\SendMedicationSMS;
use App\User;
use App\Utils\RemindersManagement;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Twilio\Rest\Client;

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

        if (count($reminders) > 0) {
            $content = $this->getMessageBody($reminders, $start_time);

            $user = User::where('id', 1)->first();
            $sid = env('TWILIO_KEY');
            $token = env("TWILIO_SECRET");
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create($user->phone, // to
                    [
                        "from" => env('TWILIO_FROM_NUMBER'),
                        "body" => $content
                    ]
                );
        }
    }

    public function getMessageBody($reminders, $time)
    {
        if (count($reminders) === 1) {
            $medication = $reminders[0]->medication;

            $content = 'Don\'t forget to take ' . $medication->quantity_amount . ' ' . $medication->quantity_type . ' of ' . $medication->name . ' at ' . Carbon::parse($time)->format('g A') . '! Answer YES if you\'ve taken it, or NO if you haven\'t.';
        } else {
            $content = Carbon::parse($time)->format('g A') . ' reminder: Take ';
            foreach ($reminders as $key => $reminder) {
                $medication = $reminder->medication;

                $content .= ($key + 1) . '. ' . $medication->quantity_amount . ' ' . $medication->quantity_type . ' of ' . $medication->name . " ";
            }
            $content .= 'YES for all, NO for none, or the numbers of medications.';
        }

        return $content;
    }
}

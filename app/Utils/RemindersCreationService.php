<?php


namespace App\Utils;


use App\Medication;
use App\Reminder;
use App\User;
use Carbon\Carbon;
use NumberFormatter;

class RemindersCreationService
{
    public static function generateRemindersForAllUsers()
    {
        $users = User::all();

        foreach ($users as $user) {
            echo 'User: ' . $user->id . "\n";
            self::generateRemindersForOneUser($user->id);
        }
    }

    public static function generateRemindersForOneUser($user_id)
    {
        $medications = User::find($user_id)->medications;

        foreach ($medications as $medication) {
            if (!$medication->reminders_generated) {
                echo 'Medication: ' . $medication->id . "\n";
                self::generateRemindersForOneMedication($medication->id);
            } else {
                echo 'SKIP Medication ' . $medication->id . "\n";
                continue;
            }
        }

    }

    public static function generateRemindersForOneMedication($medication_id)
    {
        $numbers = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            'ten' => 10,
            'eleven' => 11,
            'twelve' => 12,
            'thirteen' => 13,
            'fourteen' => 14,
            'fifteen' => 15,
            'sixteen' => 16,
            'seventeen' => 17,
            'eighteen' => 18,
            'nineteen' => 19,
            'twenty' => 20,
            'twenty-one' => 21,
            'twenty-two' => 22,
            'twenty-three' => 23,
            'twenty-four' => 24,
            'twenty-five' => 25,
            'twenty-six' => 26,
            'twenty-seven' => 27,
            'twenty-eight' => 28,
            'twenty-nine' => 29,
            'thirty' => 30
        ];

        $medication = Medication::find($medication_id);
        $frequency = explode(' ', $medication->frequency);

        if (count($frequency) > 2) {
            switch ($frequency[0]) {
                case 'every':
                    for ($i = 0; $i < $medication->qty; $i++) {
                        $date = Carbon::parse($medication->start_date);
                        $date->setTimeFromTimeString($medication->time);
                        $number = $i * ((int)$frequency[1] <= 30 && (int)$frequency[1] >= 1 ? (int)$frequency[1] : $numbers[$frequency[1]]);

                        if ($frequency[2] === 'days' || $frequency[2] === 'day') {
                            $date->addDays($number);
                        } else {
                            $date->addHours($number);
                        }

                        Reminder::insert([
                            'date_time' => $date,
                            'medication_id' => $medication_id,
                            'status' => false,
                            'disabled' => false
                        ]);
                    }
                    echo 'Cyclic notification created.' . "\n";
                    break;
                default:
                    echo 'No frequency occurrence found.' . "\n";
                    return;
            }
        } else {
            switch ($medication->frequency) {
                case 'daily':
                    self::dailyReminder($medication);
                    break;
                case 'every day':
                    self::dailyReminder($medication);
                    break;
                case 'weekly':
                    for ($i = 0; $i < $medication->qty; $i++) {
                        $date = Carbon::parse($medication->start_date)->addWeeks($i);
                        $date->setTimeFromTimeString($medication->time);

                        Reminder::insert([
                            'date_time' => $date,
                            'medication_id' => $medication_id,
                            'status' => false,
                            'disabled' => false
                        ]);
                    }
                    echo 'Weekly notification created' . "\n";
                    break;
                default:
                    echo 'No frequency occurrence found.' . "\n";
                    return;
            }
        }

        $medication->reminders_generated = true;
        $medication->save();
    }

    private static function dailyReminder($medication)
    {
        for ($i = 0; $i < $medication->qty; $i++) {
            $date = Carbon::parse($medication->start_date)->addDays($i);
            $date->setTimeFromTimeString($medication->time);

            Reminder::insert([
                'date_time' => $date,
                'medication_id' => $medication->id,
                'status' => false,
                'disabled' => false
            ]);
        }
        echo 'Daily notification created' . "\n";
    }

}

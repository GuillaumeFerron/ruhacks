<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendMedicationSMS extends Notification
{
    use Queueable;

    protected $user;
    protected $reminders;
    protected $time;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $reminders, $time)
    {
        $this->user = $user;
        $this->reminders = $reminders;
        $this->time = $time;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    public function toNexmo()
    {
        if (count($this->reminders) === 1) {
            $medication = $this->reminders[0]->medication;

            $content = 'Don\'t forget to take ' . $medication->quantity_amount . ' ' . $medication->quantity_type . ' of ' . $medication->name . ' at ' . Carbon::parse($this->time)->format('g A') . '! Answer YES if you\'ve taken it, or NO if you haven\'t.';
        } else {
            $content = Carbon::parse($this->time)->format('g A') . ' reminder: Take ';
            foreach ($this->reminders as $key => $reminder) {
                $medication = $reminder->medication;

                $content .= ($key + 1) . '. ' . $medication->quantity_amount . ' ' . $medication->quantity_type . ' of ' . $medication->name . " ";
            }
            $content .= 'YES for all, NO for none, or the numbers of medications.';
        }

        return (new NexmoMessage)
            ->content($content);
    }
}

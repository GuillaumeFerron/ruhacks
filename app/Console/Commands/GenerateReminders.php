<?php

namespace App\Console\Commands;

use App\Utils\RemindersCreationService;
use Illuminate\Console\Command;

class GenerateReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all the reminders for all users and all their medications';

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
        RemindersCreationService::generateRemindersForAllUsers();
    }
}

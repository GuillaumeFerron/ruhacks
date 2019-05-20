<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert([
            [
                'username' => 'guillaumeferron',
                'firstname' => 'Guillaume',
                'lastname' => 'Ferron',
                'email' => 'guillaume.ferron2@gmail.com',
                'email_verified_at' => now(),
                'phone' => '+33661046209',
                'password' => '$2a$10$zJdCxAkA0.h6BeKN5NPU9.TTMK/4RSbZ7ZQRtFqL4XWUuwI1rqgoa', // password
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'natansimchovich',
                'firstname' => 'Natan',
                'lastname' => 'Simchovich',
                'email' => 'simchovich.natan@gmail.com',
                'email_verified_at' => now(),
                'phone' => '+16473086566',
                'password' => '$2a$10$og2kGW0rUurUqyccMxAM3OdLJSo1QFLC2zhDeixdwsQ2mlz1jzSri', // password
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'testaccount',
                'firstname' => 'Test',
                'lastname' => 'Test',
                'email' => 'test@test.com',
                'email_verified_at' => now(),
                'phone' => '+33661046209',
                'password' => '$2a$10$FO2enc2wbzwmozkEC2YEpe8VXh6IdmHTj0EIZQUHW9QhKDCiz2AZu', // password
                'remember_token' => Str::random(10),
            ]
        ]);
    }
}

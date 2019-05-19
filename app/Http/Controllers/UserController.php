<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Twilio\Rest\Client;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate(config('database.pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id)->paginate(config('database.pagination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Returns the medications associated with a given user
     *
     * @param User $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function userMedications(User $user)
    {
        return $user->medications()->paginate(config('database.pagination'));
    }

    /**
     * Returns the reminders associated with a given user
     *
     * @param User $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function userReminders(User $user)
    {
        return $user->reminders()->orderBy('date_time')->paginate(config('database.pagination'));
    }

    public function sendReminders()
    {
        Artisan::call('reminders:send');
    }

    public function followUpReminders()
    {
        $user = User::where('id', 1)->first();
        $sid = env('TWILIO_KEY');
        $token = env("TWILIO_SECRET");
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create($user->phone, // to
                [
                    "from" => env('TWILIO_FROM_NUMBER'),
                    "body" => 'You have finished your atorvastatin prescription. Do you need a refill?'
                ]
            );
    }
}

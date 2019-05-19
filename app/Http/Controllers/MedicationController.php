<?php

namespace App\Http\Controllers;

use App\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Medication::paginate(config('database.pagination'));
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

        Medication::insert([
            'name' => $request->name,
            'frequency' => $request->frequency,
            'quantity_type' => $request->quantity_type,
            'quantity_amount' => $numbers[$request->quantity_amount],
            'qty' => $request->qty,
            'user_id' => Auth::id()
        ]);

        Artisan::call('reminders:generate');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Medication::find($id)->paginate(config('database.pagination'));
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

    public function medicationReminders(Medication $medication)
    {
        return $medication->reminders()->paginate(config('database.pagination'));
    }
}

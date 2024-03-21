<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    
    public function index()
    {
        $tickets = Ticket::with('owner')->get();

        return view('pages.ticket.index', compact('tickets'));
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'participants' => ['required'],
        ]);

        $totalNumbers = range(0, 999, 1);

        $tickets = [];
        
        $raffleConfig = Raffle::first();

        foreach($request->participants as $participant){

            $numbers = [];

            for($i = 0; $i < $raffleConfig->numbers; $i++){
                $randomPosition = rand(0,  count($totalNumbers) -1);

                array_push($numbers,  $totalNumbers[$randomPosition]);

                array_splice($totalNumbers,  $randomPosition, 1);

            }

            array_push($tickets, [
                'participant_id' => $participant,
                'raffle_id' => $raffleConfig->id,
                'numbers' => implode(',', $numbers)
            ]);

        }

        Ticket::insert($tickets);
        

        return redirect()->route('tickets.index');
    }

    public function update(Request $request, $raffleId)
    {
       
    }

    public function destroy($raffleId)
    {
        
       
    }
}

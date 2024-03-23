<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tickets = Ticket::with('owner')->get();

        return view('pages.ticket.index', compact('tickets'));
        
    }

    public function create()
    {
        $participants = Participant::all();
        return view('pages.ticket.create', compact('participants'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'participants' => ['required'],
        ]);

        $participants = Participant::whereIn('id', $request->participants)
                            ->doesntHave('ticket')
                            ->get()
                            ->pluck('id')
                            ->toArray();

        $totalNumbers = range(0, 999, 1);

        $assignedNumbers = Ticket::all()
                            ->pluck('numbers')
                            ->map(function($item){
                                return array_map('intval', explode(',', $item));
                            })
                            ->collapse()
                            ->values();

    $totalNumbers = collect($totalNumbers)->diff($assignedNumbers)->values()->toArray();

        $tickets = [];
        
        $raffleConfig = Raffle::first();

        foreach($participants as $participant){

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
        
        session()->flash('success', 'Cartones generados con exito!');
        return redirect()->route('participants.index');
    }

    public function print($ticketId)
    {
        $ticket = Ticket::where('id',$ticketId)->with('owner','raffle')->first();
        $pdf = Pdf::loadView('pdf.raffle', ['ticket'=>$ticket->toArray()])->setPaper('letter', 'portrait');
        return $pdf->stream('ticket.pdf');
    }

    public function printAll()
    {
        $tickets = Ticket::with('owner','raffle')->get();
        $pdf = Pdf::loadView('pdf.raffles', ['tickets'=>$tickets->toArray()])->setPaper('letter', 'portrait');
        return $pdf->stream('tickets.pdf');
    }
}

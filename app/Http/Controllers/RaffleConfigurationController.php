<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleConfigurationController extends Controller
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
        $raffleConfigs = Raffle::all();

        return view('pages.raffle.index', compact('raffleConfigs'));
        
    }

    public function create()
    {
        return view('pages.raffle.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'numbers' => 'required',
            'draw_date' => ['required', 'date'],
            'awards' => 'required',
            'price' => 'required'
        ]);

        Raffle::create([
            'numbers' => $request->numbers,
            'draw_date' => $request->draw_date,
            'awards' => (object) $request->awards,
            'price' => $request->price,
        ]);

        return redirect()->route('raffles.index');
    }

    public function update(Request $request, $raffleId)
    {
        $this->validate($request, [
            'numbers' => 'required',
            'draw_date' => ['required', 'date'],
            'awards' => 'required',
            'price' => 'required'
        ]);

        $raffleConfig = Raffle::find($raffleId);

        $raffleConfig->update([
            'numbers' => $request->numbers,
            'draw_date' => $request->draw_date,
            'awards' => $request->awards,
            'price' => $request->price,
        ]);

        return redirect()->route('raffles.index');
    }

    public function destroy($raffleId)
    {
        
        $raffleConfig = Raffle::find($raffleId);

        $raffleConfig->delete();
            
        return redirect()->route('raffles.index');
    }
}

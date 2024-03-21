<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleConfigurationController extends Controller
{
    
    public function index()
    {
        $raffleConfig = Raffle::all();

        return view('pages.raffle.index', compact('raffleConfig'));
        
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
            'awards' => $request->awards,
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

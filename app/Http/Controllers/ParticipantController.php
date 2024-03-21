<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $participants = Participant::all();

        return view('pages.participant.index', compact('participants'));
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required'
        ]);

        Participant::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('participant.index');
    }

    public function update(Request $request, $userId)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required'
        ]);

        $participant = Participant::find($userId);

        $participant->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('participant.index');
    }

    public function destroy(Request $request, $userId)
    {
        
        $participant = Participant::find($userId);

        $participant->delete();
            
        return redirect()->route('participant.index');
    }
}

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
        $this->middleware('auth');
    }

    public function index()
    {
        $participants = Participant::with('ticket')->get();

        return view('pages.participant.index', compact('participants'));
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Participant::create([
            'name' => $request->name,
            'status' => $request->has('status') ? 1 : 0
        ]);

        session()->flash('success', 'Participante creado con  éxito!');

        return redirect()->route('participants.index');
    }

    public function update(Request $request, $userId)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $participant = Participant::find($userId);

        $participant->update([
            'name' => $request->name,
            'status' => $request->has('status') ? 1 : 0
        ]);

        session()->flash('success', 'Participante actualizado con  éxito!');

        return redirect()->route('participants.index');
    }

    public function destroy($userId)
    {
        
        $participant = Participant::find($userId);

        $participant->delete();

        session()->flash('success', 'Participante borrado con  éxito!');
            
        return redirect()->route('participants.index');
    }
}

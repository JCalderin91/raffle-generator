@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card">
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h4>Crear cartones</h4>
                    </div>
                    <div class="card-body">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($participants as $key => $participant)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $participant->name }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input name="participants[]" class="form-check-input" type="checkbox" value="{{$participant->id}}"
                                                    role="switch" id="flexSwitchCheckChecked"
                                                    {{ $participant->status == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-3">
                                            No hay participantes registrados 😢
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

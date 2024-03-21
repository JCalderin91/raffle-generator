@extends('layouts.app')

@section('title')
    Cartones | Generador de rifas
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Lista de cartones</h4>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Numbers</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $key => $ticket)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $ticket->owner->name }}</td>
                            <td>{{ $ticket->numbers }}</td>
                            <td>
                                <a href="{{route('tickets.print', [$ticket->id])}}" class="btn btn-sm btn-info">Imprimir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-3">
                                No hay cartones registrados 😢
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection



@extends('layouts.app')

@section('title')
    Cartones | Generador de rifas
@endsection

@section('styles')
<style>
    .number{
        margin-right: 4px;
        background-color: aliceblue;
        border-radius: 16px;
        padding: 2px 4px;
    }
</style>
    
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
                            <td>
                                @foreach (explode(',', $ticket['numbers']) as $number)
                                    <span class="number">{{str_pad($number, 3, '0', STR_PAD_LEFT)}} </span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('tickets.print', [$ticket->id])}}" target="_blank" class="btn btn-sm btn-info">Imprimir</a>
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
        <div class="card-footer d-flex justify-content-end ">
            <a href="{{route('tickets.print.all')}}" class="btn btn-sm btn-warning" target="_blank" rel="noopener noreferrer">Imprimir todo</a>
        </div>
    </div>
@endsection



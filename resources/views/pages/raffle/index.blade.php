@extends('layouts.app')

@section('title')
    Rifas | Generador de rifas
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Lista de rifas <span
                        class="badge rounded-pill text-bg-primary fs-6">{{ $raffleConfigs->count() }}</span></h4>
                <button type="button" class="btn btn-success">Agregar</button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cant. Numeros</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($raffleConfigs as $key => $raffleConfig)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $raffleConfig->numbers }}</td>
                            <td>{{ $raffleConfig->draw_date }}</td>
                            <td>{{ $raffleConfig->price }}</td>
                            <td>
                                <a href="{{route('tickets.create')}}" type="button" class="btn btn-sm btn-info">
                                    Crear cartones
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-3">
                                No hay rifas registradas 😢
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection


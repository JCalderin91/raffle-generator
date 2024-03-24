@extends('layouts.app')

@section('title')
    Configuraciones | Generador de rifas - ATIN
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="card">
                @if ($raffleConfig)
                    <form action="{{ route('raffles.update', $raffleConfig->id) }}" method="POST">
                        @method('put')
                    @else
                        <form action="{{ route('raffles.store') }}" method="POST">
                @endif
                @csrf
                <div class="card-header">
                    <h4>Configurar rifa</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha sorteo</label>
                                <input type="date" class="form-control" id="date" name="draw_date"
                                    value="{{ $raffleConfig->draw_date ?? '' }}">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="mb-3">
                                <label for="quantityNumInput" class="form-label">Numeros</label>
                                <input type="number" class="form-control" id="quantityNumInput" placeholder="0"
                                    name="numbers" value="{{ $raffleConfig->numbers ?? '' }}">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="price" placeholder="00.00" name="price"
                                    value="{{ $raffleConfig->price ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <h5>Premios</h5>
                    <section id="awards">
                        <div class="row align-items-end">
                            @php
                                $awards = $raffleConfig ? (array) $raffleConfig->awards : null;
                            @endphp
                            <div class="col-12 col-md-5">
                                <div class="mb-3">
                                    <label for="raffleInput" class="form-label">Sorteo</label>
                                    <input type="text" class="form-control" id="raffleInput" placeholder="Chance A"
                                        name="awards[0][raffle]" value="{{ $awards[0]->raffle ?? '' }}">
                                </div>
                            </div>

                            <div class="col-12 col-md-5">
                                <div class="mb-3">
                                    <label for="awardInput" class="form-label">Premio</label>
                                    <input type="text" class="form-control" id="awardInput" placeholder="Alimentos"
                                        name="awards[0][award]" value="{{ $awards[0]->award ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-md-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="updateStatus"
                                    {{ isset($awards[0]->status) ? 'checked' : '' }} name="awards[0][status]">
                                    <label for="updateStatus" class="d-md-none">Activo</label>
                            </div>
                        </div>
                        <div class="d-md-none text-center my-3" >---------------------</div>
                        <div class="row align-items-end">
                            <div class="col-12 col-md-5">
                                <div class="mb-3">
                                    <label for="raffleInput" class="form-label">Sorteo</label>
                                    <input type="text" class="form-control" id="raffleInput" placeholder="Chance A"
                                        name="awards[1][raffle]" value="{{ $awards[1]->raffle ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="mb-3">
                                    <label for="awardInput" class="form-label">Premio</label>
                                    <input type="text" class="form-control" id="awardInput" placeholder="Alimentos"
                                        name="awards[1][award]" value="{{ $awards[1]->award ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 mb-md-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="updateStatus"
                                    {{ isset($awards[1]?->status) ? 'checked' : '' }} name="awards[1][status]">
                                <label for="updateStatus" class="d-md-none">Activo</label>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="card-footer d-flex justify-content-end gap-3">
                    <button type="sybmit" class="btn btn-success">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            @if (session('success'))
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            @endif
            @if (session('error'))
                Toast.fire({
                    icon: "error",
                    title: "{{ session('error') }}"
                });
            @endif
        });
    </script>
@endsection

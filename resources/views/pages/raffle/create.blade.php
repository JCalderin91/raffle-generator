@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Configurar rifa</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="quantityNumInput" class="form-label">Cant. Numeros</label>
                                <input type="number" class="form-control" id="quantityNumInput" placeholder="0">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha sorteo</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="price" placeholder="00.00">
                            </div>
                        </div>
                    </div>
                    <h5>Premios</h5>
                    <div class="row">
                        Como es esto?
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-3">
                    <a href="/" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="button" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Listado de participantes</h4>
                </div>
                <div class="card-body">
                    @include('participant.table')
                </div>
            </div>
        </div>
    </div>
@endsection

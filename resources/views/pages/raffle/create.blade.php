@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card">
                <form action="{{ route('raffles.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h4>Configurar rifa</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="quantityNumInput" class="form-label">Cant. Numeros</label>
                                    <input type="number" class="form-control" id="quantityNumInput" placeholder="0" name="numbers" value="20">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Fecha sorteo</label>
                                    <input type="date" class="form-control" id="date" name="draw_date" value="2022-05-05">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="price" placeholder="00.00" name="price" value="20">
                                </div>
                            </div>
                        </div>
                        <h5>Premios</h5>
                        <section id="awards">
                            <div class="row align-items-end">
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="raffleInput" class="form-label">Sorteo</label>
                                        <input type="text" class="form-control" id="raffleInput" placeholder="Chance A" name="awards[0][raffle]" value="Chance A">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="awardInput" class="form-label">Premio</label>
                                        <input type="text" class="form-control" id="awardInput" placeholder="Alimentos" name="awards[0][award]" value="Alimentos">
                                    </div>
                                </div>
                                <div class="col-2 mb-4">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="updateStatus" checked name="awards[0][status]">
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="raffleInput" class="form-label">Sorteo</label>
                                        <input type="text" class="form-control" id="raffleInput" placeholder="Chance A" name="awards[1][raffle]" value="Chance B">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="awardInput" class="form-label">Premio</label>
                                        <input type="text" class="form-control" id="awardInput" placeholder="Alimentos" name="awards[1][award]" value="Mas alimentos">
                                    </div>
                                </div>
                                <div class="col-2 mb-4">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="updateStatus" checked name="awards[1][status]">
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-3">
                        <a href="/" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="sybmit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

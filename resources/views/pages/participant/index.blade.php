@extends('layouts.app')

@section('title')
    Participantes | Generador de rifas
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Listado de participantes <span
                        class="badge rounded-pill text-bg-primary fs-6">{{ $participants->count() }}</span></h4>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#createParticipantModal">Agregar</button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($participants as $key => $participant)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $participant->name }}</td>
                            <td>
                                {{-- <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" {{$participant->status == 1 ? 'checked' : ''}}>
                                </div> --}}

                                @if ($participant->status == 1)
                                    <span class="badge rounded-pill text-bg-success">Activo</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <button onclick="updateHandle({{$participant->id}}, '{{$participant->name}}',{{$participant->status}})" type="button" class="btn btn-sm btn-warning update-button" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                </button>
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
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
        </ul>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="createParticipantModal" tabindex="-1" aria-labelledby="createParticipantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('participants.store') }}" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createParticipantModalLabel">Agregar participante</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Ingrese el nombre" name="name">
                        </div>
                        <div class="form-check form-switch">
                            <input name="status" class="form-check-input" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateParticipantModal" tabindex="-1" aria-labelledby="updateParticipantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateForm" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateParticipantModalLabel">Agregar participante</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="updateName"
                                placeholder="Ingrese el nombre" name="name">
                        </div>
                        <div class="form-check form-switch">
                            <input name="status" class="form-check-input" type="checkbox" role="switch"
                                id="updateStatus" checked>
                            <label class="form-check-label" for="updateStatus">Activo</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const $updateButton = document.querySelector('button.update-button')
        const $updateParticipantModal = new bootstrap.Modal(document.getElementById('updateParticipantModal'))
        const $updateForm = document.querySelector('#updateForm')

        function updateHandle(id, name, status) {
            $updateParticipantModal.show()
            document.querySelector('#updateName').value = name
            document.querySelector('#updateStatus').checked = Boolean(status)
            $updateForm.action = "{{route('participants.index')}}/"+id
        }


    </script>
@endsection

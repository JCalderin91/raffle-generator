@extends('layouts.app')

@section('title')
    Participantes | Generador de rifas - ATIN
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">

            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-8 text-center text-md-start ">
                            <h4>Listado de participantes</h4>
                        </div>
                        <div class="col-12 col-md-4 text-center text-md-end">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#createParticipantModal">Agregar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" style="width: 100px">Estado</th>
                                <th scope="col" style="width: 200px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($participants as $key => $participant)
                                <tr>
                                    <th class="align-content-center " scope="row">{{ $key + 1 }}</th>
                                    <td class="align-content-center ">{{ $participant->name }}</td>
                                    <td class="align-content-center ">
                                        <div class="form-check form-switch">
                                            <input form="previewForm" name="participants[]" value="{{ $participant->id }}"
                                                type="hidden" checked>
                                            <input form="generateForm" name="participants[]" onchange="switchHandle()"
                                                value="{{ $participant->id }}" class="form-check-input participants-switch"
                                                type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </td>
                                    <td class="d-flex gap-1 flex-wrap ">
                                        <button
                                            onclick="updateHandle({{ $participant->id }}, '{{ $participant->name }}',{{ $participant->status }})"
                                            type="button" class="btn btn-sm btn-warning update-button"
                                            title="Editar participante">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                            </svg>
                                        </button>
                                        @if ($participant->ticket)
                                            <a href="{{ route('tickets.print', $participant->ticket->id) }}" target="_blank"
                                                class="btn btn-sm btn-success d-inline-block" title="Vista previa">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-file-earmark-spreadsheet"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z" />
                                                </svg>
                                            </a>
                                        @else
                                            <form action="{{ route('tickets.store') }}" method="post"
                                                class="d-inline-block ticket-generate-form">
                                                @csrf
                                                <input type="hidden" name="participants[]" value="{{ $participant->id }}">
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    title="Generar cartón">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5 5 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        <form id="delete-form-{{ $participant->id }}" method="POST"
                                            action="{{ route('participants.destroy', $participant->id) }}"
                                            class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="destroyHandle({{ $participant->id }})"
                                                class="btn btn-sm btn-danger" title="Eliminar participante">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </button>
                                        </form>
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
                    <div class="row d-flex justify-content-between row">
                        <form class="col-12 col-lg-4 order-1 order-lg-0 mt-3 mt-lg-0 text-center text-lg-start " id="deleteAllForm" action="{{ route('tickets.delete.all') }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                                Borrar todos los cartones</button>
                        </form>
    
                        <section class="d-flex justify-content-center justify-content-lg-end flex-column flex-sm-row  align-items-center gap-2 col-12 col-lg-8 order-0 order-lg-1">
                            <a href="#" id="viewAllBtn" target="_blank" type="button" class="btn btn-success flex-shrink-1 "
                                {{ $participants->count() ? '' : 'disabled' }}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z" />
                                </svg>
                                Ver todos todos</a>
    
                            <form id="generateForm" action="{{ route('tickets.store') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary"
                                    {{ $participants->count() ? '' : 'disabled' }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                                        <path
                                            d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5 5 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334" />
                                    </svg>
                                    Generar todos</button>
                            </form>
                        </section>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
                                placeholder="Ingrese el nombre" name="name" autofocus>
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
                        <h1 class="modal-title fs-5" id="updateParticipantModalLabel">Editar participante</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="updateName" placeholder="Ingrese el nombre"
                                name="name" autofocus>
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
            $updateForm.action = "{{ route('participants.index') }}/" + id
        }

        function destroyHandle(id) {

            Swal.fire({
                title: "¿Está seguro?",
                text: "Los cambios no se podrán revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borralo!",
                cancelButtonText: "No, cancelar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector(`#delete-form-${id}`).submit()
                }
            });


        }

        function switchHandle() {

            const $participantIds = document.querySelectorAll('.participants-switch')
            const $button = document.querySelector('#viewAllBtn')
            const ids = []
            $participantIds.forEach($el => {
                if ($el.checked) ids.push($el.value)
            });
            if (ids.length === 0) {
                $button.classList.add("disabled");
                return
            } else {
                $button.classList.remove("disabled");
            }
            const url = new URL("{{ route('tickets.print.all') }}");
            url.search = new URLSearchParams({
                participants: JSON.stringify(ids),
            });
            const link = $button.setAttribute("href", url);

        }

        document.getElementById('deleteAllForm').addEventListener('submit', function (ev) {
            ev.preventDefault()
            Swal.fire({
                title: "¿Está seguro?",
                text: "Esta acción no se podrá revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borralos!",
                cancelButtonText: "No, cancelar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    ev.target.submit()
                }
            });
        })


        document.addEventListener("DOMContentLoaded", function(event) {
            switchHandle() // init
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

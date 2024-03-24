@extends('layouts.blank')
@section('content')
    <div class="card" style="max-width: 550px">
        <div class="card-header text-center d-flex flex-column gap-2">
            <figure>
                <img src="https://i.ibb.co/vDPqBP4/logo-atin.png" alt="ATIN logo" height="120">
            </figure>
            <div class="text">
                <h2>Rifas de ATIN</h2>
                <h5>Ingresar al sistema</h5>
            </div>
        </div>
        <div class="card-body px-5 py-4">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="emailInput" class="form-label">Nombre de usuario</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person" viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                    </span>
                    <input type="text" class="form-control" id="emailInput" name="username"
                        placeholder="Su nombre de usuario" value="{{ old('username') }}" required>
                </div>
                <label for="passwordInput" class="form-label">Contraseña</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-key" viewBox="0 0 16 16">
                            <path
                                d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                        </svg>
                    </span>
                    <input type="password" class="form-control" id="passwordInput" name="password"
                        placeholder="Su contraseña" value="{{ old('password') }}" required>
                </div>
                @if ($errors->first('username'))
                <div class="alert alert-danger text-center ">
                    {{$errors->first('username')}}
                </div>
                @endif
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary ">Ingresar al sistema</button>
                </div>
            </form>
        </div>
    </div>
@endsection

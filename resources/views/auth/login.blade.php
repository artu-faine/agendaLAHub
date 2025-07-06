@extends('layout')
@section('title','Login')
@section('content')
@include('bckbutton')
{{-- @php echo auth()->user()->name() @endphp --}}
    <div class="h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="create">
            <h1 id="main-title">Login</h1>
            <form id="create-form" action="/aut" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="email" class="form-label">Digite o e-mail:</label>
                <input type="text" class="form-control" name="email"><br>
                <label for="password" class="form-label">Digite a senha: </label>
                <div class="d-flex">
                <input type="password" id="senha" class="form-control" name="password"><button type="button" class="btn btn-primary ms-2" onclick="toggleSenha()">Mostrar</button>
                </div>
                <button class="btn btn-primary mt-2" type="submit">Entrar</button>

            </form>
            <script>
                function toggleSenha() {
                    var senha = document.getElementById("senha");
                    senha.type = senha.type === "password" ? "text" : "password"; 
                }
            </script>
        </div>
    </div>
@endsection
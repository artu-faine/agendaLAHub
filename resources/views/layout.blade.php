<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="/styles.css">
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>@yield('title')</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                @guest
                <div class="nav-item logo">
                    <i class="bi bi-person-circle"></i>
                    <p>Deslogado</p>
                </div>
                <div class="nav-item">
                    <a href="/autLink"><button class="btn btn-primary">Login</button></a>
                    <a href="/register"><button class="btn btn-primary">Registrar</button></a>
                </div>
                @endguest
                @auth
                <div class="nav-item logo">
                    @php
                    $user = auth()->user();
                    @endphp
                    <i class="bi bi-person-circle"></i>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="nav-item d-flex">
                    <a href="/meuDashboard">
                        <button class="btn btn-primary">Meu perfil</button>
                    </a>
                    <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" onclick="event.preventDefault();
                        this.closest('form').submit();"
                        ><button class="btn btn-primary">Sair da conta</button></a>
                    </form>
                </div>
                </div>
                @endauth
            </div>
        </nav>
    </header>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
    @elseif(isset($err))
            <p class="alert alert-danger">{{ $err }}</p>
    @endif
    @if (session('msg'))
    <p class="alert alert-{{session('status')}}">{{session('msg')}}</p>
    @endif
    @yield('content')
    <script>
        // $(document).ready(function(){
            $(".alert").hide();
            $('.alert').slideDown();
            $('.alert').delay('5000');
            $('.alert').slideUp();
        // });
    </script>
</body>
</html>
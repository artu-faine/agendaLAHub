@extends('layout')
@section('title','Criar')
@section('content')
@include('bckbutton')
    <div class="h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="create">
        <h1 id="main-title">Criar</h1>
        <form id="create-form" action="/create" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="nome" class="form-label">Digite o nome:</label>
            <input type="text" class="form-control" name="nome"><br>
            <label for="phone" class="form-label">Digite o telefone: </label>
            <input type="text" class="form-control" name="phone"><br>    
            <button class="btn btn-primary" type="submit">Criar</button>
        </form>
        </div>
    </div>
@endsection
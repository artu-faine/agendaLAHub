@extends('layout')
@section('title','Editar')
@section('content')
@include('bckbutton')
    <div class="h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="create">
        <h1 id="main-title">Editar: {{$contato->nome}}</h1>
            <form id="edit-form" action="/edit/{{$contato->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label class="form-label" for="name">Nome:</label>
                <input class="form-control" type="text" name="nome" value="{{$contato->nome}}"><br>
                <label class="form-label" for="name">Telefone:</label>
                <input class="form-control" type="text" name="phone" value="{{$contato->phone}}"><br>
                <button class="btn btn-primary" type="submit">Enviar</button>
            </form>
        </div>
    </div>
@endsection
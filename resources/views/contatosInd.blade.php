@php
    $user = auth()->user();
    $perfil = $user->name;

    // echo $usuario;
@endphp 
@extends('layout')
@section('title', "Contatos de $perfil")
@section('content')
@include('bckbutton')
    <div class="h-100 d-flex flex-column justify-content-center align-items-center">
    <div class="w-50">
    <h1 id="main-title">Contatos de {{auth()->user()->name}}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="row">#</th>
                    <th scope="row">Nome</th>
                    <th scope="row">Telefone</th>
                    <th scope="row">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contatos as $contato)
                    {{-- @if($contato->user_id == $user->id) --}}
                        <tr>
                            <th scope="row">{{$contato->id}}</th>
                            <th scope="row">{{$contato->nome}}</th>
                            <th scope="row">{{$contato->phone}}</th>
                            <th scope="row">{{ date("d/m/Y")}}</th>
                            <th scope="row"><a href="/edit/{{$contato->id}}"><button class="btn btn-primary">Editar</button></a></th>
                                <form action="/delete/{{$contato->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <th scope="row"><button class="btn btn-primary">Deletar</button></th>
                                </form>
                        </tr>
                    {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
@endsection
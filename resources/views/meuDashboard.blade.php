@php
        $user = auth()->user();
        $perfil = $user->name;
@endphp

@extends('layout')
@section('title',"Perfil de $perfil")
@section('content')
@include('bckbutton')
    {{-- @php
        $user = auth()->user();
    @endphp --}}
    <div class="container position-absolute top-50 start-50 translate-middle d-flex justify-content-center align-items-center">
        <i class="bi bi-person-circle me-5" style="font-size: 300px"></i>
        <div>
        <h1>Nome: {{$user->name}}</h1>
        <h1>E-mail: {{$user->email}}</h1>
        <a href="/contatosInd"><button class="btn btn-primary"><h4>Contatos</h4></button>
        </a>
        </div>
    </div>
@endsection
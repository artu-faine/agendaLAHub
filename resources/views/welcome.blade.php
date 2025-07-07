@extends('layout')
@section('title','Agenda')
@section('content')
    @php
        
    @endphp
    {{-- @if (session('msg'))
    <p class="alert alert-success">{{session('msg')}}</p>
    @endif --}}
    <div class="container position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center">
    <h1 id="main-title">Agenda La</h1>
    <form action="/" method="GET" class="w-50">
    <div class="d-flex">
    <input type="text" class="form-control" name="search" placeholder="Pesquise:">
    <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
    </form>
    {{-- @php
    echo $contatos;
    echo $contatosOwner . "<br>";    
    @endphp --}}
    @if(count($contatos) == 0)
        <p>Ainda não há contatos</p>
    @else
    {{-- @foreach ($contatosOwner as $Owner)
        {{$Owner->name}}<br>
    @endforeach --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Pertence à: </th>
                    <th scope="col">Data: </th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($contatos as $contato)
                    <tr>
                        <th scope="row">{{$contato->id}}</th>
                        <th scope="row">{{$contato->nome}}</th>
                        <th scope="row">{{$contato->phone}}</th>
                        <th scope="row">
                            @foreach ($contatosOwner as $Owner)
                                @if ($contato->user_id == $Owner->id)
                                    {{$Owner->name}}
                                @endif
                            @endforeach
                        </th>
                        <th scope="row">{{date("d/m/Y")}}</th>
                        @can('edit', $contato)
                        <th scope="row"><a href="/edit/{{$contato->id}}"><button class="btn btn-primary">Editar</button></a></th>
                        <form action="/delete/{{$contato->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <th scope="row"><button class="btn btn-primary">Deletar</button></th>
                        </form>
                        @endcan
                    </tr>
                    @endforeach
            </tbody>
        </table>
    @endif
    <div class="w-100">
    <a href="/create"><button class="btn btn-primary">Criar contato</button></a>
    </div>
    </div>
@endsection
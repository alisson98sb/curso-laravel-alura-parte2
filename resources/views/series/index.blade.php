@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')


@if (!empty($mensagem))
<div class="alert alert-success">
    {{ $mensagem }}
</div>
@endif
<a href="{{ route('form_criar_serie')}}" class="btn btn-dark mb-2">Adicionar</a>

<ul class="list-group">
    @foreach ($series as $serie)
    <li class="list-group-item d-flex justify-content-between align-items-center ">
        
        {{ $serie->nome }}
        <span class="d-flex align-items-center">
            <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm m-1 rounded-circle">
                <i class="fas fa-external-link-alt"></i>
            </a>

            <form method="post" action="/series/{{ $serie->id }}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm rounded-circle">
                    <i class="fas fa-trash-alt "></i>
                </button>
            </form>    
        </span>
    </li>
    @endforeach
</ul>

@endsection

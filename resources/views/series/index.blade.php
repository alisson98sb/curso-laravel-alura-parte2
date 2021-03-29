@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')


@include( 'mensagem', ['mensagem' => $mensagem])
@auth
<a href="{{ route('form_criar_serie')}}" class="btn btn-dark mb-2">Adicionar</a>
@endauth

<ul class="list-group">
    @foreach ($series as $serie)
    <li class="list-group-item d-flex justify-content-between align-items-center ">    
    <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

    <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
        <input type="text" class="form-control" value="{{ $serie->nome }}">
        <div class="input-group-append">
            <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                <i class="fas fa-check"></i>
            </button>
            @csrf
        </div>
    </div>

        <span class="d-flex align-items-center">
            @auth
            <button class="btn btn-info btn-sm m-1 rounded-circle" onclick="toggleInput({{ $serie->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth

            <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-success btn-sm m-1 rounded-circle">
                <i class="fas fa-external-link-alt"></i>
            </a>
            @auth
            <form method="post" action="/series/{{ $serie->id }}" 
                  onsubmit="return confirm('Tem certeza que deseja excluir?')">
                
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm rounded-circle m-1">
                    <i class="fas fa-trash-alt "></i>
                </button>
            </form> 
            @endauth   
        </span>
    </li>
    @endforeach
</ul>
<script>
    function toggleInput(serieId) {
    const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
    const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
    if (nomeSerieEl.hasAttribute('hidden')) {
        nomeSerieEl.removeAttribute('hidden');
        inputSerieEl.hidden = true;
    } else {
        inputSerieEl.removeAttribute('hidden');
        nomeSerieEl.hidden = true;
    }
}

    function editarSerie(serieId){
        let formData = new FormData();
        //Pegar o novo nome que foi escrito pelo usuário e armazena-lo na variável "nome";
        const nome = document
            .querySelector(`#input-nome-serie-${serieId} > input`)
            .value
        const token = document.querySelector('input[name="_token"]').value;
        formData.append('nome', nome);
        formData.append('_token', token);

       
        //Enviar a variável "nome" para uma rota
        const url = `/series/${serieId}/editaNome`;

        //Fazer uma requisição para a url
        fetch(url, {
            body: formData,
            method: 'POST'
        }).then( () => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nome;
        });
    }

</script> 
@endsection

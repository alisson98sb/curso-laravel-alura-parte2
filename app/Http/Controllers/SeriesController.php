<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Temporada;
use App\Episodio;

use App;

use App\Services\CriadorDeSerie;
use App\Http\Controllers\TemporadasController;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;


class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()
        ->orderBy('nome')
        ->get();
        $mensagem = $request->session()->get('mensagem');
        
        return view( 'series.index', compact('series', 'mensagem'));  //(variáveis passadas para a view)
    }

    public function create() {
        return view('series.create');
    }

    public function store(
        SeriesFormRequest $request,
        CriadorDeSerie $criadorDeSerie
    ) {
    $serie = $criadorDeSerie->criarSerie(
        $request->nome,
        $request->qtd_temporadas,
        $request->ep_por_temporada
    );
    $request->session()
        ->flash(
            'mensagem',
            "Série {$serie->id} com suas temporadas e episódios criados com sucesso {$serie->nome}"
        );

    return redirect()->route('listar_series');
}

public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
{

    $nomeSerie = $removedorDeSerie->removerSerie($request->id);
    $request->session()
        ->flash(
            'mensagem',
            "Série $nomeSerie removida com sucesso"
        );
    return redirect()->route('listar_series');
}

public function editaNome(int $id, Request $request)
{
    $novoNome       = $request->nome;
    $serie          = Serie::find($id);
    $serie->nome    = $novoNome;
    $serie->save();
}

}

<?php

namespace App\Http\Controllers;
use App\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function index(int $serieId) {
        $serie = Serie::Find($serieId);
        $temporadas = $serie->temporadas;

        return view(
            'temporadas.index', 
            compact('serie','temporadas'));
    }
}

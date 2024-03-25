<?php

namespace App\http\Controllers;

use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware('autenticador')->except('index');
    }

    public function index(Request $request)
    {        
        $series = Series::with(['seasons'])->get(); 
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }
    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        //injeção de dependecia
        $serie = $this->repository->add($request);

        return redirect()
            ->route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Series $series, Request $request)
    {
        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' foi editada com sucesso!");
    }

}
<?php

namespace App\http\Controllers;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Models\Episode;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Season;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use DateTime;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


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
        dd($request);
        $coverPath = $request->hasFile('cover')
            ?  $request->file('cover')->store('series_cover', 'public')
            : null;

        $request->coverPath = $coverPath;
        //injeção de dependecia
        $serie = $this->repository->add($request);
        $seriesCreatedEvent = new EventsSeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason
        );
        event($seriesCreatedEvent);

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
        dd($request);
        $coverPath = $request->file($request->cover);
        dd($coverPath);
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' foi editada com sucesso!");
    }

}
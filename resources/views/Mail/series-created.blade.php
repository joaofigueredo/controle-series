@component('mail::message')
# {{ $nomeSerie }} criada
    
A série {{ $nomeSerie }} com {{$seasonsQty}} temporadas e {{$episodesPerSeason}} episódios foi criado com sucesso

Acesse aqui:
@component('mail::button', ['url' => route('seasons.index', $idSerie)])
Acessar
@endcomponent
@endcomponent
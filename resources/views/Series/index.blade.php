<x-layout title="Séries">
    <ul class="list-group">    
        @foreach($series as $serie)
        <li class="list-group-item">{{ $serie->nome }}</li>
        @endforeach
    </ul>
</x-layout>
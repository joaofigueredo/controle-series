<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    <ul class="list-group">    
        @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            @auth<a href="{{ route('seasons.index', $serie->id) }}" class="link-underline-light">@endauth
                {{ $serie->nome }}
            @auth</a>@endauth
            
            @auth
            <span class="d-flex">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                    E
                </a>
                <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">X</button>
                </form>
                @endauth
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>
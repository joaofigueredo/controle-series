<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    <ul class="list-group">    
        @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
            @if($serie->cover == null)
                <img class="me-3" src="{{ asset('storage/no-file.png') }}" alt="capa" class="img-thumbnail" width="100">
            
            @else
                <img class="me-3" src="{{ asset('storage/' . $serie->cover) }}" alt="capa" class="img-thumbnail" width="100">

            @endif

                @auth<a href="{{ route('seasons.index', $serie->id) }}"     class="link-underline-light">@endauth
                    {{ $serie->nome }}
                @auth</a>@endauth
            </div>
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
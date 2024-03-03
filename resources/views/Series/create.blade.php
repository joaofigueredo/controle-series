<x-layout title="Criar Série">
     <form action="/series/salvar" method="post">
          @csrf
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control">
            <button type="submit" class="btn btn-primary">Adicionar</button>
     </form>
       
</x-layout>
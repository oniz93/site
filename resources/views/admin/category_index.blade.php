@extends('admin.master.layout')

@section('title') Categorie @endsection

@section('content')
    <p>Gestisci da qui le categorie presenti sul sito.</p>

    <hr>

    <p><button class="btn btn-success" id="add_button">+ Aggiungi Categoria</button></p>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Articoli Associati</th>
                <th>Operazioni</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->articles->count() }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info"><span class="fa fa-pencil"></span> Modifica</a>
                        <button type="button" class="btn btn-sm btn-danger delete_button" data-id="{{ $category->id }}"><span class="fa fa-remove"></span> Cancella</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        Nessuna categoria presente, al momento.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="publishModalLabel">Aggiungi Categoria</h4>
                </div>
                <form id="article_publish_form" action="{{ url('admin/categories/add') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <p>Scegli il nome della nuova categoria.</p>
                        <p><input type="text" class="form-control" name="name" id="name" required /></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> Aggiungi</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-remove"></span> Annulla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $('#addModal').on('shown.bs.modal', function(){
            $('#name').focus();
        });

        $('#add_button').click(function(){
            $('#name').val('');
            $('#addModal').modal('toggle');
        });

        $('.delete_button').click(function(){
            if(confirm('Sicuro di voler cancellare questa categoria?')){
                window.location.href = '{{ url('admin/categories/delete') }}/' + $(this).data('id');
            }
        });

    });
</script>
@endsection
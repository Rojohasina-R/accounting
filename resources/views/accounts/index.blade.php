@extends('adminlte::page')

@section('title', 'Plan comptable')

@section('content_header')
    <h1>Liste des comptes</h1>
@stop

@section('content')
    <div class="container pb-4">
        <table id="accounts-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Libellé</th>
                    <th>Type</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr data-id="{{ $account->id }}">
                        <td>{{ $account->code }}</td>
                        <td>{{ $account->name }}</td>
                        <td>{{ ucfirst($account->type) }}</td>
                        <td>
                            <button type="button" class="btn btn-xs" onclick="">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-xs" onclick="destroy({{ $account->id }})">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        const destroy = id => {
            Swal.fire({
              title: 'Êtes-vous sûr?',
              text: "Cette action est irréversible!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Oui, supprimer le compte'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('accounts') }}/${id}`,
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'delete'
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(response){
                        $(`[data-id='${id}']`).remove()
                        Swal.fire(
                          'Supprimé!',
                          "Le compte a été supprimé.",
                          'success'
                        )
                    },
                    error: function(error){
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                        })
                    }
                });
              }
            })
        }

        $(function() {
            $('#accounts-table').DataTable({
                "order": [[ 0, "asc" ]]
            })
        })
    </script>
@stop

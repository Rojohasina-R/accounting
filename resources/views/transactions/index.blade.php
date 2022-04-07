@extends('adminlte::page')

@section('title', 'Liste des Opérations')

@section('content_header')
    <h1>Liste des Opérations</h1>
@stop

@section('content')
    <div class="container pb-4">
        <table id="transactions">
            <thead>
                <tr>
                    <th>Date</th>
                    <th class="d-none">Date</th>
                    <th>Libellé</th>
                    <th>Journal</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr data-id="{{ $transaction->id }}">
                        <td class="d-none">{{ $transaction->date }}</td>
                        <td>{{ $transaction->date->format('d/m/Y') }}</td>
                        <td>
                            <a href="#" onclick="fetchTransaction({{ $transaction->id }})">{{ $transaction->name }}</a>
                        </td>
                        <td>{{ $transaction->journal->name }}</td>
                        <td>
                            <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-xs">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </a>
                            <button type="button" class="btn btn-xs" onclick="destroy({{ $transaction->id }})">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="js-transaction-modal-partial"></div>
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
              confirmButtonText: 'Oui'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('transactions') }}/${id}`,
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
                          "L'opération a été supprimée.",
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

        const fetchTransaction = id => {
            fetch(`/partials/transactions/${id}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("js-transaction-modal-partial").innerHTML = html
                    $('#transaction-modal').modal('show')
                })
                .catch(error => toastr.error('Something went wrong'))
        }

        $(function() {
            $('#transactions').DataTable({
                "order": [[ 0, "desc" ]]
            })
        })
    </script>
@stop

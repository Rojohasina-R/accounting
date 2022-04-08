@extends('adminlte::page')

@section('title', 'Plan comptable')

@section('content_header')
    <h1>Liste des comptes</h1>
    <a href="{{ route('accounts.create') }}" class="btn btn-primary">Ajouter un compte</a>
@stop

@section('content')
    <div class="container pb-4" id="js-accounts-partial">
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        @if(session()->has('success'))
            toastr["success"]("{{ session()->get('success') }}")
        @endif

        const fetchAccounts = () => {
            fetch(`/partials/accounts`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("js-accounts-partial").innerHTML = html
                    $('#accounts-table').DataTable({
                        "order": [[ 0, "asc" ]],
                        "columnDefs": [
                            { "type": "string", "targets": 0 }
                        ],
                    })
                })
                .catch(error => toastr.error('Something went wrong'))
        }

        fetchAccounts()

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
                        fetchAccounts()
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
    </script>
@stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Grand Livre</h1>
@stop

@section('content')
    <div class="col-12 col-md-6 mx-auto border p-3">
        <x-adminlte-select id="account_id" class="custom-select" name="account_id" label="Compte">
            <option value="">Sélectionner un compte</option>
            @foreach ($accounts as $account)
                <option value="{{ $account->id }}">{{ $account->name }}</option>
            @endforeach
        </x-adminlte-select>
        <x-adminlte-button label="Générer" class="btn-sm" theme="primary" type="button" onclick="fetchLines()" />
    </div>
    <div class="container py-4" id="js-grand-livre-partial">
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        const fetchLines = () => {
            const account_id = $('#account_id').val()
            fetch(`/partials/grand-livre/${account_id}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("js-grand-livre-partial").innerHTML = html
                    $('#lines').DataTable({
                        "order": [[ 0, "desc" ]]
                    })
                })
        }
    </script>
@stop

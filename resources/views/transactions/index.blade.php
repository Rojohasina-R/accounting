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
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="d-none">{{ $transaction->date }}</td>
                        <td>{{ $transaction->date->format('d/m/Y') }}</td>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->journal->name }}</td>
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
        $(function() {
            $('#transactions').DataTable({
                "order": [[ 0, "desc" ]]
            })
        })
    </script>
@stop

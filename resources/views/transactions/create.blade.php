@extends('adminlte::page')

@section('title', 'Nouvelle Opération')

@section('content_header')
    <h1>Enregistrer une opération</h1>
@stop

@section('content')
    <div class="col-12 col-md-6 mx-auto">
        @include('transactions._form', [
            'url' => route('transactions.store'),
            'buttonText' => 'Enregistrer',
        ])
    </div>
@stop

@section('css')

@stop

@section('js')
    @include('transactions._script')
@stop

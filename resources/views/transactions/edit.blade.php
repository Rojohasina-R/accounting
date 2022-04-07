@extends('adminlte::page')

@section('title', $transaction->name)

@section('content_header')
    <h1>Modifier opération</h1>
@stop

@section('content')
    <div class="col-12 col-md-6 mx-auto">
        @include('transactions._form', [
            'url' => route('transactions.update', $transaction),
            'transaction' => $transaction,
            'buttonText' => 'Modifier',
        ])
    </div>
@stop

@section('css')

@stop

@section('js')
    @include('transactions._script')
@stop

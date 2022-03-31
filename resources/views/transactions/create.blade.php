@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Header text</h1>
@stop

@section('content')
    <div class="w-50 mx-auto">
        <h1 class="mb-3">Enregistrer une opération</h1>
        <form method="POST" action="/transactions">
            @csrf
            <x-adminlte-select name="journal_id" label="Journal">
                <option value="">Sélectionner un journal</option>
                @foreach ($journals as $journal)
                    <option value="{{ $journal->id }}">{{ $journal->name }}</option>
                @endforeach
            </x-adminlte-select>
            <x-adminlte-input name="name" type="text" placeholder="Libellé de l'écriture" label="Libellé de l'écriture"/>
            @php
                $config = ['format' => 'DD/MM/YYYY'];
                $today = date('d/m/Y');
            @endphp
            <x-adminlte-input-date :value="$today" :config="$config" name="date" label="Date de l'opération" placeholder="Date de l'opération" enable-old-support="true" />
            <x-adminlte-button label="Enregistrer" theme="primary" type="submit" />
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

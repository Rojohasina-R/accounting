@extends('adminlte::page')

@section('title', $transaction->name)

@section('content_header')
    <h1>Modifier opération</h1>
@stop

@section('content')
    <div class="col-12 col-md-6 mx-auto">
        <form method="POST" action="{{ route('transactions.update', $transaction) }}" id="transaction-form">
            @csrf
            <x-adminlte-select name="journal_id" class="custom-select" label="Journal">
                <option value="">Sélectionner un journal</option>
                @foreach ($journals as $journal)
                    <option value="{{ $journal->id }}" {{ $transaction->journal_id === $journal->id ? 'selected' : '' }}>
                        {{ $journal->name }}
                    </option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-input name="name" type="text" placeholder="Libellé de l'écriture" label="Libellé de l'écriture" :value="$transaction->name"/>

            @php
                $config = ['format' => 'DD/MM/YYYY'];
            @endphp
            <x-adminlte-input-date :value="$transaction->date->format('d/m/Y')" :config="$config" name="date" label="Date de l'opération" placeholder="Date de l'opération" enable-old-support="true" />

            @include('transactions._details', ['lines' => $transaction->lines])

            <x-adminlte-button label="Enregistrer" theme="primary" type="button" onclick="customSubmit()" />
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')
    @include('transactions._script')
@stop

@extends('adminlte::page')

@section('title', $account->name)

@section('content_header')
    <h1>Modifier un compte</h1>
@stop

@section('content')
    <div class="col-12 col-md-6 mx-auto">
        <form method="post" action="{{ route('accounts.update', $account) }}">
            @csrf
            @method('put')
            <x-adminlte-input name="code" type="text" placeholder="Code" label="Code" enable-old-support :value="$account->code"/>
            <x-adminlte-input name="name" type="text" placeholder="Libellé" label="Libellé" enable-old-support :value="$account->name"/>
            <div class="form-group">
                <label>Type</label>
                <div class="ml-4">
                    @foreach (['actif', 'passif', 'charge', 'produit'] as $type)
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="{{ $type }}" name="type" value="{{ $type }}" {{ $account->type === $type ? 'checked' : '' }}>
                          <label class="custom-control-label font-weight-normal" for="{{ $type }}">{{ ucfirst($type) }}</label>
                        </div>
                    @endforeach
                </div>
                @error('type')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <x-adminlte-button label="Modifier" theme="primary" type="submit" />
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop

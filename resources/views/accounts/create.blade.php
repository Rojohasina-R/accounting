@extends('adminlte::page')

@section('title', 'Nouveau compte')

@section('content_header')
    <h1>Ajouter un compte</h1>
@stop

@section('content')
    <div class="col-12 col-md-6 mx-auto">
        <form method="post" action="{{ route('accounts.store') }}">
            @csrf
            <x-adminlte-input name="code" type="text" placeholder="Code" label="Code" enable-old-support/>
            <x-adminlte-input name="name" type="text" placeholder="Libellé" label="Libellé" enable-old-support/>
            <div class="form-group">
                <label>Type</label>
                <div class="ml-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="actif" name="type" value="actif">
                      <label class="custom-control-label font-weight-normal" for="actif">Actif</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="passif" name="type" value="passif">
                      <label class="custom-control-label font-weight-normal" for="passif">Passif</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="charge" name="type" value="charge">
                      <label class="custom-control-label font-weight-normal" for="charge">Charge</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" id="produit" name="type" value="produit">
                      <label class="custom-control-label font-weight-normal" for="produit">Produit</label>
                    </div>
                </div>
                @error('type')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <x-adminlte-button label="Ajouter" theme="primary" type="submit" />
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')
    @include('transactions._script')
@stop

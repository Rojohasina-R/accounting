@extends('adminlte::page')

@section('title', 'Compte de résultat')

@section('content_header')
    <h1>Compte de résultat</h1>
@stop

@section('content')
    <div class="col-12 col-md-9 mx-auto">

        <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th class="text-center">Charges</th>
                  <th class="text-center">Produits</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                      @foreach ($charges as $charge)
                        <p class="{{ $loop->last ? 'mb-0' : '' }}">
                            <span>{{ $charge['name'] }}: </span>
                            <span class="float-right">{{ $charge['formatted_total'] }}</span>
                        </p>
                      @endforeach
                  </td>
                  <td>
                      @foreach ($produits as $produit)
                        <p class="{{ $loop->last ? 'mb-0' : '' }}">
                            <span>{{ $produit['name'] }}: </span>
                            <span class="float-right">{{ $produit['formatted_total'] }}</span>
                        </p>
                      @endforeach
                  </td>
                </tr>
                <tr>
                  <td>
                      <div>
                          <span>Total des charges: </span>
                          <span class="float-right">{{ $totalCharges }}</span>
                      </div>
                  </td>
                  <td>
                      <div>
                          <span>Total des produits: </span>
                          <span class="float-right">{{ $totalProduits }}</span>
                      </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-center">
                      Résultat: {{ $resultat }}
                  </td>
                </tr>
              </tbody>
            </table>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="">
@stop

@section('js')
    <script type="text/javascript"></script>
@stop

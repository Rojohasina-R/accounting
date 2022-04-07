@extends('adminlte::page')

@section('title', 'Bilan')

@section('content_header')
    <h1>Bilan</h1>
@stop

@section('content')
    <div class="col-12 col-md-9 mx-auto">

        <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th class="text-center">Actif</th>
                  <th class="text-center">Passif</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                      @foreach ($actifs as $actif)
                        <p class="{{ $loop->last ? 'mb-0' : '' }}">
                            <span>{{ $actif['name'] }}: </span>
                            <span class="float-right">{{ $actif['total'] }}</span>
                        </p>
                      @endforeach
                  </td>
                  <td>
                      @foreach ($passifs as $passif)
                        <p class="{{ $loop->last ? 'mb-0' : '' }}">
                            <span>{{ $passif['name'] }}: </span>
                            <span class="float-right">{{ $passif['total'] }}</span>
                        </p>
                      @endforeach
                  </td>
                </tr>
                <tr>
                  <td>
                      <div>
                          <span>Total des actifs: </span>
                          <span class="float-right">{{ $totalActif }}</span>
                      </div>
                  </td>
                  <td>
                      <div>
                          <span>Total des passifs: </span>
                          <span class="float-right">{{ $totalPassif }}</span>
                      </div>
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

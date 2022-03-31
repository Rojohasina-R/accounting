@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Header text</h1>
@stop

@section('content')
    <div class="col-12 col-md-6 mx-auto">
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

            <label>Détails</label>
            <button type="button" class="btn btn-sm btn-secondary float-right mb-2" onclick="newLine()">Ajouter une ligne</button>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                  <thead class="thead-light">
                    <tr>
                      <th class="w-50">Compte</th>
                      <th class="w-25">Débit</th>
                      <th class="w-25">Crédit</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="lines">
                    <tr class="line">
                      <td>
                        <select name="account_id">
                            <option value="">Compte</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">
                                    {{ $account->code . '. ' . $account->name }}
                                </option>
                            @endforeach
                        </select>
                      </td>
                      <td><input name="debit" type="number" class="w-100 small"></td>
                      <td><input name="credit" type="number" class="w-100 small"></td>
                      <td>
                        <button type="button" class="btn btn-xs" onclick="removeLine(event)">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>

            <x-adminlte-button label="Enregistrer" theme="primary" type="button" onclick="customSubmit()" />
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        customSubmit = () => {
            const lines = []
            const input = document.getElementsByClassName('line')
            for (let i = 0; i < input.length; i++) {
                const element = input[i]
                lines.push({
                    account_id: element.querySelector("[name='account_id']").value,
                    debit: element.querySelector("[name='debit']").value,
                    credit: element.querySelector("[name='credit']").value,
                })
            }
            const data = {
                _token: $("input[name='_token']").val(),
                name: $("input[name='name']").val(),
                journal_id: $("select[name='journal_id']").val(),
                date: $("input[name='date']").val(),
                lines: lines
            }

            $.ajax({
                url: "{{route('transactions.store')}}",
                data: data,
                method: 'post',
                dataType: 'json',
                success: function(response){
                    console.log(response)
                },
                error: function(error){
                    console.log(error)
                }
            });
        }

        removeLine = (event) => {
            event.target.closest('.line').remove()
        }

        newLine = () => {
            $('#lines').append(`
                <tr class="line">
                  <td>
                    <select name="account_id">
                        <option value="">Compte</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">
                                {{ $account->code . '. ' . $account->name }}
                            </option>
                        @endforeach
                    </select>
                  </td>
                  <td><input name="debit" type="number" class="w-100 small"></td>
                  <td><input name="credit" type="number" class="w-100 small"></td>
                  <td>
                    <button type="button" class="btn btn-xs" onclick="removeLine(event)">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>
            `)
        }
    </script>
@stop

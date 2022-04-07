<form method="POST" action="{{ $url }}" id="transaction-form">
    @csrf
    <x-adminlte-select name="journal_id" class="custom-select" label="Journal">
        <option value="">Sélectionner un journal</option>
        @foreach ($journals as $journal)
            <option value="{{ $journal->id }}" {{ (isset($transaction) && $transaction->journal_id === $journal->id) ? 'selected' : '' }}>
                {{ $journal->name }}
            </option>
        @endforeach
    </x-adminlte-select>

    <x-adminlte-input name="name" type="text" placeholder="Libellé de l'écriture" label="Libellé de l'écriture" value="{{ isset($transaction) ? $transaction->name : '' }}"/>

    @php
        $config = ['format' => 'DD/MM/YYYY'];
        $date = isset($transaction) ? $transaction->date->format('d/m/Y') : date('d/m/Y');
    @endphp
    <x-adminlte-input-date :value="$date" :config="$config" name="date" label="Date de l'opération" placeholder="Date de l'opération" />

    @include('transactions._details', [
        'lines' => isset($transaction) ? $transaction->lines : null
    ])

    <x-adminlte-button :label="$buttonText" theme="primary" type="button" onclick="customSubmit()" />
</form>

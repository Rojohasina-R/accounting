<x-adminlte-modal id="transaction-modal" :title="$transaction->name" size="lg" v-centered>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="4" class="text-center">
                    {{ $transaction->journal->display . ' / ' . ucfirst($transaction->date->translatedFormat('l j F Y', 'fr')) }}
                </th>
            </tr>
            <tr>
                <th>N° Compte</th>
                <th>Libellé</th>
                <th>Débit</th>
                <th>Crédit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->lines as $line)
                <tr>
                    <td>{{ $line->account->code }}</td>
                    <td>{{ $line->account->name }}</td>
                    <td>{{ $line->debit }}</td>
                    <td>{{ $line->credit }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-center">
                    {{ $transaction->name }}
                </td>
            </tr>
        </tfoot>
    </table>
</x-adminlte-modal>

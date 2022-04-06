<table id="lines">
    <thead>
        <tr>
            <th>Date</th>
            <th>Libellé</th>
            <th>Débit</th>
            <th>Crédit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lines as $line)
            <tr>
                <td>{{ $line->transaction->date }}</td>
                <td>{{ $line->transaction->name }}</td>
                <td>{{ $line->debit }}</td>
                <td>{{ $line->credit }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table id="accounts-table">
    <thead>
        <tr>
            <th>Code</th>
            <th>Libellé</th>
            <th>Type</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $account)
            <tr data-id="{{ $account->id }}">
                <td>{{ $account->code }}</td>
                <td>{{ $account->name }}</td>
                <td>{{ ucfirst($account->type) }}</td>
                <td>
                    <a href="{{ route('accounts.edit', $account) }}" class="btn btn-xs">
                        <i class="fa fa-pen" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-xs" onclick="destroy({{ $account->id }})">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<tr class="line">
  <td>
    <select name="account_id">
        <option value="">Compte</option>
        @foreach($accounts as $account)
            <option value="{{ $account->id }}" {{ (isset($line) && $line->account_id === $account->id) ? 'selected' : '' }}>
                {{ $account->code . '. ' . $account->name }}
            </option>
        @endforeach
    </select>
  </td>
  <td><input name="debit" type="number" step="0.01" class="w-100 small" value="{{ isset($line) ? $line->debit : '' }}"></td>
  <td><input name="credit" type="number" step="0.01" class="w-100 small" value="{{ isset($line) ? $line->credit : '' }}"></td>
  <td>
    <button type="button" class="btn btn-xs" onclick="removeLine(event)">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
  </td>
</tr>

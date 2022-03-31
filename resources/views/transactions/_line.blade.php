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

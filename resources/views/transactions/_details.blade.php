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
        @include('transactions._line')
      </tbody>
    </table>
</div>

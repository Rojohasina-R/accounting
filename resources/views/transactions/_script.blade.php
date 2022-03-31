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
            _token: "{{ csrf_token() }}",
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
        $('#lines').append(`@include('transactions._line')`)
    }
</script>

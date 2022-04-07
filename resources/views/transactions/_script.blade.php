<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "0",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
</script>
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
                toastr.success("L'opération a été enregistrée avec succès")
                $('.line').remove()
                newLine()
                document.getElementById("transaction").reset()
            },
            error: function(error){
                if (!error.responseJSON)
                    toastr.error('Something went wrong')
                else {
                    const errors = error.responseJSON.errors
                    let errorMessage = '<ul>'
                    for (let error of Object.values(errors)) {
                        errorMessage = `${errorMessage}<li>${error[0]}</li>`
                    }
                    errorMessage += '</ul>'
                    toastr.error(errorMessage)
                }
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

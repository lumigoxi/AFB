function verifyInfoContact(email, telephone) {
    let emailLength = email.val().length
    let telephoneLength = telephone.val().length
    return (emailLength > 4 || telephoneLength > 7) ? 1 : 0
}

function validateLength(lenghtTel) {
    return (lenghtTel > 7 && lenghtTel < 9) ? 1 : 0
}

function verifyCheck(checkTel, checkEmail) {
    return (checkTel.prop('checked') || checkEmail.prop('checked')) ? 1 : 0
}

function clearForm() {
    $('#modalContact').modal('toggle')
    $('#name').val('')
    $('#lastName').val('')
    $('#email').val('')
    $('#tel').val('')
    $('#reason').val(1)
    $('#description').val('')
    grecaptcha.reset();
    $('#check-tel').prop('checked', false)
    $('#check-email').prop('checked', false)
}

function sendForm(field) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    })
    if (field == 6) {
        let data = $('#formContact').serialize()
        let url = window.location.href
        url = String(url) + '/formContact'
        $.ajax({
            type: 'post',
            data: data,
            url: url,
            success: function(data) {
                if (data) {
                    clearForm()
                    Toast.fire({
                        type: 'success',
                        title: 'El mensaje fue enviado exitosamente'
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        title: 'ALgo salío mal, intente de nuevo'
                    })
                }
            },
            error: function(errors) {
                $.each(errors.responseJSON.errors, function(value, key) {
                    $.each(key, function(value, key) {
                        Toast.fire({
                            type: 'error',
                            title: key
                        })
                    })
                })
            }
        })
    }
}

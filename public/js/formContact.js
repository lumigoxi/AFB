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

function clearFormAdopt() {
    $('#modalAdopt').modal('toggle')
    $('#name').val('')
    $('#lastName').val('')
    $('#email').val('')
    $('#tel').val('')
    $('#message').val('')
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





//set data-pet to farom requesst pet
$('.requestPet').on('click', function(e) {
    e.preventDefault()
    let pet = $(this).attr('data-pet')
    $('#formAdopt').attr('data-pet', pet)
})



//set  form request pet
$('#formAdopt').on('submit', function(e) {
    field = 0
    e.preventDefault()
    let name = $('#name')
    let lastName = $('#lastName')
    let email = $('#email')
    let telephone = $('#tel')
    let checkTel = $('#check-tel')
    let checkEmail = $('#check-email')
    let checkOne = verifyCheck(checkTel, checkEmail)
    let description = $('#message')
    let validateContact = verifyInfoContact(email, telephone)
    if (name.val().length < 3) {
        name.addClass('border border-danger')
        $('.msgDanger-name').text('Este campo es requerido')
        field--
    } else {
        field++
    }
    if (lastName.val().length < 3) {
        lastName.addClass('border border-danger')
        $('.msgDanger-lastName').text('Este campo es obligatorio')
        field--
    } else {
        field++
    }
    if (validateContact) {
        email.removeClass('border border-danger')
        telephone.removeClass('border border-danger')
        $('.msgDanger-tel').text('')
        $('.msgDanger-email').text('')
        field++
    } else {
        email.addClass('border border-danger')
        telephone.addClass('border border-danger')
        $('.msgDanger-tel').text('Al menos un campo es obligatorio')
        $('.msgDanger-email').text('Al menos un campo es obligatorio')
        field--
    }
    if ($('#message').val().length <= 10) {
        field--
        $('#message').addClass('border border-danger')
        $('.msgDanger-msg').text('Debes enviar un mensaje')
    } else {
        description.removeClass('border border-danger')
        $('.msgDanger-msg').text('')
        field += 2
    }


    let emailCheck = emailSyntaxis.test(email.val())
    if (!emailCheck && telephone.val().length < 7 && telephone.val().length > 8) {
        email.addClass('border border-danger')
        $('.msgDanger-email').text('Es un correo invalido')
        $('#check-email').prop('checked', false)
    } else {
        email.removeClass('border border-danger')
    }

    if (checkOne) {
        field++
    } else {
        field--
    }

    let response = sendRequest(field, $(this).attr('data-pet'))

})


$('#message').on('keypress keyup', function(e) {
    let description = $(this)
    if (description.val().length < 10) {
        description.addClass('border border-danger')
        $('.msgDanger-msg').text('Debe de proporcionar informacion para esta opción')
        field--
    } else {

        description.removeClass('border border-danger')
        $('.msgDanger-msg').text('')
        field += 2
    }
})

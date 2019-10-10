function msgOption() {
    $('#reason').addClass('border border-danger');
    $('.msgDanger-reason').text('Debes escoger una opción')
}

$('#reason').change(function(e) {
    $('#reason').removeClass('border border-danger');
    $('.msgDanger-reason').text('')
    let option = $(this).val()
    let span = $('#description').siblings('label').children('span')
    if (option == 4) {
        span.text('(Obligatorio)')
        $('#description').attr('Placeholder', 'Cuentanos :)')
    } else if (option == 3) {
        span.text('(Obligatorio)')
        $('#description').attr('Placeholder', 'Brindanos de datos importantes como lugar y notas adicionales')
    } else {
        span.text('(Opcional)')
        $('#description').attr('Placeholder', 'Dinos en que te gustaría ayudar')
        $('.msgDanger-msg').text('')
        $('#description').removeClass('border border-danger')
    }
    if (option == 1) {
        msgOption()
    }
})


let field
$('#formContact').on('submit', function(e) {
    field = 0
    e.preventDefault()
    let name = $('#name')
    let lastName = $('#lastName')
    let email = $('#email')
    let telephone = $('#tel')
    let reason = $('#reason').val()
    let checkTel = $('#check-tel')
    let checkEmail = $('#check-email')
    let checkOne = verifyCheck(checkTel, checkEmail)
    let description = $('#description')
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
    let reasonInt = parseInt(reason, 10)
    if (reasonInt < 2) {
        field--
        msgOption()
    } else {
        description.removeClass('border border-danger')
        $('.msgDanger-msg').text('')
        field++
    }

    if (reasonInt >= 3 && description.val() == '') {
        description.addClass('border border-danger')
        $('.msgDanger-msg').text('Para esta opcion este campo es obligatorio')
        field += 2
    } else {
        description.removeClass('border border-danger')
        $('.msgDanger-msg').text('')
        field++
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

    let responde = sendForm(field)

})


$('#tel').on('keypress keyup', function(e) {
    let telephone = $('#tel')
    let email = $('#email')
    let lengthTel = $(this).val().length
    let length = validateLength(lengthTel)
    if (length) {
        telephone.removeClass('border border-danger')
        $('.msgDanger-tel').text('')
        $('#check-tel').prop('checked', true)
        $('.msgDanger-email').text('')
        email.removeClass('border border-danger')
    } else {
        telephone.addClass('border border-danger')
        $('.msgDanger-tel').text('El número es invalido')
        $('#check-tel').prop('checked', false)
    }

    if (lengthTel == 0) {
        telephone.removeClass('border border-danger')
        email.removeClass('border border-danger')
        $('.msgDanger-tel').text('')
        $('.msgDanger-email').text('')
    }
})

const emailSyntaxis = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
$('#email').on('keypress keyup', function(e) {
    let telephone = $('#tel')
    let email = $('#email')
    let emailCheck = emailSyntaxis.test(email.val())

    if (emailCheck) {
        telephone.removeClass('border border-danger')
        email.removeClass('border border-danger')
        $('.msgDanger-tel').text('')
        $('.msgDanger-email').text('')
        $('#check-email').prop('checked', true)
    } else if (email.val().length > 20 && telephone.val().length != 8) {
        email.addClass('border border-danger')
        $('.msgDanger-email').text('Es un correo invalido')
        $('#check-email').prop('checked', false)
    } else {
        email.addClass('border border-danger')
        $('.msgDanger-email').text('Es un correo invalido')
        $('#check-email').prop('checked', false)
    }
    if (email.val().length == 0) {
        telephone.removeClass('border border-danger')
        email.removeClass('border border-danger')
        $('.msgDanger-tel').text('')
        $('.msgDanger-email').text('')
        $('#check-email').prop('checked', false)

    }
})

$('#description').on('keypress keyup', function(e) {
    let description = $(this)
    let option = $('#reason').val()
    if (option > 2 && description.val().length < 15) {
        description.addClass('border border-danger')
        $('.msgDanger-msg').text('Debe de proporcionar informacion para esta opción')
    } else {
        description.removeClass('border border-danger')
        $('.msgDanger-msg').text('')
    }
})

$('#name').on('keypress keyup', function(e) {
    let name = $(this)
    if (name.val().length < 3) {
        name.addClass('border border-danger')
        $('.msgDanger-name').text('Nombre no valido')
    } else {
        name.removeClass('border border-danger')
        $('.msgDanger-name').text('')
    }
})

$('#lastName').on('keypress keyup', function(e) {
    let lastName = $(this)
    if (lastName.val().length < 3) {
        lastName.addClass('border border-danger')
        $('.msgDanger-lastName').text('Apellido no valido')
    } else {
        lastName.removeClass('border border-danger')
        $('.msgDanger-lastName').text('')
    }
})

$('#tel').keyup(function() {
    this.value = (this.value + '').replace(/[^0-9+]/g, '');
})

$('#name').keyup(function() {
    this.value = (this.value + '').replace(/[^a-zA-ZñáéíóúÁÉÍÓÚÑ-]/g, '');
})

$('#lastName').keyup(function() {
    this.value = (this.value + '').replace(/[^a-zA-ZñáéíóúÁÉÍÓÚÑ-]/g, '');
})

$("#check-email").change(function() {
    if (!this.checked) {
        let email = $('#email')
        let emailCheck = emailSyntaxis.test(email.val())
        if (emailCheck) {
            $(this).prop('checked', true)
        }
    } else {
        $(this).prop('checked', false)
    }
})

$("#check-tel").change(function() {
    if (!this.checked) {
        let telephone = $('#tel')
        if (telephone.val().length > 7 && telephone.val().length < 9) {
            $(this).prop('checked', true)
        } else {
            $(this).prop('checked', false)
        }
    } else {
        $(this).prop('checked', false)
    }
})

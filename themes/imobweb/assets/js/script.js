$(document).ready(function () {
    /*
    * jQuery MASK
    */
    var options = {
        translation: {
            "X": { pattern: /[X0-9]/ }
        }, reverse: true
    }
    $("#cpf").mask("000.000.000-00", { reverse: true })
    $("#cnpj").mask("00.000.000/0000-00")
    // $("#price").mask("999.999.990,00", { reverse: true })
    $("#rg").mask("999.999.999-X", options)
    $("#phone").mask("(99) 0000-00009")
    $("#phone").blur(function (event) {
        if ($(this).val().length == 15) {
            $("#phone").mask("(99) 00000-0009")
        } else {
            $("#phone").mask("(99) 0000-00009")
        }
    })





    /*Advanced Filter*/
    var btn = document.querySelector('.advanced_hidden');
    var container = document.querySelector('.advanced_filter');

    btn.addEventListener('click', function () {
        if (container.style.display === 'none') {
            container.style.display = 'flex';
        } else {
            container.style.display = 'none';
        }
    });

    //FIM Script
})
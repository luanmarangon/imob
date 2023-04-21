

// JQUERY INIT

$(function () {
    var ajaxResponseBaseTime = 3;

    // MOBILE MENU

    $(".mobile_menu").click(function (e) {
        e.preventDefault();

        var menu = $(".dash_sidebar");
        menu.animate({ right: 0 }, 200, function (e) {
            $("body").css("overflow", "hidden");
        });

        menu.one("mouseleave", function () {
            $(this).animate({ right: '-260' }, 200, function (e) {
                $("body").css("overflow", "auto");
            });
        });
    });

    //NOTIFICATION CENTER

    $(".notification_center_open").click(function (e) {
        e.preventDefault();

        var center = $(".notification_center");
        center.css("display", "block").animate({ right: 0 }, 200, function (e) {
            $("body").css("overflow", "hidden");
        });

        center.one("mouseleave", function () {
            $(this).animate({ right: '-320' }, 200, function (e) {
                $("body").css("overflow", "auto");
                $(this).css("display", "none");
            });
        });
    });

    //FORMS

    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var load = $(".ajax_load");

        if (typeof tinyMCE !== 'undefined') {
            tinyMCE.triggerSave();
        }

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            uploadProgress: function (event, position, total, completed) {
                var loaded = completed;
                var load_title = $(".ajax_load_box_title");
                load_title.text("Enviando (" + loaded + "%)");

                form.find("input[type='file']").val(null);
                if (completed >= 100) {
                    load_title.text("Aguarde, carregando...");
                }
            },
            success: function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    load.fadeOut(200);
                }

                //reload
                if (response.reload) {
                    window.location.reload();
                } else {
                    load.fadeOut(200);
                }

                //message
                if (response.message) {
                    ajaxMessage(response.message, ajaxResponseBaseTime);
                }

                //image by fsphp mce upload
                if (response.mce_image) {
                    $('.mce_upload').fadeOut(200);
                    tinyMCE.activeEditor.insertContent(response.mce_image);
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {
                var message = "<div class='message error icon-warning'>Desculpe mas não foi possível processar sua requisição...</div>";
                ajaxMessage(message, 5);
                load.fadeOut();
            }
        });
    });

    // AJAX RESPONSE

    function ajaxMessage(message, time) {
        var ajaxMessage = $(message);

        ajaxMessage.append("<div class='message_time'></div>");
        ajaxMessage.find(".message_time").animate({ "width": "100%" }, time * 1000, function () {
            $(this).parents(".message").fadeOut(200);
        });

        $(".ajax_response").append(ajaxMessage);
    }

    // AJAX RESPONSE MONITOR

    $(".ajax_response .message").each(function (e, m) {
        ajaxMessage(m, ajaxResponseBaseTime += 1);
    });

    // AJAX MESSAGE CLOSE ON CLICK

    $(".ajax_response").on("click", ".message", function (e) {
        $(this).effect("bounce").fadeOut(1);
    });

    // MAKS
    var options = {
        translation: {
            "X": { pattern: /[X0-9]/ }
        }, reverse: true
    };

    $(".mask-date").mask('00/00/0000', { placeholder: "00/00/0000" });
    $(".mask-datetime").mask('00/00/0000 00:00');
    $(".mask-month").mask('00/0000', { reverse: true });
    $(".mask-doc").mask('000.000.000-00', { reverse: true });
    $(".mask-card").mask('0000  0000  0000  0000', { reverse: true });
    $(".mask-money").mask('000.000.000.000.000,00', { reverse: true, placeholder: "0,00" });
    $(".mask-cpf").mask("000.000.000-00", { reverse: true });
    $(".mask-cnpj").mask("00.000.000/0000-00");
    $(".mask-cep").mask("00.000-000");
    // $("#price").mask("999.999.990,00", { reverse: true })
    $(".mask-rg").mask("999.999.999-X", options)
    $(".mask-phone").mask("(99) 0000-00009")
    // $(".mask-phone").mask("(99) 0000-00009", { placeholder: "(XX) XXXXX-XXXX" })
    $(".mask-phone").blur(function (event) {
        if ($(this).val().length == 15) {
            $(".mask-phone").mask("(99) 00000-0009")
        } else {
            $(".mask-phone").mask("(99) 0000-00009")
        }
    })
    $('.mask-email').mask("A", {
        translation: {
            "A": { pattern: /[\w@\-.+]/, recursive: true }
        }
    });

    // TINYMCE INIT

    tinyMCE.init({
        selector: "textarea.mce",
        language: 'pt_BR',
        menubar: false,
        theme: "modern",
        height: 132,
        skin: 'light',
        entity_encoding: "raw",
        theme_advanced_resizing: true,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor media"
        ],
        toolbar: "styleselect | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist | alignleft | aligncenter | alignright |  link | unlink | fsphpimage | code | fullscreen",
        style_formats: [
            { title: 'Normal', block: 'p' },
            { title: 'Titulo 3', block: 'h3' },
            { title: 'Titulo 4', block: 'h4' },
            { title: 'Titulo 5', block: 'h5' },
            { title: 'Código', block: 'pre', classes: 'brush: php;' }
        ],
        link_class_list: [
            { title: 'None', value: '' },
            { title: 'Blue CTA', value: 'btn btn_cta_blue' },
            { title: 'Green CTA', value: 'btn btn_cta_green' },
            { title: 'Yellow CTA', value: 'btn btn_cta_yellow' },
            { title: 'Red CTA', value: 'btn btn_cta_red' }
        ],
        setup: function (editor) {
            editor.addButton('fsphpimage', {
                title: 'Enviar Imagem',
                icon: 'image',
                onclick: function () {
                    $('.mce_upload').fadeIn(200, function (e) {
                        $("body").click(function (e) {
                            if ($(e.target).attr("class") === "mce_upload") {
                                $('.mce_upload').fadeOut(200);
                            }
                        });
                    }).css("display", "flex");
                }
            });
        },
        link_title: false,
        target_list: false,
        theme_advanced_blockformats: "h1,h2,h3,h4,h5,p,pre",
        media_dimensions: false,
        media_poster: false,
        media_alt_source: false,
        media_embed: false,
        extended_valid_elements: "a[href|target=_blank|rel|class]",
        imagemanager_insert_template: '<img src="{$url}" title="{$title}" alt="{$title}" />',
        image_dimensions: false,
        relative_urls: false,
        remove_script_host: false,
        paste_as_text: true
    });

    /**
     * MASK-CONTACT SELECT PROPERTIES
     */

    $(document).ready(function () {
        var select = document.getElementById("select-opcoes");
        select.addEventListener("change", function () {
            var opcaoSelecionada = select.value;
            var opcao1 = document.getElementById("phone");
            var opcao2 = document.getElementById("email");
            if (opcaoSelecionada === "WhatsApp") {
                opcao1.style.display = "block";
                opcao2.style.display = "none";
            } else if (opcaoSelecionada === "Fixo") {
                opcao1.style.display = "block";
                opcao2.style.display = "none";
            } else if (opcaoSelecionada === "E-mail") {
                opcao1.style.display = "none";
                opcao2.style.display = "block";
            } else {
                opcao1.style.display = "none";
                opcao2.style.display = "none";
            }
        });
    })



    $(document).ready(function () {
        // var meuBotao = document.getElementById('meuBotao');
        // var minhaDiv = document.getElementById('minhaDiv');

        // meuBotao.addEventListener('click', function () {
        //     // minhaDiv.style.display = 'block';
        //     if (minhaDiv.style.display === 'none') {
        //         minhaDiv.style.display = 'block';
        //     } else {
        //         minhaDiv.style.display = 'none';
        //     }
        // });

        var mostrarForm = document.querySelector('.mostrarForm');
        var container = document.querySelector('.newForm');
        var icon = document.getElementById('icon_new');

        mostrarForm.addEventListener('click', function () {
            if (container.style.display === 'none') {
                container.style.display = 'block';
                icon.classList.remove('icon-expand');
                icon.classList.add('icon-compress')

            } else {
                container.style.display = 'none';
                icon.classList.remove('icon-compress');
                icon.classList.add('icon-expand')
            }
        });
    })

    /**
     * JS Consulta CEP
     */

    $(document).ready(function () {
        $('#btn-consultar').click(function () {
            var cep = $('#cep').val().replace(/\D/g, '');

            if (cep.length === 8) {
                $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function (data) {
                    if (!('erro' in data)) {
                        $('#logradouro').val(data.logradouro);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.localidade);
                        $('#uf').val(data.uf);
                    } else {
                        alert('CEP não encontrado, informe o cep novamente ou preencha manualmente o endereço');
                    }
                });
            } else {
                alert("CEP inválido, informe um CEP válido.");
            }
        });
    });

    // $(document).ready(function () {
    //     // $('#cep').mask('00000-000'); // adiciona máscara de CEP
    //     $('#cep').on('input', function () {
    //         var cep = $(this).val().replace(/\D/g, '');
    //         if (cep.length === 8) {
    //             $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function (data) {
    //                 if (!('erro' in data)) {
    //                     $('#logradouro').val(data.logradouro);
    //                     $('#bairro').val(data.bairro);
    //                     $('#cidade').val(data.localidade);
    //                     $('#uf').val(data.uf);
    //                 } else {
    //                     alert('CEP não encontrado, informe o CEP novamente ou preencha manualmente o endereço.');
    //                 }
    //             });
    //         } else if (cep.length < 8 && cep.length > 0) {
    //             alert("CEP inválido, informe um CEP válido.");
    //         }
    //     });
    // });

    $(document).ready(function () {
        $('#cep').on('input', function () {
            var cep = $(this).val().replace(/\D/g, '');
            console.log(cep.length);
            if (cep.length === 8) {
                $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function (data) {
                    if (!('erro' in data)) {
                        $('#logradouro').val(data.logradouro);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.localidade);
                        $('#uf').val(data.uf);
                    } else {
                        alert('CEP não encontrado, informe o CEP novamente ou preencha manualmente o endereço.');
                    }
                });

                // } else if (cep.length > 0 && cep.length < 8) {
                //     alert("CEP inválido, informe um CEP válido.");
            } else {
                // Limpa os campos
                $('#logradouro').val('');
                $('#bairro').val('');
                $('#cidade').val('');
                $('#uf').val('');
            }
            // else {
            //     alert("CEP inválido, informe um CEP com 8 dígitos.");
            // }
        });
    });

})

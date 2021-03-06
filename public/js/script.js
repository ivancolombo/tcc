// Script campo foto do cadastro de medico e paciente
$(document).on("change", ".uploadProfileInput", function () {
    var triggerInput = this;
    var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
    var holder = $(this).closest(".pic-holder");
    var wrapper = $(this).closest(".profile-pic-wrapper");
    $(wrapper).find('[role="alert"]').remove();
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) {
        return;
    }
    if (/^image/.test(files[0].type)) {
        // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function () {
            $(holder).addClass("uploadInProgress");
            $(holder).find(".pic").attr("src", this.result);
            $(holder).append(
                '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Carregando...</span></div></div>'
            );

            // Dummy timeout; call API or AJAX below
            setTimeout(() => {
                $(holder).removeClass("uploadInProgress");
                $(holder).find(".upload-loader").remove();
                // If upload successful
                if (Math.random() < 0.9) {
                    $(wrapper).append(
                        '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Imagem carregada com sucesso</div>'
                    );

                    // Clear input after upload
                    // $(triggerInput).val("");

                    setTimeout(() => {
                        $(wrapper).find('[role="alert"]').remove();
                    }, 3000);
                } else {
                    $(holder).find(".pic").attr("src", currentImg);
                    $(wrapper).append(
                        '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> Ocorreu um erro durante o upload! Por favor, tente novamente.</div>'
                    );

                    // Clear input after upload
                    $(triggerInput).val("");
                    setTimeout(() => {
                        $(wrapper).find('[role="alert"]').remove();
                    }, 3000);
                }
            }, 1500);
        };
    } else {
        $(wrapper).append(
            '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Por favor escolha uma imagem v??lida.</div>'
        );
        setTimeout(() => {
            $(wrapper).find('role="alert"').remove();
        }, 3000);
    }
});
// Fim Script campo foto do cadastro de medico e paciente

// Script para buscar endere??o com base no cep
async function getEndereco(cep) {
    let response;
    try {
        response = await $.ajax({
            method: "get",
            url: 'https://viacep.com.br/ws/' + cep + '/json/'
        });
        return response;
    } catch (error) {
        console.log(error);
    }
}

$('#cep').change(async () => {
    let cep = $("#cep").val().replace(/[^\d]+/g, '');

    if (cep.length === 8) {
        let endereco = await getEndereco(cep);

        if (endereco.erro === undefined) {
            $('#cidade').val(endereco.localidade);
            $('#estado').val(endereco.uf);
            $('#bairro').val(endereco.bairro);
            $('#rua').val(endereco.logradouro);

            $('#cidade').attr('readonly', false);
            $('#estado').attr('readonly', false);
            $('#bairro').attr('readonly', false);
            $('#rua').attr('readonly', false);
        } else {
            limparCamposEndereco();
        }
    } else {
        limparCamposEndereco();
    }

    function limparCamposEndereco() {
        alert('CEP inv??lido!');

        $('#cep').focus();
        $('#cep').val('');
        $('#cidade').val('');
        $('#estado').val('');
        $('#bairro').val('');
        $('#rua').val('');

        $('#cidade').attr('readonly', true);
        $('#estado').attr('readonly', true);
        $('#bairro').attr('readonly', true);
        $('#rua').attr('readonly', true);
    }
});
// Fim Script para buscar endere??o com base no cep

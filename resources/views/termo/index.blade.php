@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="modal fade" id="modalTermos" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="modalTermosLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <form action="{{ url('termos') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTermosLabel">Termos de uso</h5>
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> --}}
                        </div>
                        <div class="modal-body">
                            <div>
                                <p class="font-weight-bold">Termo de consentimento para armazenamento e tratamento de dados pessoais em conformidade com
                                a LGPD Lei nº 13.709 – Lei Geral de Proteção de Dados Pessoais (LGPD).</p>
                                <p>Temos o compromisso em salvaguardar a sua privacidade ao utilizar o NOME DO SISTEMA.</p>
                                <p>Este termo tem como finalidade explicitar a nossa política de tratamento de dados,
                                informando sobre dados coletados e sua utilização.</p>
                                <p>Ao acessar nosso site, você declara o seu EXPRESSO CONSENTIMENTO sobre o armazenamento das
                                informações repassadas no ato do cadastramento, e uso quando necessário o controle interno
                                acerca das capacitações.</p>
                                <p class="font-weight-bold">Informações que você oferece:</p>
                                <ul>
                                    <li>Coletaremos os dados fornecidos no ato do cadastro ou solicitar atualizações de dados necessários ao longo do período de utilização da plataforma;</li>
                                    <li>Os dados coletados tais como Nome e sobrenome, CPF, dados profissionais, endereço de e-mail, telefones de contatos e demais informações requeridas no cadastro utilizadas para login;</li>
                                    <li>Essas informações coletadas poderão ser utilizadas para controle interno e monitoramento de capacitações;</li>
                                    <li>Os seus dados pessoais serão armazenados e preservados por um período indeterminado;</li>
                                    <li>Os dados registrados em nosso sistema não serão compartilhados de para órgãos externos, salvo exceções legais.</li>
                                </ul>
                                <p class="font-weight-bold">Você poderá, a qualquer momento:</p>
                                <ul>
                                    <li>Ter acesso às informações sobre a forma e a duração de tratamento dos seus dados na nossa                                         plataforma;</li>
                                    <li>Solicitar a atualização ou correção dos seus dados;</li>
                                    <li>Solicitar a eliminação dos seus dados pessoais tratados e revogação do consentimento, nos                                         termos da Lei;</li>
                                </ul>
                                <p class="font-weight-bold">Comunicação:</p>
                                <ul>
                                    <li>Podemos registrar e gravar todos os dados fornecidos em toda comunicação realizada com nossa equipe, seja por correio eletrônico, mensagens, telefones ou qualquer outro meio.</li>
                                </ul>
                                <p class="font-weight-bold">Endereço eletrônico (e-mail):</p>
                                <ul>
                                    <li>Ao fazer o cadastro ou login em nosso website, coletamos o seu e-mail para fins cadastrais, pelo qual ocorrerá o gerenciamento da conta.</li>
                                </ul>                                
                            </div>
                            <div class="form-group form-check mb-0">
                                <input type="checkbox" class="form-check-input @error('aceite_termos') is-invalid @enderror"
                                    id="aceite_termos" name="aceite_termos">
                                <label class="form-check-label @error('aceite_termos') is-invalid @enderror"
                                    for="aceite_termos">Eu li e concordo com os termos de uso.</label>
                            </div>
                            @error('aceite_termos')
                                <small class="text-danger">Para continuar aceite os termos.</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#modalTermos').modal('show');
    </script>
@endsection

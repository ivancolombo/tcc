@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="modal fade" id="modalTermos" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="modalTermosLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ url('aceitar-termos') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTermosLabel">Termos de uso</h5>
                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> --}}
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-check mb-0">
                                <input type="checkbox" class="form-check-input @error('aceite_termos') is-invalid @enderror" id="aceite_termos" name="aceite_termos">
                                <label class="form-check-label @error('aceite_termos') is-invalid @enderror" for="aceite_termos">Eu li e concordo com os termos de uso.</label>
                            </div>
                            @error('aceite_termos')
                                <small class="text-danger">Para continuar aceite os termos.</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
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

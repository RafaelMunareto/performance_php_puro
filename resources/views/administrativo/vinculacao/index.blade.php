@extends('layouts.basic')
@section('title', 'Vincular')
@section('titulo') VINCULAR METAS - {{$nome_func}} @endsection

@section('navgation')

    <div class='d-flex'>
        <a href="{{ route('adm.equipe') }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
        <a href="{{ route('adm.vinculados', $id) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-bullseye neomorphic-text-black"></i>
                <span class='neomorphic-text-black'>VINCULADAS</span>
            </div>
        </a>
        <a href="{{ route('at.manual', $cod_func) }}">
            <div class='animated-bounce-buttom button-down-basic buttonTransform'>
                <i class="fa fa-exchange-alt neomorphic-text-black"></i>
                <span class='neomorphic-text-black'>ATUALIZAÇÃO</span>
            </div>
        </a>
    </div>

@endsection

@section('conteudo')

    <div id='desktop'>
        <div class='d-flex flex-column justify-content-center container mt-4 mb-3 container-fluid'>
            <div class='min-height-70vh vue'>
                <vc-vinculacao lastdate='{{ $data }}' nome_func='{{ $nome_func }}' cod_func='{{ $cod_func }}'></vc-vinculacao>
            </div>
        </div>
    </div>

@endsection

@section('navgationM')

    <div class="btnSupEsquerdo">
        <a href="#top" class="glyphicon glyphicon-chevron-up">
            <button class="neomorphic-buttom padding-1 borderRadius-50 btnPrincipal text-green back-to-top" name="3" >
                <i class="fa fa-arrow-up"></i>
            </button>
        </a>
    </div>

    <div class='row'>
        <a href="{{ route('adm.vinculados', $id) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-bullseye neomorphic-text-black"></i>
                <span class='neomorphic-text-black'>METAS VINCULADAS</span>
            </div>
        </a>
        <a href="{{ route('at.manual', $cod_func) }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-exchange-alt neomorphic-text-black"></i>
                <span class='neomorphic-text-black'>ATUALIZAÇÃO</span>
            </div>
        </a>
        <a href="{{ route('adm.equipe') }}">
            <div class='padding-2 borderRadius-10 neomorphic-card margin-1 animated-bounce-buttom'>
                <i class="fa fa-arrow-circle-left text-blue"></i>
                <span class='neomorphic-text-black font-weight-400'>VOLTAR</span>
            </div>
        </a>
        <form method='POST'>
            @csrf
            <div class="padding-1 borderRadius-10 neomorphic-card margin-1">
                <input type="text" name="search" id="search" class="neomorphic-input borderRadius-5 padding-1" />
                <button type='submit' class="btn-floating btn-small waves-effect waves-light btn red darken-1 delete text-black">
                    <i class="fas fa-search neomorphic-text-black"></i> PESQUISAR</button>
            </div>
        </form>
    </div>
@endsection

@section('conteudoM')

    @include('administrativo.vinculacao.table-indexM')

@endsection

@section('scripts')
@foreach($cadastro as $linha)
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>

$(document).ready(function (){

    $("#checkTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
        cod_item = $('#cod_item{{$linha->id}}').val();
        nome_item = $('#nome_item{{$linha->id}}').val();
        nome_func = $('#nome_func').val();
        categoria = $('#categoria{{$linha->id}}').val();
        obj = $('#obj{{$linha->id}}').val();
        peso = $('#peso{{$linha->id}}').val();
        id = $('#id').val();

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if($(this).is(':checked')){
            $.ajax({
                type:"POST",
                data:{
                    "cod_item":cod_item,
                    "nome_func":nome_func,
                    "nome_item":nome_item,
                    "categoria":categoria,
                    "obj":obj,
                    'nome_func':nome_func,
                    'id':id,
                    'peso':peso
                },
                url: "{{ route("adm.vinculacao_store", ['id'=> $linha->id]) }}",
                success:function(data){
                }
            });
        }
    });

    $(".ajax{{$linha->id}}").click(function() {

        cod_item = $('#cod_item{{$linha->id}}').val();
        nome_item = $('#nome_item{{$linha->id}}').val();
        nome_func = $('#nome_func').val();
        categoria = $('#categoria{{$linha->id}}').val();
        obj = $('#obj{{$linha->id}}').val();
        peso = $('#peso{{$linha->id}}').val();
        id = $('#id').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if($(this).is(':checked')){
            $.ajax({
                type:"POST",
                data:{
                    "cod_item":cod_item,
                    "nome_func":nome_func,
                    "nome_item":nome_item,
                    "categoria":categoria,
                    "obj":obj,
                    'nome_func':nome_func,
                    'id':id,
                    'peso':peso
                },
                url: "{{ route("adm.vinculacao_store", ['id'=> $linha->id]) }}",
                success:function(data){
                }
            });
        }
    });

});

</script>
@endforeach

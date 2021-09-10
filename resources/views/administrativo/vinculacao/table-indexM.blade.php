

<div class='d-flex flex-column neomorphic-conc padding-1 borderRadius-20 mb-4' >

    @if($cadastro->count())
        <input class='display-none' id='id' value='{{$id}}'>
        <input class='display-none' id='nome_func' value='{{$nome_func}}'>
    @foreach($cadastro as $linha)
            <div class='d-flex flex-column mb-4'>

                <input class='display-none' id='id{{$linha->id}}' value='{{$linha->id}}'>

                <div class='neomorphic-conc size70 borderRadius-10 padding-05 mt-2'>
                    <input class='borderRadius-10 text-center ajax{{$linha->id}}' id='check_vinc' type="checkbox">
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-05 mt-2'>
                    <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->cod_item}}</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-05 mt-2'>
                    <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->nome_item}}</span>
                </div>

            </div>
    @endforeach
    {{ $cadastro->appends(['search' => $search])->links() }}
    @endif
</div>


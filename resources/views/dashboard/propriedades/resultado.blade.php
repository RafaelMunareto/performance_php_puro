
<div id='desktop' class='animated fadeIn' >

    <div class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 width-50rem padding-05 size90' >

        <div class='d-flex justify-content-start align-center'>
            <span class='icon-link borderRadius-20'>
                <h4 class="text-uppercase neomorphic-text-gray padding-05">PROPRIEDADES {{$nome_item}}</h4>
            </span>
        </div>

        <div class='row font-weight-bold'>
            <div class='d-flex justify-content-center neomorphic-card borderRadius-10 padding-1 mr-2 mt-2 ml-4 mb-2 col-6'>
                <span class='neomorphic-text-black text-bold text-center size90'>{{'NOME'}}</span>
            </div>

            <div class='neomorphic-card size70 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-2'>
                <span class='neomorphic-text-black text-center text-uppercase font-bold'>{{'OBJETIVO'}}</span>
            </div>

            <div class='neomorphic-card size70 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-2'>
                <span class='neomorphic-text-black text-center text-uppercase'>{{'REALIZADO'}}</span>
            </div>

            <div class='neomorphic-card size80 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-1 text-center'>
                <span class='text-center align-vertical'>{{'%'}}</span>
            </div>
        </div>

        @foreach($cadastro as $linha)
                <div @if($linha->nome_func == Auth::user()->name) class='row font-weight-bold' @else class='row' @endif >
                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-2 mt-2 ml-4 mb-2 col-6'>
                        <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->nome_func}}</span>
                    </div>

                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-2'>
                        <span class='neomorphic-text-black text-center text-uppercase money'>{{$linha->obj}}</span>
                    </div>

                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-2'>
                        <span class='neomorphic-text-black text-center text-uppercase money'>{{$linha->rlz}}</span>
                    </div>

                    <div class='neomorphic-conc size80 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-1 text-center'>
                        <span class=' text-blue align-v color-text-txt'>{{number_format($linha->perc,2)}}</span>
                    </div>
                </div>
        @endforeach
        {{ $cadastro->links() }}
    </div>

</div>




<div id='mobile'>

    <div class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 padding-05 size90' >

        <div class='d-flex justify-content-start align-center'>
            <span class='icon-link borderRadius-20'>
                <h4 class="text-uppercase neomorphic-text-gray padding-05">PROPRIEDADES {{$nome_item}}</h4>
            </span>
        </div>

        @foreach($cadastro as $linha)
                <div @if($linha->nome_func == Auth::user()->name) class='row font-weight-bold' @else class='row' @endif >
                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-2 mt-2 ml-4 mb-2 col-10'>
                        <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->nome_func}}</span>
                    </div>

                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-1 mr-2 mt-2 ml-4 mb-2 col-10'>
                        <span class='neomorphic-text-black text-center text-uppercase money'>{{$linha->obj}}</span>
                    </div>

                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-1 mr-2 mt-2 ml-4 mb-2 col-10'>
                        <span class='neomorphic-text-black text-center text-uppercase money'>{{$linha->rlz}}</span>
                    </div>

                    <div class='neomorphic-conc size80 borderRadius-10 padding-1 mr-2 mt-2 ml-4 mb-5 col-10 text-center'>
                        <span class=' text-blue align-v color-text-txt'>{{number_format($linha->perc,2)}}</span>
                    </div>
                </div>

        @endforeach
        {{ $cadastro->links() }}
    </div>

</div>

<div id='desktop' class='animated fadeIn' >
    <div id='ranking' class=' neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 padding-1' >

        <div class='d-flex justify-content-start align-center'>
            <span class='icon-link borderRadius-20'>
                <h4 class="text-uppercase neomorphic-text-gray padding-05">RANKING</h4>
            </span>
        </div>

        @foreach($ranking as $linha)
        <div @if($linha->nome_func == $nome_func) class='row font-weight-bold' @else class='row' @endif >
            <div class='d-flex justify-content-center neomorphic-conc size100 borderRadius-10 padding-1 mr-2 mt-2 ml-4 mb-2 col-1'>
                    <span class='neomorphic-text-black text-bold text-center'>{{$linha->rank}}º</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-7'>
                    <span class='neomorphic-text-black text-center text-uppercase rank'>{{$linha->nome_func}}</span>
                </div>

                <div class='neomorphic-conc size80 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-2'>
                    <span class='text-center text-blue align-v color-text-txt'>{{number_format($linha->notaFinal,2)}}</span>
                </div>
            </div>
        @endforeach
        {{ $ranking->links(("pagination::bootstrap-4")) }}

    </div>
</div>



<div id='mobile'>
    <div class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 padding-05'>

        <div class='d-flex justify-content-start align-center'>
            <span class='icon-link borderRadius-20'>
                <h4 class="text-uppercase neomorphic-text-gray padding-05">RANKING</h4>
            </span>
        </div>

        @foreach($ranking as $linha)
            <div @if($linha->nome_func == $nome_func) class='row font-weight-bold' @else class='row' @endif >
                <div class='d-flex justify-content-center neomorphic-conc size100 borderRadius-10 padding-1 mr-2 mt-2 ml-4 mb-2 col-1'>
                    <span class='neomorphic-text-black text-bold text-center'>{{$linha->rank}}º</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-7'>
                    <span class='neomorphic-text-black text-center text-uppercase rank'>{{$linha->nome_func}}</span>
                </div>

                <div class='neomorphic-conc size80 borderRadius-10 padding-1 mr-1 mt-2 ml-1 mb-2 col-2'>
                    <span class='text-center text-blue align-v color-text-txt'>{{number_format($linha->notaFinal,2)}}</span>
                </div>
            </div>
        @endforeach
        {{ $ranking->links() }}
    </div>
</div>

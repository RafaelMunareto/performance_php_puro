
<div id='desktop' class='animated fadeIn' >

    <div class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 width-50rem padding-05'>

        <div class='d-flex justify-content-start align-center'>
            <span class='icon-link borderRadius-20'>
                <h4 class="text-uppercase neomorphic-text-gray padding-05">RANKING - NOTA FINAL</h4>
            </span>
        </div>

        @foreach($ranking as $linha)
            <div class='row'>
                <div class='d-flex justify-content-center neomorphic-conc size100 borderRadius-10 padding-05 mr-2 mt-2 ml-4 mb-2 col-1'>
                    <span class='neomorphic-text-black text-bold text-center'>{{$linha->rank}}º</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-05 mr-1 mt-2 ml-1 mb-2 col-8'>
                    <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->nome_func}}</span>
                </div>

                <div class='neomorphic-conc size80 borderRadius-10 padding-05 mr-1 mt-2 ml-1 mb-2 col-2 text-center'>
                    <span class='text-center text-blue align-v color-text-txt'>{{number_format($linha->notaFinal,2)}}</span>
                </div>
            </div>
        @endforeach
        {{ $ranking->links() }}
    </div>

</div>

<div id='mobile'>

    <div class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 padding-2'>

        <div class='d-flex justify-content-start align-center'>
            <span class='icon-link borderRadius-20'>
                <h4 class="text-uppercase neomorphic-text-gray padding-05">RANKING - NOTA FINAL</h4>
            </span>
        </div>

        @foreach($ranking as $linha)
            <div class='row'>
                <div class='d-flex justify-content-center neomorphic-conc size100 borderRadius-10 padding-1 mb-2 col-12'>
                    <span class='neomorphic-text-black text-bold text-center'>{{$linha->rank}}º</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-1 mb-2 col-12'>
                    <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->nome_func}}</span>
                </div>

                <div class='neomorphic-conc size80 borderRadius-10 padding-1 mb-5 col-12 text-center'>
                    <span class='text-center text-blue align-v color-text-txt'>{{number_format($linha->notaFinal,2)}}</span>
                </div>
            </div>
        @endforeach
        {{ $ranking->links() }}

    </div>

</div>




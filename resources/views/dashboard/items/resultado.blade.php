<div id='desktop' class='animated fadeIn' >

    <div class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 width-50rem padding-05'>

        <div class='d-flex justify-content-start align-center'>
            <select name='validaAdm' onchange='window.location="?item=" + this.value + "&dta={{$id}}"'
                class="neomorphic-input margin-05 col-7 mr-5 padding-1 borderRadius-10 text-gray font-weigth-600 text-uppercase">
                <option @if($item == 0) {{'selected'}} @endif value='0'>{{'ESCOLHA O ITEM'}}</option>
                @foreach($item_select as $linha)
                    @if($item == $linha->cod_item)
                        <option selected value="/{{$linha->cod_item}}">{{$linha->nome_item}}</option>
                    @else
                        <option value="{{$linha->cod_item}}">{{$linha->nome_item}}</option>
                    @endif
                @endforeach
            </select>
            <span class='icon-link borderRadius-20'>
                <h4 class="text-uppercase neomorphic-text-gray padding-05">DISPERSÃO DE ITEMS</h4>
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

        @foreach($items as $linha)
            <a href="{{ route('dashboard.items', $linha->cod_item) }}">
                <div class='row'>
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
            </a>
        @endforeach
        {{ $items->links() }}
    </div>

</div>


<div id='mobile'>
    <div class='neomorphic-card borderRadius-10 d-flex justify-content-around flex-column align-middle height-100 padding-1'>

        <h4 class="text-uppercase neomorphic-text-gray padding-05">DISPERSÃO DE ITEMS</h4>

        <div class='d-flex justify-content-start align-center'>
            <select name='validaAdm' onchange='window.location="?item=" + this.value + "&dta={{$id}}"'
                class="neomorphic-input col-12 mr-5 padding-1 borderRadius-10 text-gray font-weigth-600 text-uppercase">
                <option @if($item == 0) {{'selected'}} @endif value='0'>{{'ESCOLHA O ITEM'}}</option>
                @foreach($item_select as $linha)
                    @if($item == $linha->cod_item)
                        <option selected value="/{{$linha->cod_item}}">{{$linha->nome_item}}</option>
                    @else
                        <option value="{{$linha->cod_item}}">{{$linha->nome_item}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        @foreach($items as $linha)
            <a href="{{ route('dashboard.items', $linha->cod_item) }}">
                <div class='d-flex flex-column'>
                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mt-2'>
                        <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->nome_func}}</span>
                    </div>

                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mt-2'>
                        <span class='neomorphic-text-black text-center text-uppercase money'>{{$linha->obj}}</span>
                    </div>

                    <div class='neomorphic-conc size70 borderRadius-10 padding-1 mt-2'>
                        <span class='neomorphic-text-black text-center text-uppercase money'>{{$linha->rlz}}</span>
                    </div>

                    <div class='neomorphic-conc size80 borderRadius-10 padding-1 mt-2 mb-5 text-center'>
                        <span class=' text-blue align-v color-text-txt'>{{number_format($linha->perc,2)}}</span>
                    </div>
                </div>
            </a>
        @endforeach
        {{ $items->links() }}
    </div>
</div>


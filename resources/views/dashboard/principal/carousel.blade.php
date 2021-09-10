
    <div class='neomorphic-card margin-2 borderRadius-20' id='top'>
        <span class='neomorphic-text-grey d-flex flex-column padding-1'>
            <span class='neomorphic-text-gray size120 font-weight-600 margin-1'>TOP 1</span>
            <i class="fas fa-medal fa-4x neomorphic-text-gray"></i>
            <span class='neomorphic-text-black size90 text-uppercase margin-1p-right margin-1p-left w100 mt-4'>{{$destaque[0]->nome_func}}</span>
            <span class='size90 margin-1p-right margin-1p-left w100 color-text-txt'>{{number_format($destaque[0]->notaFinal,2)}}</span>
        </span>
    </div>

    <div class='neomorphic-card margin-2 borderRadius-20' id='top'>
        <span class='neomorphic-text-grey d-flex flex-column padding-1'>
            <span class='neomorphic-text-gray size120 font-weight-600 margin-1'>TOP 2</span>
            <i class="fas fa-medal fa-4x neomorphic-text-gray"></i>
            <span class='neomorphic-text-black size90 text-uppercase margin-1p-right margin-1p-left w100 mt-4'>
                @if(isset($destaque[1]))
                    {{$destaque[1]->nome_func}}
                @endif
            </span>
            <span class='size90 margin-1p-right margin-1p-left w100 color-text-txt'>
                @if(isset($destaque[1]))
                    {{number_format($destaque[1]->notaFinal,2)}}
                @endif
            </span>
        </span>
    </div>


    <div class='neomorphic-card margin-2 borderRadius-20' id='top'>
        <span class='neomorphic-text-grey d-flex flex-column padding-1'>
            <span class='neomorphic-text-gray size120 font-weight-600 margin-1'>TOP 3</span>
            <i class="fas fa-medal fa-4x neomorphic-text-gray"></i>
            <span class='neomorphic-text-black size90 text-uppercase margin-1p-right margin-1p-left w100 mt-4'>
                @if(isset($destaque[2]))
                    {{$destaque[2]->nome_func}}
                @endif
            </span>
            <span class='size90 margin-1p-right margin-1p-left w100 color-text-txt'>
                @if(isset($destaque[2]))
                    {{number_format($destaque[2]->notaFinal,2)}}
                @endif
            </span>
        </span>
    </div>






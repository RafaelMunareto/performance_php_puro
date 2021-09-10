
    @if($cadastro->count())
            <input class='display-none' id='id' value='{{$id}}'>
            <input class='display-none' id='nome_func' value='{{$nome_func}}'>
            <tr id='padding-cb-1' colspan=3 >
                <td class='text-left' colspan=3> <input class='borderRadius-10 text-center marcarTodos mr-2 ml-3' id='checkTodos' name='checkTodos' type="checkbox">  SELECIONAR TODOS</td>
            </tr>
        @foreach($cadastro as $linha)
            <tr id='padding-cb-1'>
                <td class='display-none'><input class='display-none' id='id{{$linha->id}}' value='{{$linha->id}}'></td>
                <td class='text-center' style='width:5%'><input class='borderRadius-10 text-center ajax{{$linha->id}}' id='check_vinc' type="checkbox"></td>
                <td style='width:5%'><input id='cod_item{{$linha->id}}' class='color-none border-none text-white borderRadius-10 text-center ' value='{{$linha->cod_item}}'></td>
                <td style='width:60%'><input id='nome_item{{$linha->id}}' class='color-none border-none text-white borderRadius-10 text-uppercase text-left w100' value='{{$linha->nome_item}}'></td>
                <td style='width:10%'><input id='categoria{{$linha->id}}' class='color-none border-none text-white borderRadius-10 text-left' value='{{$linha->categoria}}'></td>
                <td style='width:10%'><input id='obj{{$linha->id}}' class='color-none border-none text-white borderRadius-10 text-left money' value='{{$linha->obj}}'></td>
                <td style='width:10%'><input id='peso{{$linha->id}}' class='color-none border-none text-white borderRadius-10 text-center' value='{{$linha->peso}}'></td>
            </tr>
        @endforeach
    @endif
    <tr class='mt-2'>
        <td colspan="3" align="center" >
            {{ $cadastro->appends(['search' => $search])->links() }}
        </td>
    </tr>


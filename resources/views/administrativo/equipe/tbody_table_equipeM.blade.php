

<div class='neomorphic-card borderRadius-20 d-flex justify-content-around flex-column align-middle mb-5 height-100 padding-05 size90' >

    <div class='d-flex justify-content-start align-center'>
        <span class='icon-link borderRadius-20'>
            <h4 class="text-uppercase neomorphic-text-gray padding-05">EQUIPE</h4>
        </span>
    </div>

    @if($cadastro->count())
    @foreach($cadastro as $linha)
            <div class='d-flex flex-column'>
                <div class='neomorphic-conc size70 borderRadius-10 padding-05'>
                    <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->cod_func}}</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-05'>
                    <span class='neomorphic-text-black text-center text-uppercase'>{{$linha->nome}}</span>
                </div>

                <div class='neomorphic-conc size70 borderRadius-10 padding-05 text-center'>
                    <a href="/vinculacao/{{$linha->cod_func}}" class="icon-link padding-05 borderRadius-20 d-flex justify-content-center text-center" title="VINCULAÇÃO DE METAS">
                        <i class="far fa-dot-circle text-orange"></i>
                    </a>
                </div>

                <div class='neomorphic-conc size80 borderRadius-10 padding-05 text-center'>
                    <a href="/equipe/editar/{{$linha->id}}" class="icon-link padding-05 borderRadius-50 d-flex justify-content-center" title="EDITAR">
                        <i class="far fa-edit text-blue"></i>
                    </a>
                </div>

                <div class='neomorphic-conc size80 borderRadius-10 padding-05 mb-5 text-center'>
                    <form method="POST" action="equipe/remover/{{$linha->id}}"
                        onsubmit=" return confirm('Tem certeza que deseja excluir o funcionário {{addslashes($linha->nome)}} da base?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-floating btn-small waves-effect waves-light btn red darken-1 delete"><i class="far fa-trash-alt text-red"></i></button>
                    </form>
                </div>
            </div>
    @endforeach
    {{ $cadastro->appends(['search' => $search])->links() }}
    @endif
</div>
<input type="hidden" name="hidden_page" id="hidden_page" value="1" />
<input type="hidden" name="hidden_column_name" id="hidden_column_name" value="cod_item" />
<input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

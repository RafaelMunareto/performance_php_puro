$(document).ready(function(){

    $('.inputSimulador').on('input', function(){

        var sprint = 0;
        var direcionador = 0;
        var prioritario = 0;
        var tot_simulado = 0;
        var notaSprint = $('#notaSprint');
        var notaPrioritario = $('#notaPrioritario');
        var notaDirecionador = $('#notaDirecionador');
        var notaFinal = $('#notaFinal');


        $('.inputSimulador').each(function(index, element) {

/* ------------------------------------------VARIAVEIS---------------------------------------------- */
            var item_cod = $(element).attr('id');
            var item_cod = item_cod.substring(0, 5);
            var peso = $('#Peso' + item_cod).text();
            var trava = $('#trava').val();
            peso = peso.replace(',','.') * 1;
            var perc_simulado_item = $(element).val();
            perc_simulado_item = perc_simulado_item.replace(',','.') * 1;
            var pontuacao_simulada = 0;

/* ------------------------------------------CALCULOS SPRINT---------------------------------------------- */
            if (item_cod.substring(0, 1) == "S"){

                var pontuacao_simulada = 0;

                if(perc_simulado_item > trava){
                    perc_simulado_item = trava;
                    pontuacao_simulada = (trava * peso)/100;
                }else if(perc_simulado_item < 0){
                    pontuacao_simulada = 0
                }else{
                    pontuacao_simulada = (perc_simulado_item * peso)/100;
                }

                sprint = sprint + pontuacao_simulada;
                notaSprint.text(sprint.toFixed(2));

            }
/* ------------------------------------------CALCULOS PRIORITARIOS---------------------------------------------- */
            if(item_cod.substring(0, 1) == "P"){

                if($('#pontoPrioritario').val() != null){
                    var pontuacao_simulada = 0;
                    if(perc_simulado_item > trava){
                        perc_simulado_item = trava;
                        pontuacao_simulada = (trava * peso)/100;
                    }else if(perc_simulado_item < 0){
                        pontuacao_simulada = 0
                    }else{
                        pontuacao_simulada = (perc_simulado_item * peso)/100;
                    }

                    var pesoP = 0;
                    $(".pesoP").each(function() {
                        var pesoCalc = Number($(this).text());
                        pesoP = pesoCalc + parseFloat(pesoP);
                    });

                    prioritario = prioritario + pontuacao_simulada;
                    var totalP = (prioritario.toFixed(2)/pesoP.toFixed(2))*100
                    $('#pontoPrioritario').val(prioritario.toFixed(2))
                    $('#pesoPrioritario').val(pesoP.toFixed(2))
                    notaPrioritario.text(totalP.toFixed(2));
                    }

            }
/* ------------------------------------------CALCULOS DIRECIONADOR---------------------------------------------- */
            if(item_cod.substring(0, 1) == "D"){

                if($('#pontoDirecionador').val() != null){
                    var pontuacao_simulada = 0;

                    if(perc_simulado_item > trava){
                        perc_simulado_item = trava;
                        pontuacao_simulada = (trava * peso)/100;
                    }else if(perc_simulado_item < 0){
                        pontuacao_simulada = 0
                    }else{
                        pontuacao_simulada = (perc_simulado_item * peso)/100;
                    }

                    var pesoD = 0;
                    $(".pesoD").each(function() {
                        var pesoCalc = Number($(this).text());
                        pesoD = pesoCalc + parseFloat(pesoD);
                    });

                    direcionador = direcionador + pontuacao_simulada;
                    var totalD = (direcionador.toFixed(2)/pesoD.toFixed(2))*100
                    $('#pontoDirecionador').val(direcionador.toFixed(2))
                    $('#pesoDirecionador').val(pesoD.toFixed(2))
                    notaDirecionador.text(totalD.toFixed(2));
                }

            }
/* ------------------------------------------NOTAS FINAIS---------------------------------------------- */

            if($('#pontoPrioritario').val() && $('#pontoDirecionador').text()){
                var pPrioritario = $('#pontoPrioritario').val();
                pPrioritario = pPrioritario.replace(',','.') * 1;
                var nPrioritario = $('#notaPrioritario').text();
                nPrioritario = nPrioritario.replace(',','.') * 1;
                var nDirecionador = $('#notaDirecionador').text();
                nDirecionador = nDirecionador.replace(',','.') * 1;
                var pesoP = $('#pesoPrioritario').val();
                pesoP = pesoP.replace(',','.') * 1;
                var pDirecionador = $('#pontoDirecionador').val();
                pDirecionador = pDirecionador.replace(',','.') * 1;
                var pesoD = $('#pesoDirecionador').val();
                pesoD = pesoD.replace(',','.') * 1;
                pesoTotal = pesoP + pesoD;
                notaTotal = pPrioritario + pDirecionador;
                var total = ((notaTotal.toFixed(2))/(pesoTotal.toFixed(2))*100) + sprint;
                notaFinal.text(total.toFixed(2));


/* ------------------------------------------DIFERENÇAS------------------------------------------------ */

            var oldS = $('#oldS').val();
            oldS = oldS.replace(',','.') * 1;
            var difSprint = sprint - oldS;

            if(difSprint > 0){
                $('#difSprint').text("+" + difSprint.toFixed(2).replace('.', ',')).removeClass("text-red").addClass("text-green");
            }else if(difSprint < 0){
                $('#difSprint').text(difSprint.toFixed(2).replace('.', ',')).removeClass("text-green").addClass("text-red");
            }else{
                $('#difSprint').text("");
            }

            var oldP = $('#oldP').val();
            oldP = oldP.replace(',','.') * 1;
            var difPrioritario = nPrioritario - oldP;

            if(difPrioritario > 0){
                $('#difPrioritario').text("+" + difPrioritario.toFixed(2).replace('.', ',')).removeClass("text-red").addClass("text-green");
            }else if(difPrioritario < 0){
                $('#difPrioritario').text(difPrioritario.toFixed(2).replace('.', ',')).removeClass("text-green").addClass("text-red");
            }else{
                $('#difPrioritario').text("");
            }

            var oldD = $('#oldD').val();
            oldD = oldD.replace(',','.') * 1;
            var difDirecionador = nDirecionador - oldD;

            if(difDirecionador > 0){
                $('#difDirecionador').text("+" + difDirecionador.toFixed(2).replace('.', ',')).removeClass("text-red").addClass("text-green");
            }else if(difDirecionador < 0){
                $('#difDirecionador').text(difDirecionador.toFixed(2).replace('.', ',')).removeClass("text-green").addClass("text-red");
            }else{
                $('#difDirecionador').text("");
            }

            var oldNF = $('#oldNF').val();
            oldNF = oldNF.replace(',','.') * 1;
            var difNotaFinal = total - oldNF;

            if(difNotaFinal > 0){
                $('#difNotaFinal').text("+" + difNotaFinal.toFixed(2).replace('.', ',')).removeClass("text-red").addClass("text-green");
            }else if(difNotaFinal < 0){
                $('#difNotaFinal').text(difNotaFinal.toFixed(2).replace('.', ',')).removeClass("text-green").addClass("text-red");
            }else{
                $('#difNotaFinal').text("");
            }

        }else{

                var nDirecionador = $('#notaDirecionador').text();
                nDirecionador = nDirecionador.replace(',','.') * 1;
                var pDirecionador = $('#pontoDirecionador').val();
                pDirecionador = pDirecionador.replace(',','.') * 1;
                var pesoD = $('#pesoDirecionador').val();
                pesoD = pesoD.replace(',','.') * 1;
                pesoTotal = pesoD;
                notaTotal = pDirecionador;
                var total = ((notaTotal.toFixed(2))/(pesoTotal.toFixed(2))*100) + sprint;
                notaFinal.text(total.toFixed(2));


/* ------------------------------------------DIFERENÇAS------------------------------------------------ */

            var oldD = $('#oldD').val();
            oldD = oldD.replace(',','.') * 1;
            var difDirecionador = nDirecionador - oldD;

            if(difDirecionador > 0){
                $('#difDirecionador').text("+" + difDirecionador.toFixed(2).replace('.', ',')).removeClass("text-red").addClass("text-green");
            }else if(difDirecionador < 0){
                $('#difDirecionador').text(difDirecionador.toFixed(2).replace('.', ',')).removeClass("text-green").addClass("text-red");
            }else{
                $('#difDirecionador').text("");
            }

            var oldNF = $('#oldNF').val();
            oldNF = oldNF.replace(',','.') * 1;
            var difNotaFinal = total - oldNF;

            if(difNotaFinal > 0){
                $('#difNotaFinal').text("+" + difNotaFinal.toFixed(2).replace('.', ',')).removeClass("text-red").addClass("text-green");
            }else if(difNotaFinal < 0){
                $('#difNotaFinal').text(difNotaFinal.toFixed(2).replace('.', ',')).removeClass("text-green").addClass("text-red");
            }else{
                $('#difNotaFinal').text("");
            }


        }




        });
    });

});

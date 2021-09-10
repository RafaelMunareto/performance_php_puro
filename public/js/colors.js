$(document).ready(function (){

    $('.color-attr').each(function(){
        var perc = $(this).attr('id');
        if(perc >= 100){
            $(this).addClass('color-blue');
        }else if(perc>=95 && perc < 100){
            $(this).addClass('color-green');
        }else if(perc>=90 && perc < 95){
            $(this).addClass('color-orange');
        }else if(perc<90){
            $(this).addClass('color-red');
        }
    });

    $('.color-with-simulador').each(function(){
        var perc = $(this).attr('data-id');
        if(perc >= 100){
            $(this).addClass('color-blue');
        }else if(perc>=95 && perc < 100){
            $(this).addClass('color-green');
        }else if(perc>=90 && perc < 95){
            $(this).addClass('color-orange');
        }else if(perc<90){
            $(this).addClass('color-red');
        }
    });

    $('.color-text-txt').each(function(){
        var perc = $(this).text();
        if(perc >= 100){
            $(this).addClass('text-blue');
        }else if(perc>=95 && perc < 100){
            $(this).addClass('text-green');
        }else if(perc>=90 && perc < 95){
            $(this).addClass('text-orange');
        }else if(perc<90){
            $(this).addClass('text-red');
        }
    });

    $('.color-text-attr').each(function(){
        var perc = $(this).attr('id');
        if(perc >= 100){
            $(this).addClass('text-blue');
        }else if(perc>=95 && perc < 100){
            $(this).addClass('text-green');
        }else if(perc>=90 && perc < 95){
            $(this).addClass('text-orange');
        }else if(perc<90){
            $(this).addClass('text-red');
        }
    });


    $('.color-text-val').each(function(){
        var perc = $(this).val();
        if(perc >= 100){
            $(this).addClass('text-blue');
        }else if(perc>=95 && perc < 100){
            $(this).addClass('text-green');
        }else if(perc>=90 && perc < 95){
            $(this).addClass('text-orange');
        }else if(perc<90){
            $(this).addClass('text-red');
        }
    });

    $('.color-attr').each(function(){
        var perc = $(this).attr('id');
        if(perc >= 100){
            perc = 97.4;
        }else if(perc<0){
            perc = 0
        }
        $(this).width(perc + '%');
    });


});

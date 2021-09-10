$(document).ready(function (){

    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    //deixa todos os options com text-uppercase
    $("option").each(function() {
        var $this = $(this);
        $this.text($this.text().toUpperCase() );
    });
    //carrega preloader da atualização automática
    $('#buttonTxt').click(function(){
        $('#preloaderTxt').css('display','block').fadeIn();
    });

    $( ".buttonAnimated" ).hover(
        function() {
            $(this).addClass('animated jackInTheBox');
        }, function() {
            $(this).removeClass('animated jackInTheBox');
        }
    );

    $( '.animated-flip-buttom' ).click(function() {
        $(this).addClass('mask waves-effect waves-light rgba-white-slight');
    });

    $( '.animated-bounce-buttom' ).click(function() {
        $(this).addClass('animated bounceIn');
    });


    //subir para o topo
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('a[href="#top"]').fadeIn();
        } else {
            $('a[href="#top"]').fadeOut();
        }
    });

    $('a[href="#top"]').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });




});

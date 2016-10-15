( function( $ ) {

     $('a.diy').click(function() {
         if (!$('.mv-propuestas').hasClass('propuesta-uno')){
             $('.opcion-uno').removeClass('display-uno');
         };
     });

     $('a.diwm').click(function() {
        if (!$('.mv-propuestas').hasClass('propuesta-dos')){
            $('.opcion-dos').removeClass('display-dos');
        };
    });

    $('a.ldt').click(function() {
       if (!$('.mv-propuestas').hasClass('propuesta-tres')){
           $('.opcion-tres').removeClass('display-tres');
       };
   });

})( jQuery );

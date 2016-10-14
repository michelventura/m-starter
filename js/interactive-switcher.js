( function( $ ) {

    var acc = document.getElementsByClassName("accordion");
    var panel = document.getElementsByClassName('panel');

    for (var i = 0; i < acc.length; i++) {
      acc[i].onclick = function() {
        var setClasses = !this.classList.contains('active');
          setClass(acc, 'active', 'remove');
          setClass(panel, 'show', 'remove');

          if (setClasses) {
              this.classList.toggle("active");
              this.nextElementSibling.classList.toggle("show");
          }
      }
    }

    function setClass(els, className, fnName) {
      for (var i = 0; i < els.length; i++) {
          els[i].classList[fnName](className);
      }
    }

    // $('a.propuesta-uno').click(function() {
    //     if (!$('.mv-propuestas').hasClass('opcion-uno')){
    //         $('.diywme').addClass('just-uno');
    //     };
    // });

    // $('a.sidebar-right-toggle').click(function() {
    //     if ($('.sidebar').hasClass('sidebar-left')){
    //         $('.sidebar').removeClass('sidebar-left');
    //     };
    // });
    //
    // $('a.no-sidebar-toggle').click(function() {
    //     if (!$('.content').hasClass('no-sidebar')){
    //         $('.content').addClass('no-sidebar');
    //     } else {
    //         $('.content').removeClass('no-sidebar');
    //     };
    // });
    //
    // $('a.hide-sidebar-toggle').click(function() {
    //     if (!$('.sidebar').hasClass('hide')){
    //         $('.sidebar').addClass('hide');
    //     } else {
    //         $('.sidebar').removeClass('hide');
    //     };
    // });

})( jQuery );

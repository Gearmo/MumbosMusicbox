// BACK TO TOP FUNCTION //
(function ($) {

    $(document).ready(function () {

        //nav bar function//
        $(document).on('click', '.navbar-collapse.in', function (e) {
            if ($(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle') {
                $(this).collapse('hide');
            }
        });

        $('body').scrollspy({
            target: '.navbar-collapse',
            offset: 195
        });

        //smooth scroll from nav bar//
        $('a.page-scroll').on("click", function (e) {
            e.preventDefault();
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('href')).offset().top - 50
            }, 1000);
        });

        //back to top scroll//        
        $(document).ready(function(){ 
            $(window).scroll(function(){ 
                if ($(this).scrollTop() > 100) { 
                    $('#scroll').fadeIn(); 
                } else { 
                    $('#scroll').fadeOut(); 
                } 
            }); 
            $('#scroll').click(function(){ 
                $("html, body").animate({ scrollTop: 0 }, 0); 
                return false; 
            }); 
        });

    });

})(jQuery);

/*
$(textarea).focus(function(){
    $(this).hide();
    $(bigfield).focus();
});

$(textarea).focusout(function(){
    if ($(this).val() === ""){
        $(bigfield).show();
    }
});
*/

const form = document.getElementsByClassName("formbase");

form.addEventListener('submit', function handleSubmit(event) {
  event.preventDefault();

  // 👇️ Send data to server here
  jQuery.ajax({
    url: "contactform.php",
  })

  // 👇️ CSS changes here
  
  // 👇️ Reset form here
  form.reset();
});

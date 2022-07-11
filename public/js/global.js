$(window).on('load', function () {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });
    $("#github-link").css("cursor", "pointer");
});

// Acessibilidade
$("#github-link").on("click keydown", (e) => {
    if (e.which == 13 || e.type == 'click') {
        mensagem = confirm("Será aberta uma outra página em seu navegador. (github.com/lezzin)");
        if (mensagem) {
            window.open('https://github.com/lezzin/')
        } else { };
    }
});

$label = $("#labelDarkSwitch");
$(window).on("load", function () {
    if ($("body").attr("data-theme") !== undefined) {
        if ($("body").attr("data-theme") == 'dark') {
            $label.addClass("fa-sun")
        } else {
            $label.addClass("fa-moon")
        }
    } else {
        $label.addClass("fa-moon")
    }
});

$label.on("click keydown", (e) => {
    if (e.which == 13 || e.type == 'click') {
        if ($label.hasClass('fa-moon')) {
            document.body.setAttribute("data-theme", "dark")
            $label.removeClass('fa-moon');
            $label.addClass('fa-sun');
        } else {
            document.body.removeAttribute("data-theme");
            $label.removeClass('fa-sun');
            $label.addClass('fa-moon');
        }
    }
});
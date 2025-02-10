$(document).ready(function () {
    function loadPopupComment() {
        $("body").on("click", "#ViewMoreComment", function() {
            $('body').addClass('open-modalcomment');
            setTimeout(function () {
                $('.modal__commentpopup').fadeIn(50);
            })
        });

        $("body").on("click", ".modal__bg, .modal__commentpopup .close-modal", function () {
            $('body').removeClass('open-modalcomment');
        });
    }

    loadPopupComment();
});


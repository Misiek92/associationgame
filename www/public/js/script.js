$(".card").on('click', function () {
    $(this).addClass("flipped");
    var game = $(this).data('game'),
        word = $(this).data('word');
        $(this).attr("data-discovered", "1");

    $.post("/discover-word", {game: game, word: word});
})

$(document).ready(function() {
    $(".card").each(function(i, e) {
       if ($(e).data('discovered') == 1) {
           $(e).addClass("flipped");
       } 
    });
})
$(".card").on('click', function () {
    $(this).addClass("flipped");
    var word = $(this).data('word');
    $(this).attr("data-discovered", "1");

    $.post("/discover-word", {game: name, word: word}, function (data) {
        if (data['won']) {
            if (data.won != 3) {
                var team = data.won == 0 ? "Czerwony" : "Niebieski";
                swal({
                    title: 'Wygrał zespoł ' + team,
                    html: 'Gratulacje!',
                    type: 'success',
                    confirmButtonColor: '#a1c941',
                    confirmButtonText: 'Ok',
                    closeOnConfirm: true
                }, function () {
                    location.reload(true);
                });
            } else {
                swal(
                        {
                            title: 'Ktoś odkrył czarne pole',
                            text: 'Przyznać się! Który zespół dokonał tego haniebnego czynu?',
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonColor: '#3085d6',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Czerwoni',
                            cancelButtonText: 'Niebiescy',
                            confirmButtonClass: 'confirm-class',
                            cancelButtonClass: 'cancel-class',
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }, function (isConfirm) {
                    if (isConfirm) {
                        $.post("/game/add-point", {game: name, team: "1"}, function () {
                            location.reload(true);
                        });
                    } else {
                        $.post("/game/add-point", {game: name, team: "0"}, function () {
                            location.reload(true);
                        });
                    }
                });
            }
        }
    });
});

function drawNewCards() {
    var w = words;
    $(".card").each(function (i, e) {
        $(e).removeClass("flipped");
        $($(e).children()[1]).removeClass();
        $($(e).children()[1]).addClass("back");
        $($(e).children()[1]).addClass("color-" + w[i]['team']);
        $($(e).children()[0]).html(w[i]['word'])
        $($(e).children()[1]).html(w[i]['word'])
        $(e).attr("data-discovered", w[i]['discovered']);
        $(e).attr("data-word", w[i]['word']);

    });
}

function refreshCards() {
    $(".card").each(function (i, e) {
        if ($(e).data('discovered') == 1) {
            $(e).addClass("flipped");
        }
    });
}

function checkDistribution() {
    $.get("/distribution/game/" + name, function (data) {
        var data = JSON.parse(data);
        words = data;
        if ($($(".card")[0]).data('word') != words[0].word) {
            drawNewCards();
        }
        $(".card").each(function (i, e) {
            if (data[i].discovered) {
                $(this).attr("data-discovered", "1");
                $(e).addClass("flipped");
            }
        });
    })
}

$(document).ready(function () {
    refreshCards()
    setInterval(function () {
        checkDistribution()
    }, 5000);

    $("#create").on("click", function () {
        $.post("/create-game/" + $("#newgame").val(), function() {
            window.location.replace("game/" + $("#newgame").val());
        });
    })
    
    $("#join").on("click", function () {
        window.location.replace("/game/" + $("#joingame").val());
    })

})
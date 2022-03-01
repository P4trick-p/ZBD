var number = Math.floor(Math.random() * 8) + 1;

function hide() {
    $("#slider").fadeOut(300);
}

function change_slide() {
    number++;
    if (number > 8) number = 1;

    var file = "<center><img max-height=\"500\" width=\"500\" src=\"images/slides/" + number + ".jpg\" /></center>";

    document.getElementById("slider").innerHTML = file;
    $("#slider").fadeIn(300);


    setTimeout("change_slide()", 5000);
    setTimeout("hide()", 4700);
}

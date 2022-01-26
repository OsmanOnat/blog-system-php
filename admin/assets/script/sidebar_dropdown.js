var dropDown = document.getElementsByClassName("dropdown-sidebar");
var menuDrop = document.getElementsByClassName("dropdown-container");

$(function () {
    $(dropDown).mouseover(function () {
        $(menuDrop).fadeIn(
            $(menuDrop).css(
                "display", "block",
            ), 600

        );


    });
    /*$(menuDrop).hover(function() {
        $(dropDown).mouseover(function() {
            $(menuDrop).fadeIn(500);
        });
    });*/
    $(dropDown).mouseout(function () {
        $(menuDrop).fadeOut(
            $(menuDrop).css(
                "display", "none",
            ), 600
        );
    });
});
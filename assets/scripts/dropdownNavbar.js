var dropDown = document.getElementsByClassName("dropdown");
var menuDrop = document.getElementsByClassName("menu-drop");

$(function () {  
    $(dropDown).mouseover(function () {  
        $(menuDrop).css(
            "display","block",
        );
    });
    $(dropDown).mouseout(function () {  
        $(menuDrop).css(
            "display","none",
        );
    });
});

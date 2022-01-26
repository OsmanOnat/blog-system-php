var spanMessage = document.getElementsByClassName("products-span-message");
var productsButton = document.getElementsByClassName("products-button");

$(function () {  
    $(productsButton).mouseover(function () {
        $(spanMessage).fadeIn(1000);
        $(spanMessage).css({
           "display" : "block",
           "color" : "green", 
        });
    });
    $(productsButton).mouseout(function () {  
        $(spanMessage).fadeOut(900);
        $(spanMessage).css({
            "display" : "none",
        });
    });
});
<?php

//Dosya oluştur!
/*if(isset($_POST['olustur'])){
    $sayi = 0;
    while($sayi<=5){
        if(file_exists("Test$sayi")){
            echo "Böyle Bir Dosya Var";
            $sayi++;
        }else{
            mkdir("Test$sayi");
            break;
        }
    }
}else{
    echo "Butona tıkla";
}


?>
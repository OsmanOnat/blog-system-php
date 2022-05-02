<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

require 'connection.php';

//var_dump($total_values);

$sayfa = @$_GET['sayfa'];

$total_values_query = $connection->prepare('SELECT COUNT(*) FROM duyurular');
$total_values_query->execute();
$total_values = $total_values_query->fetchColumn();

$toplam_veri = $total_values; //sql toplam satır sayısı

$gosterilecek = 2; //sql LIMIT gösterilecek yer

$sayfa_sayisi = ceil( $toplam_veri / $gosterilecek ); //sayfa_sayısını bul

if( empty($sayfa) || !is_numeric($sayfa)){
    $sayfa = 1;
} 

/**
 * LIMIT değerinin baslama miktarı .
 * sayfa 2 olduğunda 2*2 - 2 = 2   yani sayfa 2'de 2.ci satırdan başlar
 * sayfa 3 olduğunda 3*2 - 2 = 4   yani sayfa 3'de 4.cü satırdan başlar
 * 
 * $gosterilecek miktarı hep aynı kalır
 * 
 * ORDER BY ile verileri sıraladık
 * ASC ile en 1 den başlar
 * DESC ile en son verideb başlar
 */
$limit_basla = ($sayfa*$gosterilecek) - $gosterilecek; 

$veri_getir = $connection->prepare(
    'SELECT * FROM duyurular ORDER BY id ASC LIMIT '.$limit_basla.' , '.$gosterilecek.''
);
$veri_getir->execute();

while($row = $veri_getir->fetch(PDO::FETCH_ASSOC)){
    echo '
        <p style="background-color: aqua; padding: 10px">
            '.$row['duyuru'].'
        </p>
    ';
}


/**
 * sürekli olarak index.php?sayfa  çalışacağı için değişkenlerin değerleride değişecek
 * sayfa=1 olunca $limit_basla = 0  $gosterilecek = 2 olacak . böylelikle sadece 2 veri gözükecek
 * sayfa=2 olunca $limit_basla = 2  $gosterilecek = 2 olacak . 
 * sayfa=1 olunca $limit_basla = 4  $gosterilecek = 2 olacak . 
 * 
 * böyle böyle her sayfa değiştiğinde değişkenlerde bu değerler göre değişip , 
 * ona göre sql sorgusunda çalıştırılacaklar
 */


//sayfaları göster
echo'
    <a href="index.php?sayfa='.($sayfa < 1 ? $sayfa = $sayfa_sayisi : $sayfa - 1).'">
        Geri
    </a>
';

for($i = 1; $i <= $sayfa_sayisi; $i++){
    echo '
        &nbsp;&nbsp;
        <a href="index.php?sayfa='.$i.'">
            '.$i.'
        </a>
        &nbsp;&nbsp;
    ';
}

echo '
    <a href="index.php?sayfa='.($sayfa > $sayfa_sayisi ? $sayfa = 1 : $sayfa + 1).'">
        İleri
    </a>
';


/**
 * GERİ İŞLEMİ İÇİN
 * ($sayfa < 1 ? $sayfa = $sayfa_sayisi : $sayfa - 1)
 * 
 * eğerki $sayfa değeri 1 den küçükse en son sayfaya gönder
 * eğerki $sayfa değeri $sayfa_sayisi değerlerinin arasında bir sayı ise 1 eksilt
 * 
 * 
 * 
 * İLERİ İŞLEMİ İÇİN
 * ($sayfa > $sayfa_sayisi ? $sayfa = 1 : $sayfa + 1) anlamı tam olarak şu 
 * 
 * eğerki sayfa değeri sayfa sayısından büyükse $sayfa = 1 yap . 
 * yani en başa döndür.
 * 
 * eğerki $sayfa değeri $sayfa_sayisi'dan küçükse ileri işlemini yaptır . 
 * yani $sayfa değerini 1 arttır. 
 * 
 */


?>

    
</body>
</html>
<?php

session_start();
ob_start();
require_once("php/connection.php");

//Yazı Düzenle
if(isset($_GET['duzenle_id'])){
    
}

// KATEGORİ GET

//Kategori Sil
if (isset($_GET['kategori'])) {
    $kategoriislem = $connection->prepare("DELETE FROM kategoriler WHERE id= :id");
    $kategorisil = $kategoriislem->execute(array(
        'id' => $_GET['kategori'],
    ));

    if ($kategorisil) {
        echo "Kategori Silindi! <br>";
        header("refresh:1; url=kategoriler.php");
    } else {
        echo "Kategori Silinemedi! <br>";
    }
} else {
    //echo "Kategori id gelmemiş! <br>";
}


// DUYURU GET

//Duyuru Sil
if (isset($_GET['duyuru_id'])) {
    echo "Duyuru id gelmiş <br>";
    $duyuruislem = $connection->prepare("DELETE FROM duyurular WHERE id= :id");
    $duyurusil = $duyuruislem->execute(array(
        'id' => $_GET['duyuru_id'],
    ));

    if ($duyurusil) {
        echo "Duyuru Silindi! <br>";
        header("refresh:1; url=gosterge_paneli.php");
    } else {
        echo "Duyuru Silinemedi! <br>";
    }
} else {
    //echo "duyuru id gelmemiş! <br>";
}

//Duyuru Aktifleştir
if (isset($_GET['duyuru_aktif_id'])) {
    echo "Duyuru id gelmiş <br>";
    $duyuruAktifIslem = $connection->prepare("UPDATE duyurular SET duyuru_durum = 1 WHERE id=:id");
    $duyuruAktif = $duyuruAktifIslem->execute(array(
        'id' => $_GET['duyuru_aktif_id'],
    ));

    if ($duyuruAktif) {
        echo "Duyuru Aktif Edildi! <br>";
        header("refresh:0; url=gosterge_paneli.php");
    } else {
        echo "Bir hata var (duyuru aktifleştir)";
    }
} else {
    //echo "duyuru id gelmemiş! <br>";
}

//Duyuru Deaktifleştir
if (isset($_GET['duyuru_deaktif_id'])) {
    echo "Duyuru id gelmiş <br>";
    $duyuruDeaktifIslem = $connection->prepare("UPDATE duyurular SET duyuru_durum = 0 WHERE id=:id");
    $duyuruDeaktif = $duyuruDeaktifIslem->execute(array(
        'id' => $_GET['duyuru_deaktif_id'],
    ));

    if ($duyuruDeaktif) {
        echo "Duyuru Deaktif Edildi! <br>";
        header("refresh:0; url=gosterge_paneli.php");
    } else {
        echo "Bir hata var (duyuru deaktifleştir)";
    }
} else {
    //echo "duyuru id gelmemiş! <br>";
}

// YAZI SİL

if (isset($_GET['id'])) {
    $yaziislem = $connection->prepare("DELETE FROM yazilar WHERE id= :id");
    $yazisil = $yaziislem->execute(array(
        'id' => $_GET['id'],
    ));

    if ($yazisil) {

        echo "Yazı Silindi! <br>";
        header("refresh:1; url=yazilar.php");
    } else {
        echo "Yazı Silinemedi! <br>";
    }
} else {
    //echo "yazi seo link gelmemiş! <br>";
}

// Yorum Sil

if (isset($_GET['yorum_id'])) {
    $yorumislem = $connection->prepare("DELETE FROM yorumlar WHERE id= :yorum_id");
    $yorumsil = $yorumislem->execute(array(
        ':yorum_id' => $_GET['yorum_id'],
    ));

    if ($yorumsil) {

        echo "Yorum Silindi! <br>";
        header("refresh:1; url=yorumlar.php");
    } else {
        echo "Yorum Silinemedi! <br>";
    }
} else {
    //echo "yorum id gelmemiş! <br>";
}

ob_end_flush();
?>
<?php
session_start();
ob_start();
require_once("admin/php/connection.php");
include("admin/php/functions.php");
?>


<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <!---->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="css/owl.carousel.min.css" rel="stylesheet" type="text/html">
    <link href="css/owl.theme.default.min.css" rel="stylesheet" type="text/html">
    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <title>Blog</title>
    <link rel="shortcut icon" href="" type="image/x-icon">

    <!--Semantic UI-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js"></script>
</head>

<body>

    <!-- Back To Top Button --->
    <button id="topButton">
        <i class="fa fa-arrow-circle-up"></i>
    </button>

    <header>
        <div class="header-container">
            <div class="header-row row">
                <div class="header-col col-md-12">
                    <div class="header-left">
                        <div class="header-left-text">
                            <p class="left-text">
                                <?php
                                //Zaten tek bir veriyi göstereceği için kontrol yapmadım.
                                $duyuruSQL = "SELECT * FROM duyurular WHERE duyuru_durum = 1";

                                $duyuruIslem = $connection->query($duyuruSQL);
                                $duyuruIslem->execute();
                                $duyuruCek = $duyuruIslem->fetch(PDO::FETCH_ASSOC);

                                if ($duyuruCek) {
                                    echo '
                                    <i class="fa fa-bullhorn" style="font-weight:800; font-size: 20px;"></i> &nbsp;&nbsp; ' . $duyuruCek['duyuru'] . '
                                    '; // [0] ortadan kaldırırsan sorun çıkar . o yüzden [0] ekledim.
                                } else {
                                    echo '
                                    <i class="fa fa-bullhorn" style="font-weight:800; font-size: 25px;"></i> &nbsp;&nbsp;&nbsp; Şuanda Gösterilecek Bir Duyuru Yok!
                                    ';
                                }


                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <!--<div class="header-col col-md-6">
                    <div class="header-right">
                        <div class="header-right-text">
                            <p class="right-text">
                                Tüm Ürünlerde Geçerli %25 İndirim KAÇIRMA!
                            </p>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </header>


    <div class="menu-container navbar-container">
        <nav class="menu navbar navbar-expand-lg">
            <a class="menu-brand navbar-brand" href="index.php" style="color: white; font-size: 30px; margin-left: 10px; color: black; font-weight: 700;">
                Kişisel Blog Sitesi
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars"></i>
                </span>
            </button>
            <div class="menu-collapse collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="menu-nav navbar-nav ml-auto">
                    <!-- ml-auto ile sağa kaydırdık -->
                    <li class="menu-item nav-item">
                        <a class="menu-link nav-link" id="active" href="<?php echo "index.php" ?>">Anasayfa<span class="sr-only">(current)</span></a>
                    </li>
                    <!----<li class="menu-item nav-item">
                        <a class="menu-link nav-link" href="<?php echo "hakkimda.php" ?>">Hakkımda</a>
                    </li>--->
                            
                            <?php
                            $drop = $connection->prepare("SELECT * FROM kategoriler");
                            $drop->execute();
                            if ($drop) {
                                foreach ($drop as $drp) {
                                    echo '
                                    <li class="menu-item nav-item">
                                        <a class="menu-link nav-link" href="blog.php?kategori='.$drp['kategori_seo'].'" > ' . $drp['kategori_isim'] . '</a>
                                    </li>
                                    ';
                                }
                            }

                            ?>

                            
                </ul>
            </div>
        </nav>
    </div>

    <div class="breadcrumb-container container">
        <div class="breadcrumb-row row">
            <div class="breadcrumb-col col-md-12">
                <div class="breadcrumb">
                    <p class="breadcrumb-text" style="font-size: 15px;">
                        <?php

                        echo $kontrol->breadcrumbs2();

                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php

    /**
     * Amaç dizin yollarını almak . 
     * Bunları str_replace() ile uzantılırını kes veya boşluk bırak veya isimlerini değiştir .
     * dirname() kullanabilirsin.
     * $_SERVER["REQUEST_URI"] kullanabilirsin. (Sayfaya erişim için belirtilen URI; örneğin, '/index.html'.)
     */

    /*echo $_SERVER['HTTP_HOST'];
    echo $_SERVER['REQUEST_URI'];

    $crumbs = explode("/",$_SERVER['REQUEST_URI']);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(
          array("osmanblog",".php","_","=","?"),
          array("", " > ",""," "," "," ") , $crumb));

    }

    echo $_SERVER['REQUEST_URI'];
   echo "<br />"; 
    $expl = explode("/",$_SERVER['REQUEST_URI']);
    foreach($expl as $e){ // array halinde olduğu için foreach ile döngüye alıp yazırdık.
        echo ucfirst($e." ");
    }*/
    ?>
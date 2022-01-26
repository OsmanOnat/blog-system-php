<?php
session_start();
ob_start();
require_once('php/connection.php');

if (empty(isset($_SESSION['session']))) { // oturum açılmadığı için false döner ve bu sayfa açılmaz!
    header("Location:loginpage.php");
}
?>
<!DOCTYPE html>
<html lang="en">

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
    <link rel="shortcut icon" href="assets/img/favicon1.png" type="image/x-icon">

    <!--Semantic UI-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js"></script>

    <!--Sweet Alert-->
    <script type="text/javascript" src="sweetalert2.all.min.js"></script>
    <title>Document</title>
</head>

<body>

    <header>
        <div class="header">
            <div class="bg-dark" style="height: 50px;">
                <div class="brand ml-auto p-1 text-center">
                    <h1 style="color: white;">
                        ADMİN PANEL
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">

            <!---<div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 230px; max-height:600px;">
            <ul class="sidebar-nav nav nav-pills flex-column mb-auto">
                <li class="sidebar-nav-item nav-item">
                    <a href="gosterge_paneli.php" class="sidebar-nav-link nav-link p-3 text-white" style="font-size:20px;">
                        Gösterge Paneli
                    </a>
                </li>
                <li class="sidebar-nav-item nav-item">
                    <a href="kategoriler.php" class="sidebar-nav-link nav-link p-3 text-white" style="font-size:20px;">
                        Kategoriler
                    </a>
                </li>
                <li class="sidebar-nav-item nav-item">
                    <a href="#" class="sidebar-nav-link nav-link p-3 text-white" style="font-size:20px;">
                        Sayfalar
                    </a>
                </li>
                <li class="sidebar-nav-item nav-item">
                    <a href="yazilar.php" class="sidebar-nav-link nav-link p-3 text-white" style="font-size:20px;">
                        Yazılar
                    </a>
                </li>
                <li class="sidebar-nav-item nav-item">
                    <a href="yorumlar.php" class="sidebar-nav-link nav-link p-3 text-white" style="font-size:20px;">
                        Yorumlar
                    </a>
                </li>
                <li class="sidebar-nav-item nav-item">
                    <a href="#" class="sidebar-nav-link nav-link p-3 text-white" style="font-size:20px;">
                        Yönetim
                    </a>
                </li>
            </ul>
            <hr>

            <div class="dropdown">
                <span style="margin-left: 12px; margin-top: 20px;">
                <?php
                /*if (isset($_SESSION['adminName'])) {
                    echo $_SESSION['adminName'];
                } else {
                    echo "Session Bulunamadı!";
                }*/
                ?>
                </span>
                <form action="logout.php">
                    <input type="submit" class="btn btn-danger float-right" value="Çıkış Yap">
                </form>
            </div>

        </div>-->

            <div class="sidenav">
                <a href="gosterge_paneli.php">Gosterge Paneli</a>
                <a href="kategoriler.php">Kategoriler</a>
                <div class="dropdown-sidebar">
                    <a href="">Yazılar
                        <i class="fa fa-arrow-down" style="color: gray; font-size: 15px;"></i>
                    </a>
                    <div class="dropdown-container">
                        <a href="yazilar.php">Yazı Oluştur</a>
                        <a href="yazi_islem.php">Yazı İşlemleri</a>
                        <!---<a href="#">Link 2</a>
                        <a href="#">Link 3</a>--->
                    </div>
                </div>
                <a href="yorumlar.php">Yorumlar</a>
                <!---<a href="#">Yönetim</a>--->
                <br>
                <div class="sidebar-footer d-flex">
                    <p class="">
                        <?php
                        if (isset($_SESSION['adminName'])) {
                            echo '
                                <p class="mt-2 ml-1" style="color:whitesmoke; font-size:17px;">
                                    '.$_SESSION['adminName'].'
                                </p>
                            ';
                        } else {
                            echo "Session Bulunamadı!";
                        }
                        ?>
                    </p>
                    <a href="logout.php">
                        <button class="btn btn-danger">
                            Çıkış Yap
                        </button>
                    </a>
                </div>
            </div>

            <script defer src="assets/script/sidebar_dropdown.js"></script>

            <style>
                .sidenav {
                    height: 100%;
                    width: 190px;
                    position: fixed;
                    z-index: 1;
                    top: 0;
                    left: 0;
                    background-color: #111;
                    overflow-x: hidden;
                    padding-top: 20px;
                }

                /* Style the sidenav links and the dropdown button */
                .sidenav a,
                .dropdown-btn {
                    padding: 6px 8px 6px 16px;
                    text-decoration: none;
                    font-size: 20px;
                    color: #818181;
                    display: block;
                    border: none;
                    background: none;
                    width: 100%;
                    text-align: left;
                    cursor: pointer;
                    outline: none;
                }

                /* On mouse-over */
                .sidenav a:hover,
                .dropdown-btn:hover {
                    color: #f1f1f1;
                }

                /* Main content */
                .main {
                    margin-left: 200px;
                    /* Same as the width of the sidenav */
                    font-size: 20px;
                    /* Increased text to enable scrolling */
                    padding: 0px 10px;
                }

                /* Add an active class to the active dropdown button */
                .active {
                    background-color: green;
                    color: white;
                }

                /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
                .dropdown-container {
                    display: none;
                    background-color: #262626;
                    padding-left: 8px;
                }

                /* Optional: Style the caret down icon */
                .fa-caret-down {
                    float: right;
                    padding-right: 8px;
                }
            </style>

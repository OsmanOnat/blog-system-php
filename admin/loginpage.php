<?php
session_start();
require_once("php/connection.php");
include("php/functions.php");

if ($_POST) {
    $admin_username = $_POST['kullaniciadi'];
    $admin_password = $_POST['sifre'];

    $kontrol->cleanPost($admin_username);
    $kontrol->cleanPost($admin_password);

    if (isset($_POST["loginbutton"])) {
        if (empty($admin_username) && empty($admin_password)) {
            echo '
                <script>
                    alert("Boş Alan Bırakma!");
                </script>
            ';
            header("refresh:0.1;");
        } else {
            $login = $connection->prepare("SELECT * FROM admin WHERE admin_kullanici_adi = :adminkullaniciadi AND admin_password = :adminpassword");
            $login->bindParam(":adminkullaniciadi",$admin_username);
            $login->bindParam(":adminpassword",$admin_password);
            $login->execute();
            $data = $login->fetch(PDO::FETCH_ASSOC);

            if ($login->rowCount()) {

                if ($admin_username == $data['admin_kullanici_adi']) {
                    if ($admin_password == $data['admin_password']) {

                        $changeAdminStatus = $connection->query('UPDATE admin SET admin_status = 1 WHERE admin_kullanici_adi = "' . $data['admin_kullanici_adi'] . '" ');

                        if ($changeAdminStatus == TRUE) {
                            $_SESSION['girisbasarili'] =  "Giriş Başarılı!";
                            $_SESSION['adminUsernameStatus'] = $data['admin_kullanici_adi'];
                            $_SESSION['adminName'] = $data['admin_kullanici_adi'];
                            $_SESSION['session'] = true;
                            echo "Status Değişti!";
                            header("refresh:3; url=gosterge_paneli.php");
                        }
                        else{
                            echo "Status Değişmedi!". $connection->error;
                            header("refresh:0.1;");
                        }


                    } else {
                        echo '
                            şifre hatalı!
                        ';
                        header("refresh:0.1");
                    }
                } else {
                    echo '
                        kullanıcı isim hatalı!
                    ';
                    header("refresh:0.1");
                }
            }
        }
    }
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

    <title>Admin Login</title>
</head>

<body>

    <style>
        body {
            background: #222D32;
            font-family: 'Roboto', sans-serif;
        }

        .login-box {
            margin-top: 75px;
            height: auto;
            background: #1A2226;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .login-key {
            height: 100px;
            font-size: 80px;
            line-height: 100px;
            background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-title {
            margin-top: 15px;
            text-align: center;
            font-size: 30px;
            letter-spacing: 2px;
            margin-top: 15px;
            font-weight: bold;
            color: #ECF0F5;
        }

        .login-form {
            margin-top: 25px;
            text-align: left;
        }

        input[type=text] {
            background-color: #1A2226;
            border: none;
            border-bottom: 2px solid #0DB8DE;
            border-top: 0px;
            border-radius: 0px;
            font-weight: bold;
            outline: 0;
            margin-bottom: 20px;
            padding-left: 0px;
            color: #ECF0F5;
        }

        input[type=password] {
            background-color: #1A2226;
            border: none;
            border-bottom: 2px solid #0DB8DE;
            border-top: 0px;
            border-radius: 0px;
            font-weight: bold;
            outline: 0;
            padding-left: 0px;
            margin-bottom: 20px;
            color: #ECF0F5;
        }

        .form-group {
            margin-bottom: 40px;
            outline: 0px;
        }

        .form-control:focus {
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-bottom: 2px solid #0DB8DE;
            outline: 0;
            background-color: #1A2226;
            color: #ECF0F5;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0;
        }

        label {
            margin-bottom: 0px;
        }

        .form-control-label {
            font-size: 10px;
            color: #6C6C6C;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-outline-primary {
            border-color: #0DB8DE;
            color: #0DB8DE;
            border-radius: 0px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .btn-outline-primary:hover {
            background-color: #0DB8DE;
            right: 0px;
        }

        .login-btm {
            float: left;
        }

        .login-button {
            padding-right: 0px;
            text-align: right;
            margin-bottom: 25px;
        }

        .login-text {
            text-align: left;
            padding-left: 0px;
            color: #A2A4A4;
        }

        .loginbttm {
            padding: 0px;
        }
    </style>


    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key mt-5">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMIN PANEL
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" class="form-control" name="kullaniciadi">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" class="form-control" name="sifre">
                            </div>

                            <div class="col-lg-6 loginbttm">
                                <input type="submit" class="btn btn-success" name="loginbutton" id="" value="Giriş Yap">
                                <br>
                            </div>
                            <br>

                            <?php
                            if (empty($_SESSION)) { // session yoksa boş bırak
                                echo "";
                            } else {
                                if (empty($_SESSION['girisbasarili'])) {
                                    echo "";
                                } else {
                                    if ($_SESSION['girisbasarili'] == null) { // session değer yoksa sadece alert div göster
                                        echo '
                                            <div class="alert alert-success" role="alert">
                                            
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            ';
                                    }
                                    if ($_SESSION['girisbasarili'] != null) { // session değer varsa alert mesajını göster
                                        echo '
                                            <div class="alert alert-success" role="alert">
                                                ' . $_SESSION['girisbasarili'] . '
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            ';
                                    }
                                }
                            }

                            ?>

                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>

        <script src="assets/script/sweetalert2.all.min.js"></script>

</body>

</html>
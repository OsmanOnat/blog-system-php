<?php
session_start();
require_once("php/connection.php");

$changeAdminStatus = $connection->query('UPDATE admin SET admin_status = 0 WHERE admin_kullanici_adi = "' . $_SESSION['adminUsernameStatus'] . '" ');

if ($changeAdminStatus == TRUE) {
    echo "Status Değişti! <br /> Çıkış Yapılıyor";
    header("refresh:2; url=loginpage.php");
    session_destroy();
} else {
    echo "Status Değişmedi!" . $connection->error;
}

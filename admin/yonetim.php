<?php
ob_start();
require_once("php/connection.php");
include("php/functions.php");
include("header.php");
?>



<table class="table mt-3 ml-3">
    <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">İsim</th>
            <th scope="col">Soyisim</th>
            <th scope="col">Kullanıcı Adı</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Durum (Aktiflik)</th>
            <th scope="col">İşlemler</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php

            $admin = $connection->prepare("SELECT * FROM admin");
            $admin->execute();
            //$data = $admin->fetch(PDO::FETCH_ASSOC);

            //echo $data->admin_name;

            

            if ($admin) {
                foreach ($admin as $d) {
                    echo '
                    <th scope="row">'.$d['id'].'</th>
                    <td>'.$d['admin_name'].'</td>
                    <td>'.$d['admin_surname'].'</td>
                    <td>'.$d['admin_kullanici_adi'].'</td>
                    <td>'.$d['admin_mail'].'</td>
                    <td>'.$d['admin_status'].'</td> 
                    <td>
                        <a href="#">
                            <input type="submit" value="Sil" class="btn btn-danger">
                        </a>
                        <a href="#">
                            <input type="submit" value="Şifre Değiştir" class="btn btn-info">
                        </a>
                    </td>
                    ';
                }
            } else {
                echo "data yok!";
            }

            ?>
            
        </tr>
    </tbody>
</table>

<?php

/*$admin = $connection->prepare("SELECT * FROM admin");
$admin->execute();
$data = $admin->fetch(PDO::FETCH_ASSOC);

if ($data) {
    foreach ($data as $d) {
        echo $d;
    }
} else {
    echo "data yok!";
}*/

?>


<?php
include("footer.php");
?>
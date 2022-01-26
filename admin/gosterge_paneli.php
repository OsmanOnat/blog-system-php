<?php

ob_start();
require_once("php/connection.php");
include("php/functions.php");
include("header.php");


if ($_POST) {

    $duyuruMesaj = $_POST['duyurumesaj'];
    $duyuru_durum = 0;
    $mesajLen = 35;

    if (isset($duyuruMesaj)) {

        if (empty($duyuruMesaj)) {
            echo "Boş alanları dolduralım!";
        }
        if (strlen($duyuruMesaj) >= $mesajLen) {
            echo "En Fazla $mesajLen Karakter Girebilirsin!";
            header("refresh:2; url=gosterge_paneli.php");
        } else {

            $duyuruYap = $connection->prepare("INSERT INTO duyurular SET duyuru = ? , duyuru_durum = ?");
            $duyuruYap->execute(array(
                $duyuruMesaj,
                $duyuru_durum,
            ));

            if ($duyuruYap) {
                echo "Duyuru Kaydedildi!";
                header("refresh:0");
            } else {
                echo "Duyuru Kaydedilemedi!";
            }
        }
    } else {
        echo "Duyuru mesajı yok!";
    }
}



?>

<div class="container ml-3">
    <div class="row">
        <div class="col-md-12">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="input-group mb-3 mt-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Duyuru</span>
                    </div>
                    <input type="text" class="form-control" name="duyurumesaj" placeholder="Duyuru Mesajı Gir">
                    <input type="submit" class="btn btn-success ml-2" name="duyurubutton" value="Ekle">

                </div>
            </form>
        </div>
    </div>


    <div class="col-md-12 mt-2">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Duyuru</th>
                    <th scope="col">Duyuru Durum</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $duyuruListele = "SELECT * FROM duyurular";
                foreach ($connection->query($duyuruListele) as $listele) : ?>
                    <tr>
                        <th scope="row"><?php echo $listele['id'] ?></th>
                        <td><?php echo $listele['duyuru'] ?></td>
                        <?php
                        if ($listele['duyuru_durum'] == 1) {
                            echo ' <td style="background-color:green; color:whitesmoke; font-weight: 700; text-align:center;"> Aktif ( ' . $listele['duyuru_durum'] . ' )</td>';
                        } else {
                            echo '<td style="background-color:#ff2020; color:black; font-weight: 700; text-align:center;"> Aktif Değil ( ' . $listele['duyuru_durum'] . ' )</td>';
                        }
                        ?>
                        <td>
                            <a href="getprocess.php?duyuru_aktif_id=<?= $listele['id'] ?>">
                                <input type="submit" class="btn btn-success" name="aktif" value="Aktifleştir">
                            </a>
                            <a href="getprocess.php?duyuru_deaktif_id=<?= $listele['id'] ?>">
                                <input type="submit" class="btn btn-warning" name="deaktif" value="Deaktif Et">
                            </a>
                            <a href="getprocess.php?duyuru_id=<?= $listele['id'] ?>">
                                <input type="submit" class="btn btn-danger" name="sil" value="sil">
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>

</div>

<?php

$toplamKategori = $connection->prepare("SELECT COUNT(*) as `toplamkategori` FROM kategoriler");
$toplamKategori->execute();
$toplamKategoriData = $toplamKategori->fetch(PDO::FETCH_ASSOC);

$toplamYazilar = $connection->prepare("SELECT COUNT(*) as `toplamyazilar` FROM yazilar");
$toplamYazilar->execute();
$toplamYazilarData = $toplamYazilar->fetch(PDO::FETCH_ASSOC);

$toplamYorum = $connection->prepare("SELECT COUNT(*) as `toplamyorumlar` FROM yorumlar");
$toplamYorum->execute();
$toplamYorumData = $toplamYorum->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
    <div class="row">

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h1>
                        Toplam Tıklanma
                    </h1>
                    <h1>
                        <?= "145"?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h1>
                        Toplam Kategori
                    </h1>
                    <h1>
                        <?= $toplamKategoriData['toplamkategori']; ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h1>
                        Toplam Yazı
                    </h1>
                    <h1>
                        <?= $toplamYazilarData['toplamyazilar']?>
                    </h1>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h1>
                        Toplam Yorum
                    </h1>
                    <h1>
                        <?= $toplamYorumData['toplamyorumlar']?>
                    </h1>
                </div>
            </div>
        </div>

    </div>
</div>





<?php
include("footer.php");
ob_end_flush();
?>
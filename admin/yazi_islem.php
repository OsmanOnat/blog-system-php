<?php
require_once('php/connection.php');
include("php/functions.php");
include("header.php");
$kategoriCek = $connection->prepare("SELECT * FROM kategoriler");
$kategoriCek->execute();
$kategoriData = $kategoriCek->fetch(PDO::FETCH_ASSOC);


?>
<div class="container">
<div class="row">
        <div class="col-md-12 mt-2">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Yazı ID</th>
                        <th scope="col">Yazı Başlık</th>
                        <th scope="col">Yazı Kategori</th>
                        <th scope="col">Yazı İçerik</th>
                        <th scope="col">Yazı Beğeni</th>
                        <th scope="col">Yazı Yorum</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $yazilarListeleSQL = "SELECT * FROM yazilar";
                    foreach ($connection->query($yazilarListeleSQL) as $yaziListele) : ?>
                        <tr>
                            <th scope="row"><?= $yaziListele['id'] ?></th>
                            <td><?= $yaziListele['yazi_baslik'] ?></td>
                            <td><?= $yaziListele['yazi_kategori'] ?></td>
                            <td style="word-break: break-all; width:200px;"><?= substr($yaziListele['yazi_icerik'], 0, 80) ?></td>
                            <td><?= $yaziListele['yazi_begeni'] ?></td>
                            <td><?= $yaziListele['yazi_yorum'] ?></td>
                            <td>
                                <button class="btn btn-warning" name="düzenle" data-toggle="modal" data-target="#duzenleModal<?= $yaziListele['id'] ?>">Düzenle</button>
                                <a href="getprocess.php?id=<?= $yaziListele['id'] ?>">
                                    <button class="btn btn-danger" name="sil">Sil</button>
                                </a>
                            </td>
                        </tr>

                        <?php
                        
                        /**
                         * Modal'da id=duzenleModal ve data-target id aynı olmalı yoksa çalışmaz.
                         */
                        
                        ?>

                        <div class="modal fade" id="duzenleModal<?= $yaziListele['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yazıyı Düzenle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                            <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Yazı ID</label>
                                                <input type="text" name="duzenleYaziID" class="form-control" id="recipient-name" value="<?= $yaziListele['id'] ?>">
                                                <label for="recipient-name" class="col-form-label">Yazı Başlık</label>
                                                <input type="text" name="duzenleYaziBaslik" class="form-control" id="recipient-name" value="<?= $yaziListele['yazi_baslik'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Yazı İçeriği</label>
                                                <textarea name="duzenleYaziIcerik" class="form-control" id="message-text" ><?=$yaziListele['yazi_icerik']?></textarea>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Geri</button>
                                            <a href="yazilar.php">
                                                <input type="submit" class="btn btn-primary" name="modalDuzenle" value="Düzenlemeyi Tamamla">
                                            </a>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php



if(isset($_POST['modalDuzenle'])){

    $duzenleYaziID = $_POST['duzenleYaziID'];
    $duzenleYaziBaslik = $_POST['duzenleYaziBaslik'];
    $duzenleYaziIcerik = $_POST['duzenleYaziIcerik'];

    $modalYaziDuzenle = $connection->prepare('UPDATE yazilar SET yazi_baslik = "'.$duzenleYaziBaslik.'" , yazi_icerik = "'.$duzenleYaziIcerik.'"  WHERE id = "'.$duzenleYaziID.'"');
    $modalYaziDuzenle->execute();

    if($modalYaziDuzenle){

        header("refresh:2; url=yazi_islem.php");
        
    }else{
        echo 'Bir şey ters gitti düzenlemede!';
    }
    
}/*else{
    echo "Bir veri yok!";
}*/



?>
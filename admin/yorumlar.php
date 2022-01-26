<?php
require_once('php/connection.php');
include("php/functions.php");
include("header.php");
$yorumSQL = "SELECT * FROM yorumlar";
/*$yorumCek = $connection->prepare("SELECT * FROM yorumlar");
$yorumCek->execute();
$yorumData = $yorumCek->fetch(PDO::FETCH_ASSOC);*/
?>

<div class="yazilar-container container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Yorum ID</th>
                        <th scope="col">Yorum Yapan</th>
                        <th scope="col">Yorum Yapan Email</th>
                        <th scope="col">Yorum İçerik</th>
                        <th scope="col">Yorum Sayfa ID</th>
                        <th scope="col">Yorum Durumu</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($connection->query($yorumSQL) as $yorumListele) : ?>
                        <tr>
                            <th scope="row"><?= $yorumListele['id'] ?></th>
                            <td><?= $yorumListele['yorum_ad'] ?></td>
                            <td><?= $yorumListele['yorum_email'] ?></td>
                            <td style="word-break: break-all; width:200px;"><?= $kontrol->kisalt($yorumListele['yorum_message'])?></td>
                            <td><?= $yorumListele['yorum_link'] ?></td>
                            <td><?= $yorumListele['yorum_durum'] ?></td>
                            <td class="d-flex">
                                <button class="btn btn-warning" name="düzenle" data-toggle="modal" data-target="#duzenleModal<?= $yorumListele['id'] ?>">Düzenle</button>
                                <a href="getprocess.php?yorum_id=<?= $yorumListele['id'] ?>">
                                    <button class="btn btn-danger ml-2" name="düzenle">Sil</button>
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="duzenleModal<?= $yorumListele['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yorumu Düzenle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                            <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Yorum ID</label>
                                                <input type="text" name="duzenleYorumID" class="form-control" id="recipient-name" value="<?= $yorumListele['id'] ?>">
                                                <label for="recipient-name" class="col-form-label">Yorum Yapan</label>
                                                <input type="text" name="duzenleYorumAd" class="form-control" id="recipient-name" value="<?= $yorumListele['yorum_ad'] ?>">
                                                <label for="recipient-name" class="col-form-label">Yorum Email</label>
                                                <input type="text" name="duzenleYorumMail" class="form-control" id="recipient-name" value="<?= $yorumListele['yorum_email'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Yazı İçeriği</label>
                                                <textarea name="duzenleYorumIcerik" class="form-control" id="message-text" ><?=$yorumListele['yorum_message']?></textarea>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Geri</button>
                                            <a href="yorumlar.php">
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

    $duzenleYorumID = $_POST['duzenleYorumID'];
    $duzenleYorumAd = $_POST['duzenleYorumAd'];
    $duzenleYorumEmail = $_POST['duzenleYorumMail'];
    $duzenleYorumIcerik = $_POST['duzenleYorumIcerik'];

    $modalYorumDuzenle = $connection->prepare('UPDATE yorumlar SET yorum_ad = "'.$duzenleYorumAd.'" , yorum_email = "'.$duzenleYorumEmail.'" , yorum_message = "'.$duzenleYorumIcerik.'"  WHERE id = "'.$duzenleYorumID.'"');
    $modalYorumDuzenle->execute();

    if($modalYorumDuzenle){

        header("refresh:0; url=yorumlar.php");
        
    }else{
        echo 'Bir şey ters gitti düzenlemede!';
    }
    
}/*else{
    echo "Bir veri yok!";
}*/
?>

<div class="container">
    <div class="row">



    </div>
</div>

<?php
include("footer.php");
?>
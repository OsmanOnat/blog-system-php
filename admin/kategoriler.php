<?php

ob_start(); // header hatası çözümü Warning: Cannot modify header information - headers already sent by
require_once("php/connection.php");
require_once("php/functions.php");
include("header.php");

if($_POST){
    $kategori_isim = $kontrol->cleanPost($_POST['kategori_isim']);
    $kategori_seo = $kontrol->sef($_POST['kategori_isim']);

    $ktgr = $connection->prepare("INSERT INTO kategoriler SET kategori_isim=?,kategori_seo=?");
    $ktgr->execute(array(
        $kategori_isim,
        $kategori_seo,
    ));

    if($ktgr){
        echo "eklendi";
        header("refresh:0");
    }
    else{
        echo "eklenmedi";
    }
    
}

?>


<div class="container">
    <div class="row">

    
    <div class="col-md-4">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="input-group mb-3 mt-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Kategori</span>
                    </div>
                    <input type="text" class="form-control" name="kategori_isim" placeholder="Kategori Gir">
                    <input type="submit" class="btn btn-success ml-2" name="kategoributton" value="Ekle">

                </div>
            </form>
        </div>

        <div class="col-md-8 mt-2">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Kategori İsim</th>
                        <th scope="col">Kategori Seo</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                $kategoriListele = "SELECT * FROM kategoriler";
                foreach($connection->query($kategoriListele) as $listele) : ?>
                    <tr>
                    <th scope="row"><?php echo $listele['id']?></th>
                        <td><?php echo $listele['kategori_isim']?></td>
                        <td><?php echo $listele['kategori_seo']?></td>
                        <td>
                            <button class="btn btn-warning" name="düzenle">Düzenle</button>
                            <a href="getprocess.php?kategori=<?= $listele['id']?>">
                                <button class="btn btn-danger">
                                    Sil
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                        
                    
                </tbody>
            </table>
        </div>

    </div>
</div>


<?php
include("footer.php");
ob_end_flush();
?>
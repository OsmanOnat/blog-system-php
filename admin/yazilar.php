<?php
require_once('php/connection.php');
include("php/functions.php");
include("header.php");
$kategoriCek = $connection->prepare("SELECT * FROM kategoriler");
$kategoriCek->execute();
$kategoriData = $kategoriCek->fetch(PDO::FETCH_ASSOC);


?>





<div class="yazilar-container container">
    <div class="row">

        <div class="col-md-12 mt-1 bg-light"><p>
    İlk başta undefinined hatası verdi butona tıklayınca gitti ve sonra birşey düzenlemek istediğimde update işlemi sorunsuz çalıştı.
</p>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <label for="email">Yazı Başlık</label>
                    <input name="yazi_baslik" type="text" class="form-control" placeholder="Yazı Başlık">
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Kategori</label>
                    <input type="text" name="yazi_kategori" class="form-control" placeholder="Kategori Gir">
                </div>
                <div class="form-group">
                    <label for="password">İcerik</label>
                    <textarea name="yazi_icerik" class="form-control" placeholder="İçerik" rows="10"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <input type="submit" name="yaziEkle" class="btn btn-success">
                </div>
            </form>
        </div>

    </div>
</div>

<?php

if(isset($_POST['yaziEkle'])){
    if(isset($_POST['yazi_baslik']) && isset($_POST['yazi_kategori']) && isset($_POST['yazi_icerik'])){
        $yaziBaslik = $_POST['yazi_baslik'];
        $yaziBaslikSeo = $kontrol->sef($_POST['yazi_baslik']);
        $yaziKategori = $_POST['yazi_kategori'];
        $yaziIcerik = $_POST['yazi_icerik'];
        $yaziBegeni = 0;
        $yaziYorum = 0;
        $yaziDurum = 0;
        if(empty($_POST['yazi_baslik']) && empty($_POST['yazi_kategori']) && empty($_POST['yazi_icerik'])){
            echo "Boş alanları doldur!";
            header("refresh:2;url=yazilar.php");
        }else{

            $yaziIslem = $connection->prepare("INSERT INTO yazilar SET yazi_baslik = ? , yazi_baslik_seo = ? , yazi_kategori = ? , yazi_icerik = ? , yazi_begeni = ? , yazi_yorum = ? , yazi_durum = ?");
            $yaziIslem->execute(array(
                $yaziBaslik,
                $yaziBaslikSeo,
                $yaziKategori,
                $yaziIcerik,
                $yaziBegeni,
                $yaziYorum,
                $yaziDurum,
            ));

            if($yaziIslem){
                echo "Yazı Eklendi!";
                header("refresh:2;url=yazilar.php");
            }else{
                echo "Yazı Eklenemedi!";
                header("refresh:2;url=yazilar.php");
            }

        }
    }
    /*echo "İsset hata";
    header("refresh:2;url=yazilar.php");*/
}

?>

<?php

/*if ($_FILES["dosya"]) {

  $yol = "dosyalar";

  $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["dosya"]["name"];

  if ( file_exists($yuklemeYeri) ) {

      echo "Dosya daha önceden yüklenmiş";

  } else {

      if ($_FILES["dosya"]["size"]  > 1000000) {

          echo "Dosya boyutu sınırı";

      } else {

          $dosyaUzantisi = pathinfo($_FILES["dosya"]["name"], PATHINFO_EXTENSION);

          if ($dosyaUzantisi != "jpg" && $dosyaUzantisi != "png") { # Dosya uzantı kontrolü

              echo "Sadece jpg ve png uzantılı dosyalar yüklenebilir.";

          } else {

              $sonuc = move_uploaded_file($_FILES["dosya"]["tmp_name"], $yuklemeYeri);

              echo $sonuc ? "Dosya başarıyla yüklendi" : "Hata oluştu";

          }

      }

  }

} else {

  echo "Lütfen bir dosya seçin";

}*/

?>





<?php
include("footer.php");
?>
<?php
//session_start();  header.php başlatıldı!
ob_start();
//require_once("admin/php/connection.php"); header.php kısmında başlatıldı!
//include("admin/php/functions.php");
include("header.php");

if($_POST){

  $iletisim_isim = $_POST['isim'];
  $iletisim_email = $_POST['email'];
  $iletisim_mesaj = $_POST['mesaj'];

  if(isset($iletisim_isim) && isset($iletisim_email) && isset($iletisim_mesaj)){
      if(empty($iletisim_isim) && empty($iletisim_email) && empty($iletisim_mesaj)){
        echo '
          <font>
          Boş alanları doldurmalısın!
          </font>
        ';
      }else{
        
        if(filter_var($iletisim_email, FILTER_VALIDATE_EMAIL)){
          echo "E-Mail Geçerli";
        }else{
          echo "E-Mail Geçerli Değil!";
        }

      }
  }else{
    echo "İletisim Post değerleri yok (isset)";
  }


}


?>

<style>
    .form-box {
  max-width: 500px;
  margin: auto;
  margin-top: 20px;
  padding: 50px;
  background: #ffffff;
  box-shadow: 1px 1px 4px 4px #e8e8e8;
}


input, textarea {
  width: 100%;
}
</style>

<div class="form-box bg-light">
  <h1>Benimle İletişime Geç</h1>
  <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
      <label for="name">İsim</label>
      <input class="form-control" id="isim" type="text" name="isim">
    </div>
    <div class="form-group">
      <label for="email">E-Mail</label>
      <input class="form-control" id="email" type="email" name="email">
    </div>
    <div class="form-group">
      <label for="message">Mesajınız</label>
      <textarea class="form-control" id="message" name="mesaj"></textarea>
    </div>
    <input class="btn btn-success" type="submit" value="Gönder" />
    </div>
  </form>
</div>
<br><br><br>
<?php
include("footer.php");
ob_end_flush();
?>
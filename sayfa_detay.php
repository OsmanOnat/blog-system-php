<?php
include("header.php");



/*************************************/
//Yorum id ile yazi id birleşitirmek için!
$yaziSQL = $connection->prepare("SELECT * FROM yazilar");
$yaziSQL->execute();
$yaziCek = $yaziSQL->fetch(PDO::FETCH_ASSOC);

/**************************************/

/*$yorumSQL = $connection->prepare("SELECT * FROM yorumlar");
$yorumSQL->execute();
$yorumCek = $yorumSQL->fetch(PDO::FETCH_ASSOC);*/

$getYaziSeo = $kontrol->sef($_GET['seo']);

if ($_GET) {


  if (!$getYaziSeo) {
    //echo "Böyle bir sayfa yok!";
    header("refresh:0; url=404.php");
  } else {
    $yaziGetir = $connection->prepare("SELECT * FROM yazilar WHERE yazi_baslik_seo = ?");
    $yaziGetir->execute(array(
      $getYaziSeo,
    ));
    $yaziData = $yaziGetir->fetch(PDO::FETCH_ASSOC);

    //Veritabanında böyle bir sayfa yoksa
    if ($yaziData['yazi_baslik_seo'] == NULL) {
      header("refresh:0;url=404.php");
    } else {

      if ($yaziGetir->rowCount()) {


        echo '
              <div class="hakkimizda" style="margin-top:5px;">
              <div class="container">
                <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title text-center">
                        <h1><strong> ' . $yaziData['yazi_baslik'] . ' </strong></h1>
                      </div>
                      <p class="card-text">
                        ' . $yaziData['yazi_icerik'] . '
                      </p>
                      <div class="card-footer" align="center">
                        <!----<div class="ui labeled button" tabindex="0">
                          <div class="ui red button">
                            <i class="heart icon"></i> Beğeni
                          </div>
                          <a class="ui basic red left pointing label">
                            ' . $yaziData['yazi_begeni'] . '
                          </a>
                      </div>---->
                        <div class="ui labeled button" tabindex="0">
                          <div class="ui green button">
                            <i class="comment icon"></i> 
                            Yorumlar
                          </div>
                          <a class="ui basic green left pointing label">
                            ' . $yaziData['yazi_yorum'] . '
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
            
              ';
      }
    }
  }
} else {

  header("refresh:0; url=404.php");
}
?>


<?php
include("last-post.php");
?>


<style>
  .comment-container>.comment-row {
    border-radius: 5px;
    border: 1px solid lightgray;
  }

  .comment-form-container>.comment-form-row>.comment-form-col>.form-box {
    border-radius: 5px;
    border: 1px solid lightgray;
  }
</style>


<?php

$yorumGoster = $connection->prepare("SELECT * FROM yorumlar WHERE yorum_link");
$yorumGoster->execute();


?>

<div class="comment-form-container container mb-5">
  <div class="comment-form-row row">
    <div class="comment-form-col col-md-12">
      <div class="form-box bg-light p-4">
        <h1>Yorum Yap</h1>
        <form action="<?= $_SERVER['PHP_SELF'] . "?seo=" . $getYaziSeo ?>" method="post">
          <div class="form-group d-flex">
            <input class="form-control" id="isim" type="text" name="comment_name" placeholder="İsminiz">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input class="form-control" id="email" type="email" name="comment_email" placeholder="E-Mail">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="message" name="comment_message" rows="5" placeholder="Mesajınız"></textarea>
          </div>
          <input class="btn btn-success" type="submit" value="Yorum Yap" name="comment_button" />
      </div>
      </form>
    </div>
  </div>
</div>

<?php


$getYaziYorumSeo = $_GET['seo'];

if (isset($_POST['comment_button'])) {

  $comment_name = trim($_POST['comment_name']);
  $comment_email = trim($_POST['comment_email']);
  $comment_message = trim($_POST['comment_message']);
  $comment_link_seo = $getYaziYorumSeo;
  $comment_durum = 0;

  if (isset($comment_name) || isset($comment_message) || isset($comment_email)) {
    if (!filter_var($comment_email, FILTER_VALIDATE_EMAIL)) {
      echo "Email Geçersiz";
      header('refresh:3; url=sayfa_detay.php?seo=' . $getYaziYorumSeo . ' ');
    } else {
      if (empty($comment_name) || empty($comment_message) || empty($comment_email)) {
        echo "Boş alanları Doldur!";
        header('refresh:3; url=sayfa_detay.php?seo=' . $getYaziYorumSeo . ' ');
      } else {

        $comment = $connection->prepare("INSERT INTO yorumlar (yorum_ad,yorum_email,yorum_message,yorum_link,yorum_durum) VALUES (?,?,?,?,?)");
        $comment->execute(array(
          $comment_name,
          $comment_email,
          $comment_message,
          $getYaziYorumSeo,
          $comment_durum
        ));

        if ($comment) {
          $yaziYorumUpdate = $connection->prepare("UPDATE yazilar SET yazi_yorum = yazi_yorum + 1 WHERE yazi_baslik_seo = '$getYaziYorumSeo' ");
          $yaziYorumUpdate->execute();
          echo "Yorum yapıldı!";
          header('refresh:3; url=sayfa_detay.php?seo=' . $getYaziYorumSeo . ' ');
        } else {
          echo "Yorum yapılamadı! HATA";
          header('refresh:3; url=sayfa_detay.php?seo=' . $getYaziYorumSeo . ' ');
        }
      }
    }
  }
}




/*if(!$getYaziYorumSeo){
  echo "Seo bulunamadı!";
  header("refresh:5; url=index.php");
  exit();
}else{

  if(isset($_POST['comment_name']) || isset($_POST['comment_email']) || isset($_POST['comment_message'])){
    if(empty($_POST['comment_name']) || empty($_POST['comment_name']) || empty($_POST['comment_name'])){
      echo "Boş alanları dolduralım!";
      header("refresh:3;");
    }
  }

}*/


// YORUMLARI LİSTELE

$yorumListeleSQL = $connection->prepare("SELECT * FROM yorumlar WHERE yorum_link = ?");
$yorumListeleSQL->execute(array(
  $getYaziYorumSeo
));

if ($yorumListeleSQL) {
  foreach ($yorumListeleSQL as $listele) {
    /*echo '
      Yorumu Yapan isim : '.$listele['yorum_ad'].' <br />
      Yorumu Yapan email : '.$listele['yorum_email'].' <br />
      Yorumu Yapan içerik : '.$listele['yorum_message'].' <br />
      Yorumu Yapan linki : '.$listele['yorum_link'].' <br />
      <br />
      <hr>
      <br />
    ';*/

    echo '
<div class="comment-container container">
  <div class="comment-row row bg-light p-3 mt-3">
    <div class="comment-col col-md-12 p-2">
      <div class="comment-head">
        <div class="ui large comments">
          <div class="comment">
            <a class="avatar">
              <img src="assets/img/comment_avatar.png">
            </a>
            <div class="content">
              <a class="author">
                ' . $listele['yorum_ad'] . '
              </a>
                | 
              <span>
                ' . $listele['yorum_email'] . '
              </span>
              <div class="metadata">
                <div class="date">2 days ago</div>
                <!----<div class="rating">
                  <i class="star icon"></i>
                  5 Faves
                </div>---->
              </div>
              <div class="text">
                ' . $listele['yorum_message'] . '
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
';
  }
} else {

  echo "Bu yazıya Ait bir yorum yok!";
}





?>



<br><br>





<?php
include("footer.php");
?>
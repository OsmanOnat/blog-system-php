<?php
include("header.php");
?>


<?php
$kategoriQuery = "SELECT * FROM kategoriler";
$yaziQuerySeo = "SELECT * FROM yazilar WHERE yazi_baslik_seo";

$kategori = $connection->prepare($kategoriQuery);
$kategori->execute();
$dataKategori = $kategori->fetch(PDO::FETCH_ASSOC);

$getKategoriSeo = $kontrol->sef($_GET['kategori']);


if (isset($_GET)) {
    if (isset($getKategoriSeo)) {
        $blogKategori = $connection->prepare("SELECT * FROM kategoriler WHERE kategori_seo = :kategori_seo");
        $blogKategori->bindParam(":kategori_seo", $getKategoriSeo);
        $blogKategori->execute();
        $blogKategoriData = $blogKategori->fetch(PDO::FETCH_ASSOC);

        if ($blogKategoriData == NULL) { //böyle bir kategori yoksa
            header("refresh:1;url=404.php");
        } else {
            //echo "Kategori Bulundu!";

            $yaziKategori = $connection->prepare("SELECT * FROM yazilar WHERE yazi_kategori = :yazi_kategori");
            $yaziKategori->bindParam(":yazi_kategori", $getKategoriSeo);
            $yaziKategori->execute();

            if ($yaziKategori->rowCount()) {

                //echo 'yazi vr seo bulundu!';


            } else { //böyle bir yazi veya seo linki yoksa
                header("refresh:0;url=404.php");
            }
        }
    } else {
        header("refresh:0;url=404.php");
    }
} else {
    header("refresh:0;url=404.php");
}

?>

<div class="container mt-2 mb-2 p-2">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                <?= $blogKategoriData['kategori_isim'] ?>
            </h1>
        </div>
    </div>
</div>

<br>

<div class="main-container container">
    <div class="main-row row">

        <?php while ($row = $yaziKategori->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="main-left-col col-md-12">
                <div class="main-left-card card text-left bg-light">
                    <div class="main-left-card-body card-body">
                        <div class="left-card-content card text-white bg-light">
                            <div class="left-card-content-body card-body">

                                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

                                    <div class="left-card-content-row row">
                                        <div class="left-card-content-col col-md-4">
                                            <img class="left-card-content-img" src="assets/img/dc-logo-1.png" alt="" lazy="loading" style="width:300px;">
                                        </div>
                                        <div class="left-card-content-col col-md-8">
                                            <h4 class="left-card-content-title" id="<?= $row['id'] ?>">
                                                <a href="sayfa_detay.php?seo='<?= $row['yazi_baslik_seo'] ?>'">
                                                    <h1>
                                                        <?= $row['yazi_baslik'] ?>
                                                    </h1>
                                                </a>
                                            </h4>
                                            <p class="left-card-content-category">
                                                Kategori : <?= $row['yazi_kategori'] ?>
                                            </p>
                                            <p class="left-card-content-text">
                                                <?= $kontrol->kisalt($row['yazi_baslik']) ?>
                                                [...]
                                            </p>
                                            <div class="">
                                                <a href="sayfa_detay.php?seo=<?= $row['yazi_baslik_seo'] ?>">
                                                    <input class="btn btn-success" value="Detaya Git">
                                                </a>

                                                <div class="ui label">
                                                    <i class="like icon"></i>
                                                    <?= $row['yazi_begeni'] ?>
                                                </div>
                                                <div class="ui label">
                                                    <i class="comment icon"></i>
                                                    <?= $row['yazi_yorum'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>


    </div>
    <!--- main-row-end -->
</div>
<!--- main-container-end --->

<br><br>


<?php
include("footer.php");
?>
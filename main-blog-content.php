<?php
$yaziSQL = "SELECT * FROM yazilar ORDER BY id DESC LIMIT 5"; // burada id'si 1-5 arası içerikleri getirir .
$yaziSQLPopuler = "SELECT * FROM yazilar";
$kategoriSQL = "SELECT * FROM kategoriler";
?>

<div class="main-container container">
    <div class="main-row row">

        <div class="main-left-col col-md-8">
            <div class="main-left-card card text-left bg-light">
                <div class="main-left-card-body card-body">
                    <p class="main-left-card-title card-title">Gündem</p>
                    <div class="left-card-content card text-white bg-light">
                        <div class="left-card-content-body card-body">

                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

                                <?php

                                foreach ($connection->query($yaziSQL) as $yaziKey => $yaziListele) {


                                        echo '
                                            <div class="left-card-content-row row">
                                            <div class="left-card-content-col col-md-4">
                                                <img class="left-card-content-img" src="assets/img/blog-default.png" alt="" lazy="loading">
                                            </div>
                                            <div class="left-card-content-col col-md-8">
                                                <h4 class="left-card-content-title" id="'.$yaziListele['id'].'">
                                                    <a href="sayfa_detay.php?seo=' . $yaziListele['yazi_baslik_seo'] . '">
                                                        <h1>
                                                            ' . $yaziListele['yazi_baslik'] . '
                                                        </h1>
                                                    </a>
                                                </h4>
                                                <p class="left-card-content-category">
                                                    Kategori : '.$yaziListele['yazi_kategori'].'
                                                </p>
                                                    <p class="left-card-content-text">
                                                        ' . $kontrol->kisalt($yaziListele['yazi_icerik']) . '
                                                        [...]
                                                    </p>
                                                <div class="">
                                                    <a href="sayfa_detay.php?seo=' . $yaziListele['yazi_baslik_seo'] . '">
                                                        <input class="btn btn-success" value="Detaya Git">
                                                    </a>
            
                                                    <div class="ui label">
                                                        <i class="like icon"></i>
                                                            ' . $yaziListele['yazi_begeni'] . '
                                                    </div>
                                                    <div class="ui label">
                                                        <i class="comment icon"></i> 
                                                        ' . $yaziListele['yazi_yorum'] . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    ';
                                    
                                }

                                ?>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $yaziPopuler = $connection->prepare($yaziSQLPopuler);
        $yaziPopuler->execute();
        $yaziPopulerData = $yaziPopuler->fetchAll(PDO::FETCH_ASSOC);
        
            
        ?>

        <div class="right-col col-md-4">
            <div class="right-card card text-white bg-light">
                <img class="right-card-img card-img-top" src="holder.js/100px180/" alt="">
                <div class="right-card-body card-body">
                    <h4 class="right-card-title card-title">Popüler Yazılar</h4>

                    <?php foreach($yaziPopulerData as $yaziPopulerKey => $yaziPopulerValue){
                        if($yaziPopulerValue['yazi_yorum'] < 50 && $yaziPopulerValue['yazi_yorum'] > 1 ){
                            //echo $yaziPopulerValue['yazi_baslik'];
                            echo '
                                <p class="right-text card-text">
                                    <a href="sayfa_detay.php?seo='.$yaziPopulerValue['yazi_baslik_seo'].'" class="right-links" href="#" style="font-size:15px;">
                                        <span style="font-size:17px;"> > </span> &nbsp;&nbsp;&nbsp; '.$yaziPopulerValue['yazi_baslik'].'
                                    </a>
                                    <span class="ui basic label" style="background-color:transparent; border:none;">
                                        <i class="like icon ml-2"></i>
                                            '.$yaziPopulerValue['yazi_begeni'].'
                                        </span>
                                        <span class="ui basic label" style="background-color:transparent; border:none;">
                                        <i class="comment icon ml-2"></i>
                                            '.$yaziPopulerValue['yazi_yorum'].'
                                    </span>
                                </p> 
                            ';

                            
                        }
                    }

                    
                    ?>
                </div>
            </div>

            <div class="category-row row">
                <div class="category-col col-md-12">
                    <div class="category card bg-light">
                        <h4 class="category-title">
                            Kategoriler
                        </h4>
                        <div class="category-links">
                            <ul class="links">
                                <?php
                                foreach($connection->query($kategoriSQL) as $kategoriLink){
                                    echo '
                                        <li class="items">
                                            <a href="blog.php?kategori='.$kategoriLink['kategori_seo'].'" class="item-href">
                                                '.$kategoriLink['kategori_isim'].'
                                            </a>
                                        </li>

                                        <hr>
                                    ';
                                }
                                
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/*$dizi = array();
foreach($yaziPopulerData as $d){
    if($d['yazi_begeni'] > 1){
        array_push($dizi,$kontrol->intCevir($d['yazi_begeni'])); // int çevirme işlemi yaptım (functions.php)
    }
}

krsort($dizi);

for($i=0;$i<count($dizi);$i++){
    echo $dizi[$i];
}

var_dump($dizi);*/

?>

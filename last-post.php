<?php
$sonYaziSQL = "SELECT * FROM yazilar ORDER BY id DESC LIMIT 4"; //en son girilen id'leri getirir.s (DESC)
?>


<div class="info-card-container container-fluid">
    <div class="info-card-title text-center">
        <p class="title-text text-center"><u> SON YAZILAR </u></p>
    </div>
    
    
    <div class="info-card-row row container">
    
        <?php

        foreach ($connection->query($sonYaziSQL) as $sonYaziListele) {

            echo '
            
                    <div class="info-card-col col-md-3">
                    <div class="info-card card">
                        <div class="info-card-body card-body">
                            <div class="info-card-image card-img">
                                <img src="assets/img/blog-default.png" class="img-fluid" lazy="loading">
                            </div>
                            <div class="info-card-title card-title">
                                <h3>
                                    <a href="sayfa_detay.php?seo='.$sonYaziListele['yazi_baslik_seo'].'">
                                        ' . $sonYaziListele['yazi_baslik'] . '
                                    </a>
                                </h3>
                            </div>
                            <span class="info-card-category">
                                Kategori : ' . $sonYaziListele['yazi_kategori'] . '
                            </span>
                            <br><br>
                            <div class="info-card-text card-text">
                                <p>
                                    ' . $kontrol->kisalt($sonYaziListele['yazi_icerik']) . ' [...]
                                </p>
                            </div>
                            <br>
                            <div class="info-card-footer">
                                <a href="sayfa_detay.php?seo=' . $sonYaziListele['yazi_baslik_seo'] . '">
                                    <input class="btn btn-success" value="Detaya Git">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                    ';
        }

        ?>

        <!--<div class="info-card-col col-md-3">
            <div class="info-card card">
                <div class="info-card-body card-body">
                    <div class="info-card-image card-img">
                        <img src="assets/img/2021-04-28_23.54.29.png" class="img-fluid">
                    </div>
                    <div class="info-card-title card-title">
                        <h3>Title</h3>
                    </div>
                    <span>
                        Kategori : kategori_isim
                    </span>
                    <br><br>
                    <div class="info-card-text card-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam sit ducimus modi dolorum
                            ipsum alias, adipisci, corporis maxime consectetur nam, accusamus vel. Esse corporis
                            voluptates nemo dolore harum dolorum id.</p>
                    </div>
                    <div class="info-card-footer">
                        <button class="info-card-button">Detaya Git</button>
                    </div>
                </div>
            </div>
        </div>--->
        
    </div>
    

</div>
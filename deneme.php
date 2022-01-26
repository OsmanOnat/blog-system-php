<?php

include("admin/php/functions.php");
include("admin/php/connection.php");

$sql = $connection->prepare("SELECT * FROM yazilar");
$sql->execute();

/*foreach($sql as $r){
    echo $r;
}*/

/*$array = array();
$sayac = 0;
while ($sayac < 256){
    $random = rand(0,256);
    array_push($array,$random);
    $sayac++;
}

echo "<pre>";
print_r($array);*/

$text = "osman";
$sifrele = md5(md5(sha1($text)));
$ip = $_SERVER['REMOTE_ADDR']; 
$server = $_SERVER;


/*echo "IP: ".$ip;
echo "<br>";
echo "Şifresiz : ".$text;
echo "<br>";
echo "Şifreli : ".$sifrele;
echo "<pre>";
echo "<br>";
print_r($server);
*/




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <input type="text" name="olustur" id="olustur">
        <input type="submit" value="olustur"> 
    </form>
    
</body>
</html>


<?php

/*$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));;
foreach($path as $p){
    echo $p;
}*/

$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
$host = $_SERVER['REQUEST_URI'];
$breadcrumbs = Array("<a href=\"$host\">Anasayfa</a>");
$last = array_keys($path);
$sep = " > ";



foreach($path as $p => $crumb){
    $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));
    if($p != $last){
        $breadcrumbs[] = "<a href='$crumb'>$title</a>";
        echo $breadcrumbs[$p].$sep;
    }
    
    
}



// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
/*function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS :)
    $base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = Array("<a href=\"$base\">$home</a>");

    // Find out the index for the last value in our path array
    $last = end(array_keys($path));

    // Build the rest of the breadcrumbs
    foreach ($path AS $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last)
            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
        // Otherwise, just display the title (minus)
        else
            $breadcrumbs[] = $title;
    }

    // Build our temporary array (pieces of bread) into one big string :)
    return implode($separator, $breadcrumbs);
}



?>

<p><?= breadcrumbs() ?></p>*/


?>

<?php
echo "<br />";echo "<br />";

//count:Bir dizideki veya bir Countable nesnesindeki eleman sayısını döndürür
//sizeof() : count() işlevini takma adıdır .

$ar1 = array("osman","onat","1234");
$ar2 = array(1,2,3,4);

for($i=0;$i<count($ar1);$i++){

    echo $ar1[$i]."<br />";

}

echo "<br />";echo "<br />";

for($i=0;$i<sizeof($ar2);$i++){

    echo $ar2[$i]."<br />";

}

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

                                            <div class="left-card-content-row row">
                                            <div class="left-card-content-col col-md-4">
                                                <img class="left-card-content-img" src="assets/img/dc-logo-1.png" alt="" lazy="loading">
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

                            </form>

                        </div>
                    </div>
                </div>
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

                                        <li class="items">
                                            <a href="blog.php?'.$kategoriLink['kategori_seo'].'" class="item-href">
                                                '.$kategoriLink['kategori_isim'].'
                                            </a>
                                        </li>

                                        <hr>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



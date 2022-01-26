<?php

class KontrolFonksiyonlar
{



    public function cleanPost($veri)
    {
        $veri = addslashes($veri);
        $veri = htmlspecialchars($veri);
        $veri = strip_tags($veri);
        $veri = stripslashes($veri);
        $veri = trim($veri);
        return $veri;
    }

    public function sef($text)
    {
        $bul = array("Ğ", "ğ", "Ü", "ü", "İ", "ı", "Ç", "ç", "Ş", "ş");
        $degistir = array("g", "g", "u", "u", "i", "i", "c", "c", "s", "s");
        $text = str_replace($bul, $degistir, $text);
        $text = strtolower($text);
        $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
        $text = trim(preg_replace('/\s+/', ' ', $text)); // cümlenin sonundaki - işaretini kaldırır.
        $text = str_replace(" ", "-", $text);
        return $text;
    }

    public function justAlphabet($a)
    {
        $result = ctype_alpha($a) ? "Sadece Harf Kullanıldı!" : "Rakam Kullanamazsın!";
        return $result;
    }

    public function kisalt($a)
    {
        $kisalt = substr($a, 0, 70);
        return $kisalt;
    }

    public function intCevir($a)
    {
        return (int)$a;
    }

    public function breadcrumb($sep = " > ", $anasayfa = "Anasayfa")
    {
        $server = "http://" . $_SERVER['HTTP_HOST'];
        $crumb = explode("/", $_SERVER['REQUEST_URI']);

        foreach ($crumb as $c) {
            echo '
                <a href=' . $server . '>' . $c . '</a>;
            ';
        }
    }

    function breadcrumbs2($text = 'You are here: ', $sep = ' / ', $home = ' ')
    {
        //Use RDFa breadcrumb, can also be used for microformats etc.
        $bc     =   '<div xmlns:v="http://rdf.data-vocabulary.org/#" id="crums">' . $text;
        //Get the website:
        $site   =   'http://' . $_SERVER['HTTP_HOST'];
        //Get all vars en skip the empty ones
        $crumbs =   array_filter(explode("/", $_SERVER["REQUEST_URI"]));
        //Create the home breadcrumb
        $bc    =   '<span typeof="v:Breadcrumb"><a href="' . $site . '" rel="v:url" property="v:title" style="color:black;">' . $home . '</a>' . $sep . '</span>';
        //Count all not empty breadcrumbs
        $nm     =   count($crumbs);
        $i      =   1;
        //Loop the crumbs
        foreach ($crumbs as $crumb) {
            //Make the link look nice
            $link    =  ucfirst(str_replace(array(".php", "-", "_", "?", "index"), array("", " ", " ", " ", "Anasayfa"), $crumb));
            //Loose the last seperator
            $sep     =  $i == $nm ? '' : $sep;
            //Add crumbs to the root
            $site   .=  '/' . $crumb;
            //Make the next crumb
            $bc     .=  '<span typeof="v:Breadcrumb"><a href="' . $site . '" rel="v:url" property="v:title" style="color:black;">' . $link . '</a>' . $sep . '</span>';
            $i++;
        }
        $bc .=  '</div>';
        //Return the result
        return $bc;
    }

    /*function breadcrumbs($text = 'You are here: ', $sep = ' > ', $home = '') {
                                //Use RDFa breadcrumb, can also be used for microformats etc.
                                $bc     =   '<div xmlns:v="http://rdf.data-vocabulary.org/#" id="crums">'.$text;
                                //Get the website:
                                $site   =   'http://'.$_SERVER['HTTP_HOST'];
                                //Get all vars en skip the empty ones
                                $crumbs =   array_filter( explode("/",$_SERVER["REQUEST_URI"]) );
                                //Create the home breadcrumb
                                $bc    =   '<span typeof="v:Breadcrumb"><a href="'.$site.'" rel="v:url" property="v:title">'.$home.'</a>'.$sep.'</span>'; 
                                //Count all not empty breadcrumbs
                                $nm     =   count($crumbs);
                                $i      =   1;
                                //Loop the crumbs
                                foreach($crumbs as $crumb){
                                    //Make the link look nice
                                    $link    =  ucfirst( str_replace( array(".php","-","_","?","index"), array(""," "," "," ","Anasayfa") ,$crumb) );
                                    //Loose the last seperator
                                    $sep     =  $i==$nm?'':$sep;
                                    //Add crumbs to the root
                                    $site   .=  '/'.$crumb;
                                    //Make the next crumb
                                    $bc     .=  '<span typeof="v:Breadcrumb"><a href="'.$site.'" rel="v:url" property="v:title">'.$link.'</a>'.$sep.'</span>';
                                    $i++;
                                }
                                $bc .=  '</div>';
                                //Return the result
                                return $bc;
                            }
                            
                            
                            echo breadcrumbs();*/


    /*public function dataDelete($table,$location)
    {
        ob_start();
        require_once("php/connection.php");

        $islem = $connection->prepare("DELETE FROM ' .$table. ' WHERE id= :id");
        $sil = $islem->execute(array(
            'id' => $_GET['id'],
        ));

        if ($sil) {
            header("location:'.$location.'.php");
        } else {
            echo "Kategori Silinemedi!";
        }

        ob_end_flush();
    }*/
}

$kontrol = new KontrolFonksiyonlar;

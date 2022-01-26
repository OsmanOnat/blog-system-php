<?php
$host = "localhost";
$database = "osmanblog_db";
$dbpassword = "";
$dbusername = "root";

try{
    $connection = new PDO("mysql:host=$host; dbname=$database",$dbusername,$dbpassword);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setattribute : Bir öznitelik tanımlar ;
    
    if($connection){
        echo '
            <script>
                console.log("Bağlantı Başarılı!");
            </script>
        ';
    }
    else{
        echo '
            <script>
                console.log("Bağlantı Hatası !");
            </script>
        ';
    }
}
catch(PDOException $e){ // PDOException : PDO tarafından oluşturulan bir hatayı temsil eder.
    echo "Bağlantı Hatası! Error: "+ $e->getMessage();
}



?>
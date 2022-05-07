<?php
    $host = "localhost"; //var untuk menyimpan nama host/server
    $user = "root"; //var untuk menyimpan username
    $password = ""; //var untuk menyimpan password

    $connect = mysqli_connect($host, $user, $password);

    if(!$connect){ 
        echo "Koneksi database ke host: <b>$host</b> 
        dengan username: <b>$user</b> <i>GAGAL</i>.";
    }
    
    $database = "classicmodels";
    $selectDb = mysqli_select_db($connect, $database);
    if(!$selectDb) { echo "Koneksi database TIDAK BERHASIL</i>."; }

    $id = $_GET["id"];

    mysqli_query($connect, "DELETE FROM customers WHERE customerNumber = $id");
    header("Location: save.php");


?>
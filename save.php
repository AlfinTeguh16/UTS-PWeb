<?php
    session_start();

    $host = "localhost"; //var untuk menyimpan nama host/server
    $user = "root"; //var untuk menyimpan username
    $password = ""; //var untuk menyimpan password

    //connect ke server MySQL
    $connect = mysqli_connect($host, $user, $password);

    //cek object connect apakah koneksi berhasil/gagal
    if(!$connect){ 
        echo "Koneksi database ke host: <b>$host</b> 
        dengan username: <b>$user</b> <i>GAGAL</i>.";
    }
    
    $database = "classicmodels";
    $selectDb = mysqli_select_db($connect, $database);
    //cek object selectDb apakah pemilihan DB berhasil/gagal
    if(!$selectDb) { echo "Koneksi database TIDAK BERHASIL</i>."; }

    if(isset($_POST['simpan'])){
    //menyimpan data dari post
    $_SESSION['customerNumber'] = $_POST['customerNumber'];
    $_SESSION['customerName'] = $_POST['customerName'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['postalCode'] = $_POST['postalCode'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['creditLimit'] = $_POST['creditLimit'];
    
    $sqlText = "INSERT INTO customers VALUES (" . 
    $_SESSION['customerNumber'] . ",'" . 
    $_SESSION['customerName'] . "','" . 
    $_SESSION['phone'] . "','" . 
    $_SESSION['postalCode'] . "','" . 
    $_SESSION['country'] . "'," . 
    $_SESSION['creditLimit'] . ");";
    //execute query
    $result = mysqli_query($connect, $sqlText);
    }
    
    $sqlText = "SELECT customerNumber, customerName, 
    phone, postalCode, country, creditLimit 
    FROM customers;";
    //execute query
    $result = mysqli_query($connect, $sqlText);
    //mencari jumlah baris yang dihasilkan perintah sql sebelumnya
    $row = mysqli_num_rows($result);
?>
<html>
    <head>
        <title>Prak5-1</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>No.</th>
                <th>customerNumber</th>
                <th>customerName</th>
                <th>phone</th>
                <th>postalCode</th>
                <th>country</th>
                <th>creditLimit</th>
                <th>Delete</th>
            </tr>
<?php
    for($i = 1;$i <= $row; $i++){
        //tarik data dari server database
        $data = mysqli_fetch_array($result);
        //print data        
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$data[customerNumber]</td>";
        echo "<td>$data[customerName]</td>";
        echo "<td>$data[phone]</td>";
        echo "<td>$data[postalCode]</td>";
        echo "<td>$data[country]</td>";
        echo "<td>$data[creditLimit]</td>";
        echo "<td><button type=\"button\" id=\"" . 
        $data['customerNumber'] . 
        "\" name=\"delete\" onclick=\"location.href='delete.php?id=" . $data['customerNumber'] . "'\">Hapus!</button></td>";
        echo "</tr>";
    }    
    //close connection
    mysqli_close($connect);
?>
        </table>
    </body>
</html>
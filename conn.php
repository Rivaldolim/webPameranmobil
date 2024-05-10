<?php
    $servername = 'localhost';
    $database = 'fumeo_showroom';
    $username = 'root';
    $password = '';


    // $conn = new mysqli($servername, $username, $password);
    $conn = mysqli_connect($servername, $username, $password, $database);
    // if($conn->connect_error){
    //     die("Connection failed" . $conn->connect_error);
    // }
    // echo "Connected successfully";
    if(!$conn){
        die("Connection failed : ".mysqli_connect_error());
    }else{
        echo "Connected";
    }
?>

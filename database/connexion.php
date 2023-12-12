<?php
 
 include __DIR__ .'/../vendor/autoload.php';

 $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
  $dotenv->load();

 //database configuration 
 $servername = $_ENV['DB_HOST'];
 $username = $_ENV['DB_USER'];
 $password = $_ENV['DB_PASSWORD'];
 $dbname = $_ENV['DB_NAME'];


 //create connexion

 $conn = mysqli_connect($servername, $username, $password, $dbname);


 //check connexion 

 if (!$conn) {
    die("connexion failed :".mysqli_connect_error());
 }else{
    echo"successfuly";
 }


?>
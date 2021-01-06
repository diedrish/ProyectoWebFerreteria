
<?php
$username="root";
$dbname="dizy";
$password="2520";
$servername="localhost:3000";
$connection =  mysqli_connect($servername,$username,$password,$dbname);
if(!$connection){
    die("Connection failed :".mysqli_connect_error());
}


?>
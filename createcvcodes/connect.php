<?php
$host="localhost";
$username="root";
$password="";
$db_name="quick_profile_builder";
$conn=mysqli_connect($host,$username,$password,$db_name);
if($conn->connect_error){
    echo "Failed to connect database".$conn->connect_error;
}
?>

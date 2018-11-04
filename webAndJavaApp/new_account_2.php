<?php
session_start();
?>


<?php

$conn = mysqli_connect("localhost","root","Cacatmaro97","reciclare_marean") or die("error");

if(!$conn)
{
    die("Connection failed:".mysqli_connect_error());
}

$newEmail = $_POST['newEmail'];
$newPwd = $_POST['newPwd'];
$newPwdConf = $_POST['newPwdConf'];

$crEmail=strtolower($newEmail);
$crPwd = md5($newPwd);
$bani = 0;
echo $newEmail;

if(strcmp($newPwd,$newPwdConf)==0)
{
    echo $newEmail;
    $sql = "INSERT INTO users(email,password,bani) VALUES('$crEmail','$crPwd',$bani)";
}
else
{
   // header("Location:new_account.php");
}




$result = mysqli_query($conn,$sql) or die("error2");


//$_SESSION["loggedUser"] = 1;

header("Location:Code.php");




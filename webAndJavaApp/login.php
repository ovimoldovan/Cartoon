<?php
session_start();


$conn = mysqli_connect("localhost","root","Cacatmaro97","reciclare_marean");

if(!$conn)
{
    die("Connection failed:".mysqli_connect_error());
}

$Email = $_POST['Email'];
$Pwd = $_POST['Pwd'];
echo $Email;


$crPwd = md5($Pwd);
$sql = "SELECT * FROM users WHERE email = '$Email' AND password='$crPwd'" ;



$result = mysqli_query($conn,$sql) or die("error2");

if($row = mysqli_fetch_array($result) !=0)
{
    $_SESSION["loggedUser"] = 1;
    $_SESSION['email'] = $Email;
    echo $Email;
    header("Location:Code.php");
}
else
{
    $_SESSION['loggedUser'] = 0;
    header("Location:index.php");
    var_dump($_SESSION);
}

   






?>
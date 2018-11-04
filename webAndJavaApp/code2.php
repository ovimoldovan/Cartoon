<?php
session_start();

if($_SESSION['loggedUser'] != 1)
{
    header('Locatation:index.php');
}
else
{
    $conn = mysqli_connect("localhost","root","Cacatmaro97","reciclare_marean");

if(!$conn)
{
    die("Connection failed:".mysqli_connect_error());
}
    
    $cod = $_GET['code'];
    
    $file = fopen("qr/fisierCod.txt", "r") or die("Unable to open file");
    fscanf($file, "%d", $codLuat);
    
    if($cod == $codLuat)
    {
        
         $email = $_SESSION["email"];
        //echo $email;
        $baniVechi = mysqli_fetch_array(mysqli_query($conn, "SELECT bani FROM users WHERE email = '$email'")) or die("fetch error");
       
        $baniVechi[0]+=5;
        $baniNoi = $baniVechi[0];
        mysqli_query($conn, "UPDATE users SET bani = '$baniNoi' where email = '$email'") or die("update error");
        
        echo 'Congrats on having ';
        echo $baniNoi / 10;
        echo 'RON';
         fclose($file);
        unlink("qr/fisierCod.txt");
        
        echo"<center><img src='money.jpg' /></center>";
        
    }
            
}


?>
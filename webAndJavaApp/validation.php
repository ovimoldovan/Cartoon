<?php
session_start();

if($_SESSION['loggedUser'] != 1) 
{
    echo "Please log in";
    echo "<meta http-uquiv='refresh' content='2;url=/index.php>";
}
else
{
    header('Location:code2.php');
}

?>






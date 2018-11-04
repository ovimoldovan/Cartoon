<?php
session_start();
if(!isset($_SESSION['email'])) header('Location: index.php');
else echo "Logged in as" + $_SESSION['email'];



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>CARTOON</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/css_style_new_account.css">
    <link rel="stylesheet" href="css/css_style_principal.css">

  </head>
      <body>
      
      <!-- the jumbotron -->
      
      <div id="cust-jumbotron" class="jumbotron">
         <div class="container">
          <h2 class="text-center">Cartoon&nbsp;<span class="glyphicon glyphicon-user" aria-hidden="true"></span></h2>
              <p class="text-center">
                 Register for recycling!
              </p>
              
        </div>
      </div>
      
      
      <!-- thumbnails -where all the magic happens -->
      
      
      <div class="resize" >
          
          <div class="row">
  <div class=" col-md-8">
    <div class="thumbnail">
      <!--<img src="..." alt="...">-->
      <div class="caption">
        <h2 class="alligning-text">Thank you for recycling!</h2>
        
        <!--starts the slist -->
        <form action="code2.php" method="GET">
        <ul   class="list-group">
          <li class="color-cust list-group-item">
              <div class="form-group" style="margin:-20px">
    <label class="alligning-text" for="exampleInputEmail1"><h3>Code</h3></label>
    <input class="form-control" id="exampleInputEmail1" placeholder="Code" name="code">
  </div>
          </li>

         
          <div style="text-align:center;">
          <button type="submit" class="btn btn-lg" >Submit</button>
            </div>
        </ul>
        </form>
     <!-- ends the list-->
     
      </div>
    </div>
  </div>
  
  
  <div class=" col-md-4">
  
    <div class="thumbnail">
      <h2>Why recycle?</h2>
        <ul id="rec-ul"class="list-group ">
  <li class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp;  Recycling conserves resources</li>
  <li class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp;  Recycling saves energy</li>
  <li class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp;  Recycling helps protect the environment</li>
  <li class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp;  Recycling reduces landfill</li>
 
</ul>
     
      
    </div>
  </div>
    
  
       
</div> 
      </div>
       
       <div class="jumbotron" align = "center">
    
  <p><a class="btn btn-primary btn-lg" href="logout.php" role="button">Log out</a></p>
</div>
        
      


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
      </body>
</html>
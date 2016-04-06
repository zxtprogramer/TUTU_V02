<?php 
require("../dbase/dbFunction.php");
session_start();
$ifLogin=0;
$userName=""; $userID="";
$nowPage='Album';

if(isset($_SESSION['UserID'])){
    $userName=$_SESSION['UserName'];
    $userID=$_SESSION['UserID'];
    $userEmail=$_SESSION['UserEmail'];
    $ifLogin=1;
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="../css/bootstrap-theme.min.css" rel='stylesheet' type='text/css' />
    <link href="../css/Nav.css" rel='stylesheet' type='text/css' />
    <link href="../css/Modal.css" rel='stylesheet' type='text/css' />
    <title></title>
  </head>

  <body>
  
  <?php 
    require("../Nav/Nav.php");
    require("../Modal/Modal.php");
  ?>

    <script type="text/javascript">
        self.location.href="/Pic/Pic.php?AlbumID=2";
    </script>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/Nav.js"></script>
  </body>
</html>

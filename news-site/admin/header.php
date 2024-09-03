<?php
session_start();
include "config.php";
if(!isset($_SESSION["username"])){
    header("Location: {$hostname}/admin/");
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="images/pic.png">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap');
            *{
                font-family: 'Roboto Slab', serif;
            }
        </style>
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin" style="background-color: rgba(255,210,4);">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        <a href="post.php"><img class="logo" src="images/pic-1.png"></a>
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md-3">
                        <span style="color:black; margin-left:-5%; font-size: 18px;font-weight: 600;text-transform: uppercase;display: inline-block;" ><?php echo "Hello ".$_SESSION["username"]?></span><br><a href="logout.php" class="admin-logout" style="color:black; margin-left:-5%;" >logout</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li>
                                <a href="post.php">Post</a>
                            </li>
                           <?php
                           if($_SESSION["user_role"]=='1'){
                               
                           ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                           <?php
                           
                           } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Bar -->

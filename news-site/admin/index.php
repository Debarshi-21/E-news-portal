<?php
session_start();
include "config.php";
if(isset($_SESSION["username"])){
    header("Location: {$hostname}/admin/post.php");
}
?>

<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap');
            *{
                font-family: 'Roboto Slab', serif;
            }
            body{
                background-color: white;
            }
            form{
                background-color: rgba(250,250,240);
                padding: 25px;
                box-shadow:0 1px 3px rgba(17, 16, 16, 0.63);
            }
        </style>
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <center><img class="logo" src="images/pic.png" style="width: 40%;">
                        <h3 class="heading"><b>Admin Login</b></h3></center>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php
                        if(isset($_POST['login'])){
                            include "config.php";
                            $username=mysqli_real_escape_string($conn,$_POST['username']);
                            $password= md5($_POST['password']);
                            $sql="SELECT user_id, username, role FROM user WHERE username='{$username}' AND password='{$password}'";
                            $result=mysqli_query($conn,$sql) or die("Query failed");
                            if(mysqli_num_rows($result)>0){
                                while($row= mysqli_fetch_assoc($result)){
                                    session_start();
                                    $_SESSION["username"]=$row['username'];
                                    $_SESSION["user_id"]=$row['user_id'];
                                    $_SESSION["user_role"]=$row['role'];
                                    
                                    header("Location: {$hostname}/admin/post.php");
                                }
                            }else{
                                echo "<div class='alert alert-danger'>USERNAME AND PASSWORD DOES NOT MATCH</div>";
                            }
                            
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

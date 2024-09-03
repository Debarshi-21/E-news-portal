<?php
include "config.php";
session_start();
include "config.php";
if($_SESSION["user_role"]=='0'){
    header("Location: {$hostname}/admin/post.php");
}
$userid=$_GET['id'];
$sql="DELETE FROM user WHERE user_id='{$userid}'";
if(mysqli_query($conn,$sql)){
    header("Location: {$hostname}/admin/users.php");
}
else{
    echo "<p>Can\'t delete user</p>";
}

mysqli_close($conn);
?>
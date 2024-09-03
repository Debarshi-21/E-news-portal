<?php
include "config.php";
if(isset($_FILES['fileToUpload'])){
    $error=array();
    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
    //explode--> for converting a string to an array
    //explode--> explode(separator,string,limit(optional))
    //end--> the last value
    //strtolower--> converting the last string to lower case
    $file_exp=explode('.',$file_name);
    $file_ext=end($file_exp);
    $extensions = array("jpeg","jpg","png");
    //in_array will search the extension was in the $extensions array or not
    if(in_array($file_ext,$extensions)=== false){
        $error[]="This extension file does not allowed! Choose jpg or png image";
    }
    
    if($file_size > 2097152){//file size less than 2MB
        $error[]="File size must be lower than 2 MB";
    }
    
    if(empty($error)==true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }
    else{
        print_r($error);
        die();
    }
}

session_start();
$title=mysqli_real_escape_string($conn, $_POST['post_title']);
$description=mysqli_real_escape_string($conn, $_POST['postdesc']);
$category=mysqli_real_escape_string($conn, $_POST['category']);
$date=date("d M, Y");
$author=$_SESSION['user_id'];

$sql= "INSERT INTO post(title,description,category,post_date,author,post_img)
VALUES('{$title}','{$description}',{$category},'{$date}',{$author},'{$file_name}');";
// for multi query we have to give one semi colon before
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";//. for concat

if(mysqli_multi_query($conn,$sql)){
    header("location: {$hostname}/admin/post.php");
}
else
{
    echo "<div>Query Failed</div>";
}
?>
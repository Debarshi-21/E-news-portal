<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name=$_POST['old-image'];
}else{
    $error=array();
    $file_name=$_FILES['new-image']['name'];
    $file_size=$_FILES['new-image']['size'];
    $file_tmp=$_FILES['new-image']['tmp_name'];
    $file_type=$_FILES['new-image']['type'];
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

$sql="UPDATE post SET title='{$_POST['post_title']}',description='{$_POST['postdesc']}',
      category={$_POST['category']},post_img='{$file_name}'
      WHERE post_id={$_POST['post_id']};";

if($_POST['old_category'] != $_POST['category']){
    $sql .= "UPDATE category SET post=post-1 WHERE category_id={$_POST['old_category']};";
    $sql .= "UPDATE category SET post=post+1 WHERE category_id={$_POST['category']};";
}



$result=mysqli_multi_query($conn,$sql);
if($result){
    header("location: {$hostname}/admin/post.php");
}else{
    echo "Query Failed";
}
?>
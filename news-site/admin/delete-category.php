<?php
include "config.php";
$cat_id=$_GET['dcid'];


$sql= "DELETE FROM category WHERE category_id={$cat_id};";

if(mysqli_query($conn,$sql)){
    header("location: {$hostname}/admin/category.php");
}
else{
    echo "Query Failed !";
}

?>
<?php include "header.php"; 

include "config.php";
if($_SESSION["user_role"]=='0'){
    session_start();
    header("Location: {$hostname}/admin/post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <?php
                  $cat_id=$_GET['ucid'];
                  $sql="SELECT * FROM category WHERE category_id={$cat_id}";
                  
                  $result=mysqli_query($conn,$sql) or die("Query failed");
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                      
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                          <input type="hidden" name="cat_name_old" value="">
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php  } }?>
                </div>
              </div>
            </div>
          </div>
<?php
if(isset($_POST['submit'])){
    $cat_id=$_GET['ucid'];
    $cat_name=$_POST['cat_name'];
    $sql1="UPDATE category SET category_name='{$cat_name}' WHERE category_id={$cat_id}";
    $result1=mysqli_query($conn,$sql1) or die("Query failed");
    if($result1){
        header("location: {$hostname}/admin/category.php");
    }
}
        ?>
<?php include "footer.php"; ?>
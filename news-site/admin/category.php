<?php include "header.php"; 

include "config.php";
if($_SESSION["user_role"]==0){
    session_start();
    header("Location: {$hostname}/admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                
                <?php
                  include "config.php";
                  $limit=3;
                  if(isset($_GET['page'])){
                      $page=$_GET['page'];
                  }else{
                      $page=1;
                  }
                  $offset=($page-1)*$limit;
                  
                  if($_SESSION["user_role"]=='1'){
                  
                  $sql="SELECT * FROM category
                  ORDER BY category.category_id DESC LIMIT {$offset},{$limit}";
                  }elseif($_SESSION["user_role"]=='0'){
                  $sql="SELECT * FROM category
                  WHERE post.author={$_SESSION['user_id']}
                  ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                  }
                  $serial=$offset+1;
                  $result=mysqli_query($conn,$sql) or die("Query failed");
                  if(mysqli_num_rows($result)>0){
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php
                            while($row=mysqli_fetch_assoc($result)){
                                
                            
                          ?>
                        <tr>
                            <td class='id'><?php echo $serial++; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['post']; ?></td>
                            <td class='edit'><a href='update-category.php?ucid=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?dcid=<?php echo $row['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                    }  
                    
                    $sql1="SELECT * FROM category";
                    $result1=mysqli_query($conn,$sql1) or die("Query failed");
                    if(mysqli_num_rows($result1)>0){
                        $total_records=mysqli_num_rows($result1);
                        
                        $total_page=ceil($total_records/$limit);
                        
                        echo "<ul class='pagination admin-pagination'>";
                        for($i=1;$i<=$total_page;$i++){
                            if($i==$page){
                                $active="active";
                            }else{
                                $active="";
                            }
                            echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                        }
                        echo "</ul>";
                    }
                  ?>
                  
                
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>

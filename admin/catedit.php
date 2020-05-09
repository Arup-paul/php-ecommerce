<?php 
  require_once 'inc/header.php';
  require_once 'inc/sidebar.php';
  require_once '../classes/category.php';
 ?>
 <?php
 if (!isset($_GET['catid']) || $_GET['catid'] == NULL ) {
 	echo "<script>window.location = 'catlist.php';</script>";
 }else{
 	$id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['catid'] );
 }
   $cat = new Category();
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catname = $_POST['catname'];
    $updatecat = $cat->catUpdate($catname,$id);
   }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category Update</h2>
               <div class="block copyblock">
               <?php
                  if (isset($updatecat)) {
                     echo $updatecat;
                  }
               ?> 
               <?php
                  $getcat = $cat->getCattById($id);
                  if ($getcat) {
                  	while ($result = $getcat->fetch_assoc()) {
             
               ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catname" value="<?php echo  $result['catname'];?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
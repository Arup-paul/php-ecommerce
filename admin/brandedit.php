<?php 
  require_once 'inc/header.php';
  require_once 'inc/sidebar.php';
  require_once '../classes/brand.php';
 ?>
 <?php
 if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL ) {
 	echo "<script>window.location = 'brandlist.php';</script>";
 }else{
 	$id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['brandid'] );
 }
   $brand = new Brand();
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $updatebrand = $brand->brandUpdate($brandName,$id);
   }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand Update</h2>
               <div class="block copyblock">
               <?php
                  if (isset($updatebrand)) {
                     echo $updatebrand;
                  }
               ?> 
               <?php
                  $getbrand = $brand->getbrandById($id);
                  if ($getbrand) {
                  	while ($result = $getbrand->fetch_assoc()) {
             
               ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo  $result['brandName'];?>" class="medium" />
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
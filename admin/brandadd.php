<?php 
  require_once 'inc/header.php';
  require_once 'inc/sidebar.php';
  require_once '../classes/Brand.php';
 ?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock">
               	 <?php
   $brand = new Brand();
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $insertBrand = $brand->brandInsert($brandName);
   }
?>
              
                 <form action="" method="POST">
                    <table class="form">				 <?php
                  if (isset($insertBrand)) {
                     echo $insertBrand;
                  }
               ?> 	
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
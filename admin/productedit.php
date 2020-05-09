<?php 
  require_once 'inc/header.php';
  require_once 'inc/sidebar.php';
  require_once '../classes/product.php';
  require_once '../classes/Brand.php';
  require_once '../classes/Category.php';
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product Update</h2>
        <div class="block"> 
             <?php
  if (!isset($_GET['proid']) || $_GET['proid'] == NULL ) {
 	echo "<script>window.location = 'productlist.php';</script>";
 }else{
 	$id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['proid'] );
 }


   $pd = new Product();
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $pd->productUpdate($_POST,$_FILES,$id);
   }
?>
        <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }

        ?>

        <?php

          $getPro = $pd->getProById($id);
          if ($getPro) {
          	while ($value = $getPro->fetch_assoc()){

        ?>              
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catid">
                            <option>Select Category</option>
                            <?php
                            $cat = new Category();
                            $getcat = $cat->getAllCat();
                            if ($getcat) {
                                while ( $result = $getcat->fetch_assoc()) {
                
                            ?>
                            <option 
                           <?php
                               if ($value['catid'] == $result['catid']) {  ?>
                               	selected = "selected" 
                               <?php } ?>   value="<?php echo $result['catid'];?>"><?php echo $result['catname'];?></option>
                        <?php } } ?>
                           
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandid">
                            <option>Select Brand</option>

                             <?php
                            $brand = new Brand();
                            $getbrand = $brand->getAllCat();
                            if ($getbrand) {
                                while ( $results = $getbrand->fetch_assoc()) {
                
                            ?>
                            <option 
                           <?php
                               if ($value['brandid'] == $results['brandid']) {  ?>
                               	selected = "selected" 
                               <?php } ?>   value="<?php echo $results['brandid'];?>"><?php echo $results['brandName'];?></option>
                        <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                        	<?php echo $value['body'];?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price($)</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                    	<img src="<?php echo $value['image'];?>" height="100" width="200" alt=""><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                             if ($value['type'] == 0) { ?>
                            <option selected="selected" value="0">Featured</option>
                            <option value="1">General</option>
                             <?php } else{ ?>
                            <option selected="selected" value="1">General</option>
                            <option value="0">Featured</option>
                        <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } }?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>



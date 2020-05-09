<?php
 
 require_once "inc/header.php";
 
?>
 <?php
 $login = Session::get("custlogin");
 if ($login == false) {
 	header("Location:login.php");
 }



?>
<?php
  if (isset($_GET['delwlistid'])) {
  	$productid = $_GET['delwlistid'];

  	$delWlist = $pd->delWlistData($cmrId, $productid);

  }
?>
<style>
	table.tblone img{
		height: 60px;
		width: 120px;
	}
</style>
 
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wish List</h2>
			    
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
				<?php
                  $getPd = $pd->getWlistData($cmrId);
                  if ($getPd) {
                  	$i=0;
                  	while ($result = $getPd->fetch_assoc()) {
                  	$i++;
                  
				?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $result['productName'];?></td>
						<td>$<?php echo $result['price'];?></td>
						<td><img src="admin/<?php echo $result['image'];?>" alt="" /></td>
						<td>
							<a href="details.php?proid=<?php echo $result['productid'];?>">Buy Now</a> ||
							<a href="?delwlistid=<?php echo $result['productid'];?>">Remove</a>
						</td>

					</tr>
						
						<?php } } ?>
							
							
							
						</table>
						
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%; text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>


   <?php
 
 require_once "inc/footer.php";
 
?>
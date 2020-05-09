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
    if (isset($_GET['customerId'])) {
  	$id      = $_GET['customerId'];
  	$time    = $_GET['time'];
  	$price   = $_GET['price'];
  	$confirm = $ct->productShiftConfirm($id,$time,$price);
  }

?>
<style>
	.notfound{}
	.notfound span{
		display: block;
		color: red;
		font-size: 170px;
	}
	.notfound h2{
		font-size:25px;
		line-height: 120px;
		text-align: center;
	}
	.tblone tr td{
		text-align: justify;
	}
</style>

 <div class="main">
    <div class="content">
    	
		<div class="section group">
			
			<div class="notfound">
				<h2>Your Ordered Details</h2>
                <table class="tblone">
							<tr>
								<th>NO</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						
							<?php
							$cmrId = Session::get("cmrId");
                              $getOrder = $ct->getOrderProduct($cmrId);
                              if ($getOrder) {
                              	$i=0;
                              	while ($result = $getOrder->fetch_assoc()) {
                              		$i++;
                              
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td><?php echo $result['quantity'];?></td>

								<td>$<?php echo $result['price'];?></td>
                                  <td><?php echo $fm->formatDate($result['date']);?></td>
                                  <td>
                                  	<?php
                                     if ($result['status'] == '0') {
                                     	echo "Pending";
                                     }elseif($result['status'] == '1'){ 
                                       echo "Shifted";
                                     }else{
                                     	echo "Ok";
                                     }

                                   ?>
                                   </td>
                                   <?php
                                      if ($result['status'] == '1') { ?>
                                      	<td><a href="?customerId=<?php echo $cmrId;?> &price=<?php echo $result['price'];?> &time=<?php echo $result['date'];?>">Confirm</a> </td>
                                      <?php } elseif($result['status'] == '2'){ ?>
                                       <td>Ok</td>
                                      <?php }elseif($result['status'] == '0') {?>
                                      	<td>N/A</td>
                                      <?php }?>	
								
							</tr>
							
						<?php } } ?>
							
							
							
						</table>
			</div>


		</div>		
    	 	
       <div class="clear"></div>
    </div>
</div>



   <?php
 
 require_once "inc/footer.php";
 
?>
<?php
 
 require_once "inc/header.php";
 
?>

 <?php
 $login = Session::get("custlogin");
 if ($login == false) {
 	header("Location:login.php");
 }



?>

<style>
	.tblone{
		width: 550px;
		margin:0 auto;
		border: 2px solid #ddd;
	}
	.tblone tr td{
		text-align: justify;
	}
</style>
      <?php
          $cmrId = Session::get("cmrId");
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $updateCustomer = $cmr->customerUpdate($_POST,$cmrId);
          }
        ?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
              $id = Session::get("cmrId" );
              $getdata = $cmr->getCustomerData($id); 
              if ($getdata) {
              	while ($result = $getdata->fetch_assoc() ) {
              	?>
             <form action="" method="post">
			<table class="tblone">
				
				<tr>
					<td colspan="2"><h2>Update Profile Details</h2></td>
				</tr>
				<tr>
					<td colspan="2">
							<?php
                   if (isset($updateCustomer)) {
                   	echo $updateCustomer;
                   }
				?>
					</td>
				</tr>
				<tr>
					<td width="20%">Name</td>
					<td><input type="text" name="name" value="<?php echo $result['name'];?>"></td></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="email" name="email" value="<?php echo $result['email'];?>"></td></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" value="<?php echo $result['address'];?>"></td></td>
				</tr>
				<tr>
					<td>City</td>
					<td><input type="text" name="city" value="<?php echo $result['city'];?>"></td></td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td><input type="text" name="zip" value="<?php echo $result['zip'];?>"></td></td>
				</tr>

				<tr>
					<td>Country</td>
					<td><input type="text" name="country" value="<?php echo $result['country'];?>"></td></td>
				</tr>

				<tr>
					
					<td></td>
					<td>
						<input type="submit" name="submit" value="Update"></td>
				</tr>


			</table>
		</form>
			<?php } }  ?>	
        </div>
    </div>
 </div>

	<?php
 
 require_once "inc/footer.php";
 
?>
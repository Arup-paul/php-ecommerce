<?php 
  require_once 'inc/header.php';
  require_once 'inc/sidebar.php';
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../classes/Customer.php');
?>
 <?php
 if (!isset($_GET['custId']) || $_GET['custId'] == NULL ) {
 	echo "<script>window.location = 'inbox.php';</script>";
 }else{
 	$id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['custId'] );
 }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   	echo "<script>window.location = 'inbox.php';</script>";
   }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock">
               <?php
                  if (isset($updatecat)) {
                     echo $updatecat;
                  }
               ?> 
               <?php
                  $cus = new Customer();
                  $getCust = $cus->getCustomerData($id);
                  if ($getCust) {
                  	while ($result = $getCust->fetch_assoc()) {
             
               ?>
                 <form action="" method="POST">
                    <table class="form">	

                        <tr>
                        	<td>Name</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo  $result['name'];?>" class="medium" />
                            </td>
                        </tr>

                            <tr>
                        	<td>City</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo  $result['city'];?>" class="medium" />
                            </td>
                        </tr>

                            <tr>
                        	<td>Zip</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo  $result['zip'];?>" class="medium" />
                            </td>
                        </tr>

                            <tr>
                        	<td>Email</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo  $result['email'];?>" class="medium" />
                            </td>
                        </tr>

                            <tr>
                        	<td>Address</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo  $result['address'];?>" class="medium" />
                            </td>
                        </tr>

                            <tr>
                        	<td>Country</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo  $result['country'];?>" class="medium" />
                            </td>
                        </tr>

                            <tr>
                        	<td>Mobile No</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo  $result['phone'];?>" class="medium" />
                            </td>
                        </tr>


						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
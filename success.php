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
	.psuccess{
		width:500px;min-height: 200px;text-align: center;border:1px solid #ddd;margin:0 auto;padding:50px;}
	.psuccess h2{
		border-bottom: 1px solid #ddd;margin-bottom: 20px;}
	.psuccess p{line-height: 25px;text-align: left;font-size: 18px; }	

</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="psuccess">
    			<h2>Success</h2>
    			<?php
                 $cmrId = Session::get("cmrId");
                 $amount = $ct->PayableAmount($cmrId);
                 if ($amount) {
                 	$sum =0;
                 	while ($result = $amount->fetch_assoc()) {
                 		$price = $result['price'];
                 		$sum = $sum+$price;
                 	}
                 }

    			?>
    			 <p style="color:red;">Total Payable amount(Including Vat): $
                 <?php
                   $discount = $sum * 0.05;
                   $total = $sum - $discount;
                   $vat = $total*0.1;
                   $gtotal  = $total + $vat;
                   echo $gtotal;
			     ?>

    			 </p>
                 <p>Payement Succesfull</p>
                 <p>Thanks For Purchase. Receive Your Order Succesfully. We will contact you ASAP with delivery details.Here is your order details..... <a href="orderdetails.php">Visit Here.........</a></p>
    		</div>
    	
        </div> 
    </div>
 </div>

	<?php
 
 require_once "inc/footer.php";
 
?>
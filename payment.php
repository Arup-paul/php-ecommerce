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
 $login = Session::get("custlogin");
 if ($login == false) {
 	header("Location:login.php");
 }

?>
<style>
	.payment{
		width:500px;min-height: 200px;text-align: center;border:1px solid #ddd;margin:0 auto;padding:50px;}
	.payment h2{
		border-bottom: 1px solid #ddd;margin-bottom: 80px;padding-bottom: 10px;font-size: 25px;}
	.payment a{
           background: #ff0000;color: #fff;font-size: 20px;padding: 5px 20px;border-radius: 3px;}
	.payment a:hover{background: green;}
	.back a{width:160px;margin:0 auto;padding: 5px;display: block;background: #555;border:1px solid #333;color: #fff;border-radius: 3px;text-align: center;font-size: 25px;}
	.back a:hover{
		background: green;
	}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="payment">
    			<h2>Chose Your Payment Option</h2>
    			<a href="payment_offline.php">Offline Payment</a>
    			<a href="payment_online.php">Online Payment</a>
    		</div>
    		<div class="back">
    			<a href="cart.php">Previous</a>
    		</div>
        </div> 
    </div>
 </div>

	<?php
 
 require_once "inc/footer.php";
 
?>
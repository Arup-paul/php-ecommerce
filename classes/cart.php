 <?php
 $filepath = realpath(dirname(__FILE__));
require_once ($filepath.'/../lib/Database.php');
require_once ($filepath.'/../helpers/Format.php'); 

?>

<?php

class Cart{
	
	private $db;
	private $fm;
	
	function __construct(){
	  $this->db = new Database();	 
	  $this->fm = new Format();	 
  }

  public function addToCart($quantity,$id){
      $quantity = $this->fm->validation($quantity);
      $quantity = mysqli_real_escape_string($this->db->link,$quantity);
      $productid = mysqli_real_escape_string($this->db->link,$id);
      $sid = session_id();


      $squery = "SELECT * FROM product WHERE productid='$productid'";
      $result = $this->db->select($squery)->fetch_assoc();

      $productName = $result['productName'];
      $price       = $result['price'];
      $image       = $result['image'];

      $chquery = "SELECT * FROM cart WHERE productid='$productid' AND sid = '$sid'";
      $getPro = $this->db->select($chquery);
      if ($getPro) {
      	$msg = "Product Already Added";
      	return $msg;
      }else{
      $query = "INSERT INTO cart(sid,productid,productName,price,quantity,image) VALUES('$sid','$productid','$productName','$price','$quantity','$image')";
    	$inserted_row = $this->db->insert($query);
    	if ($inserted_row) {
    		header("Location:cart.php"); 
    	}else{
          header("Location:404.php");
    	}
    }
}


    public function getCartProduct(){
    	$sid = session_id();
    	$query = "SELECT * FROM cart WHERE sid='$sid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCartQuantity($catid,$quantity){
        $catid 	  = mysqli_real_escape_string($this->db->link, $catid);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        
        $query = "UPDATE cart 
           SET
           quantity = '$quantity'
           WHERE catid= '$catid'
           ";
           $updated_row = $this->db->update($query);
           if ($updated_row) {
           	header("Location:cart.php");
    	}else{
          echo "<span class='error'>Quantity Not Updated!</span>";
    	}

    }

    public function delProductByCart($delid){
    	$delid = mysqli_real_escape_string($this->db->link, $delid);
    	 $query = "SELECT * FROM cart WHERE catid = '$delid'";
      $getData = $this->db->select($query);
      if ($getData) {
       while ($delImg = $getData->fetch_assoc()) {
          $dellink = $delImg['image'];
          unlink($dellink);
       }
      }

      $delquery = "DELETE FROM cart WHERE catid = '$delid'";
      $deldata = $this->db->delete($delquery);
    if ($deldata) {
      echo "<script>window.location = 'cart.php';</script>";
    }else{
      echo "<span class='error'>Product Not Remove!</span>";
    }
    }


    public function checkCartTable(){
    	$sid = session_id();
    	$query = "SELECT * FROM cart WHERE sid='$sid'";
    	$result = $this->db->select($query);
    	return $result;
    }


    public function delCustomerCart(){
      $sid = session_id();
      $query = "DELETE FROM cart WHERE sid= '$sid'";
      $this->db->delete($query);
    }

   public function orderProduct($cmrId){
      $sid = session_id();
      $query = "SELECT * FROM cart WHERE sid='$sid'";
      $getPro = $this->db->select($query);
      if ($getPro) {
        while ($result = $getPro->fetch_assoc()) {
         $productid = $result['productid'];
         $productName = $result['productName'];
         $quantity = $result['quantity'];
         $price = $result['price'] * $quantity;
         $image = $result['image'];

         $query = "INSERT INTO orders(cmrId,productid,productName,quantity,price,image) VALUES('$cmrId','$productid','$productName','$quantity','$price','$image')";
      $inserted_row = $this->db->insert($query);
      
        }
      }
   }  


   public function PayableAmount($cmrId){
      $query = "SELECT price FROM orders WHERE cmrId='$cmrId' AND date =now()";
      $result = $this->db->select($query);
      return $result;
   }

   public function getOrderProduct($cmrId){
     $query = "SELECT * FROM orders WHERE cmrId='$cmrId' order by date DESC";
      $result = $this->db->select($query);
      return $result;
   }

   public function checkOrder($cmrId){
      $query = "SELECT * FROM orders WHERE cmrId='$cmrId'";
      $result = $this->db->select($query);
      return $result;
   }

   public function getAllOrderProduct(){
     $query = "SELECT * FROM orders order by date DESC";
      $result = $this->db->select($query);
      return $result;
   }

   public function productShifted($id,$date,$price){
    $id    = mysqli_real_escape_string($this->db->link, $id);
    $date  = mysqli_real_escape_string($this->db->link, $date);
    $price = mysqli_real_escape_string($this->db->link, $price);
    $query = "UPDATE orders 
           SET
           status = '1'
           WHERE cmrId= '$id' AND date='$date' AND price='$price'
           ";
           $updated_row = $this->db->update($query);
           if ($updated_row) {
            echo "<span class='success'> Shifted Succesfully</span>";
      }else{
          echo "<span class='error'> Not Shifted!</span>";
      }
   }


   public function delProductShifted($id,$time,$price){
    $id    = mysqli_real_escape_string($this->db->link, $id);
    $date  = mysqli_real_escape_string($this->db->link, $time);
    $price = mysqli_real_escape_string($this->db->link, $price);

    $id = mysqli_real_escape_string($this->db->link,$id);
    $query = "DELETE FROM orders WHERE cmrId= '$id' AND date='$date' AND price='$price'
           ";
    $deldata = $this->db->delete($query);
    if ($deldata) {
      echo "<span class='success'>Deleted Succesfully</span>";
    }else{
      echo "<span class='error'> Not Deleted!</span>";
    }
   }

   public function productShiftConfirm($id,$time,$price){
     $id    = mysqli_real_escape_string($this->db->link, $id);
    $date  = mysqli_real_escape_string($this->db->link, $time);
    $price = mysqli_real_escape_string($this->db->link, $price);
    $query = "UPDATE orders 
           SET
           status = '2'
           WHERE cmrId= '$id' AND date='$date' AND price='$price'
           ";
           $updated_row = $this->db->update($query);
           if ($updated_row) {
            echo "<span class='success'> Confirmed Succesfully</span>";
      }else{
          echo "<span class='error'> Not Confirmed!</span>";
      }
   }

 



  }


  
      ?>
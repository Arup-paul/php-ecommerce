 <?php
 $filepath = realpath(dirname(__FILE__));
require_once ($filepath.'/../lib/Database.php');
require_once ($filepath.'/../helpers/Format.php'); 

?>

<?php

class Product{
	
	private $db;
	private $fm;
	
	function __construct(){
	  $this->db = new Database();	 
	  $this->fm = new Format();	 
  }

  public function productInsert($data,$file){
    $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
    $catid 		 = mysqli_real_escape_string($this->db->link,$data['catid']);
    $brandid 	 = mysqli_real_escape_string($this->db->link,$data['brandid']);
    $body 		 = mysqli_real_escape_string($this->db->link,$data['body']);
    $price 		 = mysqli_real_escape_string($this->db->link,$data['price']); 
    $type 		 = mysqli_real_escape_string($this->db->link,$data['type']);

    $permited  = array('jpg', 'jpeg', 'png' );
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    if ($productName == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $type == "" || $file_name == "" || $type == ""  ) {
    	echo "<span class='error'>Field Must not be empty!</span>";
    }elseif ($file_size >1048567) {
       echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
       echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    }else{
    	move_uploaded_file($file_temp, $uploaded_image);
    	$query = "INSERT INTO product (productName,catid,brandid,body,price,image,type) VALUES('$productName','$catid','$brandid','$body','$price','$uploaded_image','$type')";
    	$inserted_row = $this->db->insert($query);
    	if ($inserted_row) {
    		echo "<span class='success'>Product  Insert Succesfully</span>";
    	}else{
          echo "<span class='error'>Product  Not Inserted!</span>";
    	}
    }
  }
  

   public function getAllProduct(){
    $query = "SELECT p.*,c.catname,b.brandName
              FROM product as p, category as c, brand as b WHERE p.catid = c.catid AND p.brandid = b.brandid
              ORDER BY p.productid DESC";

        $result = $this->db->select($query);
        return $result;
   }

   public function getProById($id){
      $query = "SELECT * FROM product WHERE productid = '$id'";
      $result = $this->db->select($query);
      return $result;
      

   }

   public function productUpdate($data,$file,$id){
    $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
    $catid       = mysqli_real_escape_string($this->db->link,$data['catid']);
    $brandid     = mysqli_real_escape_string($this->db->link,$data['brandid']);
    $body        = mysqli_real_escape_string($this->db->link,$data['body']);
    $price       = mysqli_real_escape_string($this->db->link,$data['price']); 
    $type        = mysqli_real_escape_string($this->db->link,$data['type']);

    $permited  = array('jpg', 'jpeg', 'png' );
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    if ($productName == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $type == ""  || $type == ""  ) {
      echo "<span class='error'>Field Must not be empty!</span>";
    } else{
       if (!empty($file_name)) {
      
       if ($file_size >1048567) {
           echo "<span class='error'>Image Size should be less then 1MB!
         </span>";
        } elseif (in_array($file_ext, $permited) === false) {
           echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        }else{
          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE  product
                    SET
                    productName = '$productName',
                    catid       = '$catid',
                    brandid     = '$brandid',
                    body        = '$body',
                    price       = '$price',
                    image       = '$uploaded_image',
                    type        = '$type'
           WHERE productid = '$id'";
          $updated_row = $this->db->insert($query);
          if ($updated_row) {
            echo "<span class='success'>Product  Updated Succesfully </span>";
          }else{
              echo "<span class='error'>Product  Not Updated!</span>";
          }
    }
  }
    else {
           $query = "UPDATE  product
                    SET
                    productName = '$productName',
                    catid       = '$catid',
                    brandid     = '$brandid',
                    body        = '$body',
                    price       = '$price',
                    type        = '$type'
           WHERE productid = '$id'";
          $updated_row = $this->db->insert($query);
          if ($updated_row) {
            echo "<span class='success'>Product  Updated Succesfully Without Image</span>";
          }else{
              echo "<span class='error'>Product  Not Updated!</span>";
          }

       }
     }
   }

   public function delproById($id){
      $query = "SELECT * FROM product WHERE productid = '$id'";
      $getData = $this->db->select($query);
      if ($getData) {
       while ($delImg = $getData->fetch_assoc()) {
          $dellink = $delImg['image'];
          unlink($dellink);
       }
      }

      $delquery = "DELETE FROM product WHERE productid = '$id'";
      $deldata = $this->db->delete($delquery);
    if ($deldata) {
      echo "<span class='success'>Product Deleted Succesfully</span>";
    }else{
      echo "<span class='error'>Product Not Deleted!</span>";
    }

   }

 public function getFeaturedProduct(){
    $query = "SELECT * FROM product WHERE type = '0' ORDER BY productid DESC limit 4";
      $result = $this->db->select($query);
      return $result;
 }

 public function getNewProduct(){
    $query = "SELECT * FROM product ORDER BY productid DESC limit 4";
      $result = $this->db->select($query);
      return $result;
 }


 public function getSingleProduct($id){
    $query = "SELECT p.*,c.catname,b.brandName
              FROM product as p, category as c, brand as b WHERE p.catid = c.catid AND p.brandid = b.brandid AND p.productid = '$id'";
               $result = $this->db->select($query);
               return $result;

 }

  public function latestFromIphone(){
   $query = "SELECT * FROM product WHERE brandid='5'   ORDER BY productid DESC limit 1";
      $result = $this->db->select($query);
      return $result;

  }
 

 public function latestFromSamsung(){
   $query = "SELECT * FROM product WHERE brandid='1'   ORDER BY productid DESC limit 1";
      $result = $this->db->select($query);
      return $result;

  }

  public function latestFromCanon(){
   $query = "SELECT * FROM product WHERE brandid='3'   ORDER BY productid DESC limit 1";
      $result = $this->db->select($query);
      return $result;

  }

  public function latestFromAcer(){
   $query = "SELECT * FROM product WHERE brandid='2'   ORDER BY productid DESC limit 1";
      $result = $this->db->select($query);
      return $result;

  }
  
  public function insertCompareData($cmprid,$cmrId){
    $cmrId    = mysqli_real_escape_string($this->db->link,$cmrId);
    $productid   = mysqli_real_escape_string($this->db->link,$cmprid);
    
    $cquery = "SELECT * FROM compare WHERE cmrId='$cmrId' AND productid = '$productid'";
    $check = $this->db->select($cquery);
    if ($check) {
     $msg =  "<span class='success'>Already Added</span>";
     return $msg;
    }
      $query = "SELECT * FROM product WHERE productid='$productid'";
      $result = $this->db->select($query)->fetch_assoc();
      if ($result) {
         $productid = $result['productid'];
         $productName = $result['productName'];
         $price = $result['price'];
         $image = $result['image'];

         $query = "INSERT INTO compare(cmrId,productid,productName,price,image) VALUES('$cmrId','$productid','$productName','$price','$image')";
          $inserted_row = $this->db->insert($query);

          if ($inserted_row) {
             $msg =  "<span class='success'>Added ! Check  Compare Page</span>";
             return $msg;
          }else{
              $msg =  "<span class='error'>Not Added</span>";
             return $msg;

          }
          }
      
        }

     public function getCompareData($cmrId){
      $query = "SELECT * FROM compare WHERE cmrid = '$cmrId' ORDER BY id DESC";
      $result = $this->db->select($query);
      return $result;
     }   
     

     public function delCompareData($cmrId){
      $query = "DELETE FROM compare WHERE cmrid = '$cmrId'";
      $deldata = $this->db->delete($query);
     }


     public function saveWishListData($id, $cmrId){
     $id    = mysqli_real_escape_string($this->db->link,$id);
    $cmrId   = mysqli_real_escape_string($this->db->link,$cmrId);

    $cquery = "SELECT * FROM wishlist WHERE cmrId='$cmrId' AND productid = '$id'";
    $check = $this->db->select($cquery);
    if ($check) {
     $msg =  "<span class='success'>Already Added</span>";
     return $msg;
    }
         $pquery = "SELECT * FROM product WHERE productid='$id'";
      $result = $this->db->select($pquery)->fetch_assoc();
      if ($result) {
         $productid = $result['productid'];
         $productName = $result['productName'];
         $price = $result['price'];
         $image = $result['image'];

         $query = "INSERT INTO wishlist(cmrId,productid,productName,price,image) VALUES('$cmrId','$productid','$productName','$price','$image')";
      $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
             $msg =  "<span class='success'>Added ! Check  Wish list Page </span>";
             return $msg;
          }else{
              $msg =  "<span class='error'>Not Added</span>";
             return $msg;

          }
      
        }
      }
  public function getWlistData($cmrId){
    $query = "SELECT * FROM wishlist WHERE cmrid = '$cmrId' ORDER BY id DESC";
      $result = $this->db->select($query);
      return $result;
  }

  public function delWlistData($cmrId, $productid){
    $query = "DELETE FROM wishlist WHERE cmrid = '$cmrId' AND productid='$productid'";
    $deldata = $this->db->delete($query);
  }
  



}











  ?>
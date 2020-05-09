 <?php
 $filepath = realpath(dirname(__FILE__));
require_once ($filepath.'/../lib/Database.php');
require_once ($filepath.'/../helpers/Format.php'); 

?>

<?php

class Brand{
	
	private $db;
	private $fm;
	
	function __construct(){
	  $this->db = new Database();	 
	  $this->fm = new Format();	 
  }
  public function brandInsert($brandName){
   	$brandName = $this->fm->validation($brandName);
    $brandName = mysqli_real_escape_string($this->db->link,$brandName);
    if (empty($brandName)){
    	$msg = "<span class='error'>Brand Field Must Not Be Empty!</span>";
    	return $msg;
    }else{
    	$query = "INSERT INTO brand (brandName) VALUES('$brandName')";
    	$brandInsert = $this->db->insert($query);
    	if ($brandInsert) {
    		echo "<span class='success'>Brand Name Insert Succesfully</span>";
    	}else{
          echo "<span class='error'>Brand Name Not Inserted!</span>";
    	}
    }
   }



   public function getAllCat(){
      $query = "SELECT * FROM Brand ORDER BY brandid DESC";
      $result = $this->db->select($query);
      return $result;

   }

   public function getbrandById($id){
   	$query = "SELECT * FROM Brand WHERE brandid = '$id'";
      $result = $this->db->select($query);
      return $result;

   }

   public function brandUpdate($brandName,$id){
    $brandName = $this->fm->validation($brandName);
    $brandName = mysqli_real_escape_string($this->db->link,$brandName);
    $id = mysqli_real_escape_string($this->db->link,$id);
    if (empty($brandName)){
    	$msg = "<span class='error'>Category Field Must Not Be Empty!</span>";
    	return $msg;
    }else{
    	$query = "UPDATE Brand 
           SET
           brandName = '$brandName'
           WHERE brandid= '$id'
           ";
           $updated_row = $this->db->update($query);
           if ($updated_row) {
           	echo "<span class='success'>Category Update Succesfully</span>";
    	}else{
          echo "<span class='error'>Category Not Updated!</span>";
    	}
    }

}
   

   public function delCatById($id){
   	$id = mysqli_real_escape_string($this->db->link,$id);
   	$query = "DELETE FROM Brand WHERE brandid='$id'";
   	$deldata = $this->db->delete($query);
   	if ($deldata) {
   		echo "<span class='success'>Category Deleted Succesfully</span>";
   	}else{
   		echo "<span class='error'>Category Not Deleted!</span>";
   	}
   }

}


?>
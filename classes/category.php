 <?php
 $filepath = realpath(dirname(__FILE__));
require_once ($filepath.'/../lib/Database.php');
require_once ($filepath.'/../helpers/Format.php'); 

?>



<?php

class Category{
	
	private $db;
	private $fm;
	
	function __construct(){
	  $this->db = new Database();	 
	  $this->fm = new Format();	 
  }
   


   public function catInsert($catname){
   	$catname = $this->fm->validation($catname);
    $catname = mysqli_real_escape_string($this->db->link,$catname);
    if (empty($catname)){
    	$msg = "<span class='error'>Category Field Must Not Be Empty!</span>";
    	return $msg;
    }else{
    	$query = "INSERT INTO category (catname) VALUES('$catname')";
    	$catInsert = $this->db->insert($query);
    	if ($catInsert) {
    		echo "<span class='success'>Category Insert Succesfully</span>";
    	}else{
          echo "<span class='error'>Category Not Inserted!</span>";
    	}
    }
   }


   public function getAllCat(){
      $query = "SELECT * FROM category ORDER BY catid DESC";
      $result = $this->db->select($query);
      return $result;

   }

   public function getCattById($id){
   	$query = "SELECT * FROM category WHERE catid = '$id'";
      $result = $this->db->select($query);
      return $result;

   }

   public function catUpdate($catname,$id){
    $catname = $this->fm->validation($catname);
    $catname = mysqli_real_escape_string($this->db->link,$catname);
    $id = mysqli_real_escape_string($this->db->link,$id);
    if (empty($catname)){
    	$msg = "<span class='error'>Category Field Must Not Be Empty!</span>";
    	return $msg;
    }else{
    	$query = "UPDATE category 
           SET
           catname = '$catname'
           WHERE catid= '$id'
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
   	$query = "DELETE FROM category WHERE catid='$id'";
   	$deldata = $this->db->delete($query);
   	if ($deldata) {
   		echo "<span class='success'>Category Deleted Succesfully</span>";
   	}else{
   		echo "<span class='error'>Category Not Deleted!</span>";
   	}
   }




}



?>
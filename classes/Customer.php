 <?php
 $filepath = realpath(dirname(__FILE__));
require_once ($filepath.'/../lib/Database.php');
require_once ($filepath.'/../helpers/Format.php'); 

?>

<?php

class Customer{
	
	private $db;
	private $fm;
	
	function __construct(){
	  $this->db = new Database();	 
	  $this->fm = new Format();	 
  }

public function customerRegistration($data){
	$name      = mysqli_real_escape_string($this->db->link, $data['name']);
	$city 	   = mysqli_real_escape_string($this->db->link, $data['city']);
	$zip 	   = mysqli_real_escape_string($this->db->link, $data['zip']);
	$email     = mysqli_real_escape_string($this->db->link, $data['email']);
	$address   = mysqli_real_escape_string($this->db->link, $data['address']);
	$country   = mysqli_real_escape_string($this->db->link, $data['country']);
	$phone     = mysqli_real_escape_string($this->db->link, $data['phone']);
	$password  = mysqli_real_escape_string($this->db->link, md5($data['password']));

    if ($name == "" ||  $city == "" ||  $zip == "" || $email == "" ||  $address == "" ||  $country == "" ||  $phone == "" ||  $password == "" ) {
    	$msg = "<span class='error'>Field Must Not Be Empty</span>";
    	return $msg;
    }
    $mailquery = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
    $mailcheck = $this->db->select($mailquery);
    if ($mailcheck != false) {
    	$msg = "<span class='error'>Email Already Taken</span>";
    	return $msg;
    }else{
    	$query = "INSERT INTO customer(name,city,zip,email,address,country,phone,password) VALUES('$name','$city','$zip','$email','$address','$country','$phone','$password')";

    	$inserted_row = $this->db->insert($query);
    	if ($inserted_row ) {
    	 	$msg = "<span class='success'>Customer Data Inserted Successfully</span>";
    	    return $msg;
    	 } else{
    	 	$msg = "<span class='error'>Customer Data Not Inserted </span>";
    	return $msg;
    	 }
    }

}



public function customerLogin($data){
	$email     = mysqli_real_escape_string($this->db->link, $data['email']);
	$password  = mysqli_real_escape_string($this->db->link, md5($data['password']));

	if (empty($email) || empty($password)) {
		$msg = "<span class='error'>Field Must Not Be Empty</span>";
    	    return $msg;
	}

	$query = "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";
	$result = $this->db->select($query);
	if ($result !=false) {
		$value = $result->fetch_assoc();
		Session::set("custlogin",true);
		Session::set("cmrId",$value['id']);
		Session::set("cmrName",$value['cmrName']);
		header("Location:cart.php");
	}else{
		$msg = "<span class='error'>Email Or Password Not Matched</span>";
    	    return $msg;
	}
}

public function getCustomerData($id){
    	$query = "SELECT * FROM customer WHERE id='$id'";
    	$result = $this->db->select($query);
    	return $result;
}

public function customerUpdate($data,$cmrId){
	$name      = mysqli_real_escape_string($this->db->link, $data['name']);
	$city 	   = mysqli_real_escape_string($this->db->link, $data['city']);
	$zip 	   = mysqli_real_escape_string($this->db->link, $data['zip']);
	$email     = mysqli_real_escape_string($this->db->link, $data['email']);
	$address   = mysqli_real_escape_string($this->db->link, $data['address']);
	$country   = mysqli_real_escape_string($this->db->link, $data['country']);
	$phone     = mysqli_real_escape_string($this->db->link, $data['phone']);

    if ($name == "" ||  $city == "" ||  $zip == "" || $email == "" ||  $address == "" ||  $country == "" ||  $phone == "" ) {
    	$msg = "<span class='error'>Field Must Not Be Empty</span>";
    	return $msg;
           }else{
                  $query = "UPDATE  customer
                    SET
                    name     = '$name',
                    city     = '$city',
                    zip      = '$zip',
                    email    = '$email',
                    address  = '$address',
                    country  = '$country',
                    phone    = '$phone'
           WHERE id = '$cmrId'";
          $updated_row = $this->db->insert($query);
          if ($updated_row) {
            echo "<span class='success'>Customer Data  Updated Succesfully </span>";
          }else{
              echo "<span class='error'>Customer Data  Not Updated!</span>";
          }
    }

}

    











}

  ?>
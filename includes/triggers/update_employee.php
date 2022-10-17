<?php

	session_start();
	error_reporting(0);
	include('../config.php');
	if(strlen($_SESSION['userlogin'])==0){
		header('location:../../login.php');
	}
 
global $connect;
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName']; 
    $Phone=$_POST['Phone'];  
    $Birthday=$_POST['Birthday']; 
    $Address=$_POST['Address']; 
    $Gender=$_POST['Gender']; 
    
    // checking empty fields
    if(empty($FirstName)) {            
        if(empty($FirstName)) {
            echo "<font color='red'>First Name field is empty.</font><br/>";
        }      
    } else {    
        //updating the table
        $result = mysqli_query($connect, "UPDATE employees SET 
        FirstName='$FirstName',
        LastName='$LastName',
        Phone='$Phone',
        Birthday='$Birthday',
        Address='$Address',
        Gender='$Gender'
        WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: ../../profile_emp.php?e_id='$id'");
    }
}
?>
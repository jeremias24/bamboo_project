<?php
// including the database connection file
include_once('../config.php');
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName'];  
	$UserName = $_POST['UserName'];
	$Password = $_POST['Password'];
	$Email = $_POST['Email'];
	$Address = $_POST['Address'];
	$Phone = $_POST['Phone'];
	$Joining_Date = $_POST['Joining_Date'];
	$Department = $_POST['Department'];
	$Designation = $_POST['Designation'];
    
    // checking empty fields

    if(empty($FirstName) || empty($LastName)) {            
        if(empty($FirstName)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($LastName)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
              
    } else {    
        //updating the table
        $result = mysqli_query($connect, "UPDATE employees SET 
            FirstName='$FirstName',
            LastName='$LastName',
            UserName='$UserName',
            Password='$Password',
            Email='$Email',
            Address='$Address',
            Phone='$Phone',
            Joining_Date='$Joining_Date',
            Department='$Department',
            Designation='$Designation'
            
            WHERE id='$id'");
        //redirectig to the display page. In our case, it is index.php
        header("Location: ../../employees.php");
    }
}
?>
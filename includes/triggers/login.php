<?php
include "../config.php";
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=email_empty");
		exit();
	} else if (empty($pass)) {
		header("Location: index.php?error=email_pass");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE Email='$uname' AND Password='$pass'";

		$result = mysqli_query($connect, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);



			if ($row['Email'] === $uname && $row['Password'] === $pass) {
				$_SESSION['UserType'] = $row['UserType'];
				$_SESSION['UserName'] = $row['UserName'];
				$_SESSION['Picture'] = $row['Picture'];
				$_SESSION['id'] = $row['id'];
				header("Location: ../../home.php");
				exit();
			} else {
				header("Location: login.php?error=both_wrong");
				exit();
			}
		} else {


			header("Location: index.php?error=both_wrong");
			exit();
		}
	}
} else {
	header("Location: index.php");
	exit();
}

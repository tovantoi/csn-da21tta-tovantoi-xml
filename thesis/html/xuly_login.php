<?php
session_start();

$uname = $pass = "";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
		exit();
	} else if (empty($pass)) {
		header("Location: index.php?error=Password is required");
		exit();
	} else {
		$xml = simplexml_load_file("users.xml") or die("Error: Không thể load file xml");

		$found = false;
		foreach ($xml->user as $user) {
			$n = strval($user->username);
			$p = strval($user->password);

			if ($n === $uname && $p === $pass) {
				$selectedStudentMSSV = strval($user->mssv);
				$_SESSION["name"] = $n;
				$_SESSION["role"] = strval($user->role);
				$_SESSION["mssv"] = strval($user->mssv);
				if ($_SESSION["role"] === "1") {
					header("Location: nguoidung.php");
				} else if ($_SESSION["role"] === "2") {
					header("Location: quantri.php");
				}
				$found = true;
				break;
			}
		}

		if (!$found) {
			header("Location: index.php?error=Incorrect User name or password");
			exit();
		}
	}
} else {
	header("Location: index.php");
	exit();
}

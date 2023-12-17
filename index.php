<!DOCTYPE html>
<html>

<head>
	<title>Đăng nhập</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<form action="xuly_login.php" method="post">
		<h2>ĐĂNG NHẬP HỆ THỐNG</h2>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<label>Tên đăng nhập: </label>
		<input type="text" name="uname" placeholder="Nhập tên đăng nhập"><br>

		<label>Mật khẩu: </label>
		<input type="password" name="password" placeholder="Nhập mật khẩu"><br>

		<button type="submit">Đăng nhập</button>
		<!--<a href="signup.php" class="ca">Create an account</a>-->
	</form>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Login</title>
</head>
<body>

    <?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>

    <div class="login">
    <form action="../cek_login.php" method="post">
        <span>Nama Pengguna:</span>
        <input type="text" name="username" id="">
        <span>Password:</span>
        <input type="text" name="password">

        <!-- <input type="submit" value="Login"> -->
        <input type="submit" value="Login">
    </form>
    </div>
</body>
</html>
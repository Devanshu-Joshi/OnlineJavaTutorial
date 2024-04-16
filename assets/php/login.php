<?php
if (isset($_POST["txteid"]) && isset($_POST["txtpwd"]) && isset($_POST['submit'])) {
	$hash_Email = md5($_POST["txteid"]);
	$encrypted_Base_Password = base64_encode(md5($_POST["txtpwd"],true));
	try
    {
        $con = mysqli_connect("localhost", "root", "", "javamembers");
    }
    catch(Exception $e)
    {
        echo '<script>alert("Sorry for The Inconvience\nBut Unexpectedly Our Servers are Down\nPlease Try Again Later...!!");</script>';
        die("<b><i>Connection failed Because " . mysqli_connect_error() . "</b></i><br/>Exception Occured Beacuse " . $e->getMessage());
    }
	$selectstatement = mysqli_prepare($con, "select * from tblmembers where eid=? and pwd=?");
	mysqli_stmt_bind_param($selectstatement, "ss", $hash_Email, $encrypted_Base_Password);
	mysqli_stmt_execute($selectstatement);
	$result = mysqli_stmt_get_result($selectstatement);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		
		$uid = $row['uid'];
		
		$raw_Password = md5($_POST["txtpwd"], true);
		$base_Password = base64_encode($raw_Password);
		$privateKey = $base_Password;
		$data = $_POST['txteid'];
		
		$cipher = 'aes-256-cbc';

		$iv = openssl_random_pseudo_bytes(16);

		$encrypted_Email = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
		// Data -> Email , Private-Key -> Base Password , IV -> Random ( Cookie )

		// IV Started

		$data = $iv;
		$iv = $raw_Password;
		
		$encrypted_IV = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
		// Data -> Random IV ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Password

		// IV Ended
		
		// UID Started
		
		$data = $uid;

		$encrypted_UID = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
		// Data -> UID , Private-Key -> Base Password , IV -> Raw Password
		
		// UID Ended
		

		if(isset($_POST['check']))
		{
			setcookie("enc0",$encrypted_UID, time() + (86400 * 30), "/", "" , true); // 86400 = 1 day
			setcookie("enc1",$encrypted_Email, time() + (86400 * 30), "/", "" , true); // 86400 = 1 day
			setcookie("enc2",$encrypted_IV, time() + (86400 * 30), "/", "" , true); // 86400 = 1 day
			setcookie("enc3", $privateKey, time() + (86400 * 30), "/", "" , true); // 86400 = 1 day
		}
		else
		{
			setcookie("enc0",$encrypted_UID, 0 , "/", "" , true);
			setcookie("enc1",$encrypted_Email, 0 , "/", "" , true);
			setcookie("enc2",$encrypted_IV, 0 , "/", "" , true);
			setcookie("enc3", $privateKey, 0 , "/", "" , true);
		}

		mysqli_close($con);
		echo '<script>alert("Login Succesfully");window.location.href="../../";</script>';
		// header('Location: index.php');
	} else {
		echo '<script>alert("Wrong Email-id or Password");</script>';
		$unm1 = "";
		$pwd1 = "";
	}
}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
	<link href="../css/login.css" rel="stylesheet" />
	<link rel="stylesheet" href="../css/navigation.css">
	<link rel="stylesheet" href="../css/utils.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
	<script src="../js/login.js"></script>
	<!-- Navigation Bar -->
    <div class="responsive">
        <a class="logo" href="../../">Java Tutorial</a>
        <nav class="nav">
            <table class="Table">
                <tr>
                    <ul>
                        <li class="navigation"><a href="../../">Home</a></li>
						<li class="navigation"><a href="01_History.php">Chapters</a></li>
                        <li class="navigation"><a href="Quiz.php">Quiz</a></li>
                        <li class="navigation"><a href="">About-Us</a></li>
                    </ul>
                </tr>
            </table>
            <!-- Dialog/Sidebar -->
            <div data-open-modal class="sidebar">
                <div class="menuToggle"></div>
            </div>
            <dialog data-modal>
                <div class="modalContainer">
                    <a class="modalContainer__links" href="../../">Home</a>
					<a class="modalContainer__links" href="01_History.php">Chapters</a>
                    <a class="modalContainer__links" href="Quiz.php">Quiz</a>
                    <a class="modalContainer__links" href="">About-Us</a>
                </div>
            </dialog>
        </nav>
	<div class="logContainer">
		<div class="login-card">
			<h2>Login</h2>
			<h3>Enter Your Information</h3>

			<form name="myform" onsubmit="return validate()" class="login-form" method="post">
				<input type="text" name="txteid" placeholder="Email-id" required>
				<input type="password" name="txtpwd" placeholder="Password" required>
				<a href="forget.php">Forget your password ?</a>
				<div class="check">
				Stay Signed-in :<input type="checkbox" name="check" id="check">
				</div>
				<button type="submit" name="submit">LOGIN</button>
			</form>
			<footer>
				New user ? Sign-up
				<a href="SignUp.php">Here</a>
			</footer>
		</div>
	</div>
</body>
<script src="../js/dialog.js"></script>

</html>
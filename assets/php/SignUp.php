<?php
if (isset($_COOKIE['sec']) && array_key_exists('sec', $_COOKIE) && isset($_POST['submit'])) {

    // OTP Started

    $data = $_COOKIE['sec'];
    $cipher = 'aes-256-cbc';
    $privateKey = $_COOKIE['sec2'];
    $iv = $_COOKIE['sec3'];
    $decrypted_Data = openssl_decrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> EncryptedData , Private-Key -> Hash Password , IV -> Raw Password

    // OTP Ended

    if ($_POST['otp'] == $decrypted_Data) {
        echo '<script>alert("Registered Succesfully");window.location.href="Register.php";</script>';
    } else {
        echo '<script>alert("Invalid OTP");</script>';
    }
} else if (isset($_POST['submit'])) {
    echo '<script>alert("Please Re-Verify Your Email");</script>';
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navigation.css">
    <link href="../css/SignUp.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/utils.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Sign-Up</title>
</head>

<body>
    <script src="../js/script.js"></script>
    <!-- Navigation Bar -->
    <div class="responsive">
        <a class="logo" href="../../">Java Tutorial</a>
        <nav class="nav">
            <table class="Table">
                <tr>
                    <ul>
                        <li class="navigation"><a href="../../">Home</a></li>
                        <li class="navigation"><a href="../php/01_History.php">Chapters</a></li>
                        <li class="navigation"><a href="../php/Quiz.php">Quiz</a></li>
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
        <div class="signContainer">
            <div class="card">
                <div class="logoSign">
                    <i class='bx bxl-java'></i>
                </div>
                <h2>Create Account</h2>
                <form name="myform" class="form" action="SignUp.php" method="post" onsubmit="return validate();">
                    <input type="text" id="txtunm" name="txtunm" placeholder="Name" required>
                    <input type="email" id="txteid" name="txteid" placeholder="Email" required>
                    <input type="number" id="txtnum" name="txtnum" placeholder="Number" required>
                    <input type="password" id="txtpwd" name="txtpwd" placeholder="Password" required>
                    <button data-open-sup type="submit" name="signup">Sign Up</button>
                </form>
                <footer>
                    Existing users, sign in
                    <a href="login.php">Here</a>
                </footer>
                <!-- SUP -->
                <dialog data-sup>
                    <form method="post">
                        <div class="supContainer">
                            <b class="Sent">OTP Sent</b>
                            <span><b>Email: " <b id="supContainer__email"></b> "</b></span>
                            <input class="supContainer__content OTP" type="number" name="otp" placeholder="Enter OTP" required>
                            <button class="supContainer__content resend" type="button" onclick="firstForm();" name="resend">Resend OTP</button>
                            <button class="supContainer__content submit" type="submit" name="submit">Verify Email</button>
                        </div>
                    </form>
                </dialog>
            </div>
        </div>
</body>
<script src="../js/dialog.js"></script>
<script src="../js/SUP.js"></script>

</html>

<?php
if (isset($_POST['signup']) || isset($_POST['txtpwd'])) {

    $con = mysqli_connect("localhost", "root", "", "javamembers");

    if (!$con) {
        die("connection to this database failed due to " . mysqli_connect_error());
    }

    $hash_Email = md5($_POST['txteid']);

    $selectstatement = mysqli_prepare($con, "select * from tblmembers where eid=?");
    mysqli_stmt_bind_param($selectstatement, 's', $hash_Email);
    mysqli_stmt_execute($selectstatement);
    $result = mysqli_stmt_get_result($selectstatement);
    if (mysqli_num_rows($result) == 1) {
        mysqli_close($con);
        echo '<script>alert("E-Mail Already Registered");window.location.href="SignUp.php";</script>';
    }

    $username = $_POST['txtunm'];
    $email = $_POST['txteid'];
    $pwd = $_POST['txtpwd'];
    $num = $_POST['txtnum'];

    // Username Started

    $data = $username;
    $cipher = 'aes-256-cbc';
    $privateKey = md5($pwd);
    $iv = md5($pwd, true);
    $encrypted_unm = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Username , Private-Key -> Hash Password , IV -> Raw Password

    // Username Ended

    // Password Started

    $data = $pwd;
    $encrypted_pwd = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Password , Private-Key -> Hash Password , IV -> Raw Password

    // Password Ended

    // Email Started

    $data = $email;
    $encrypted_email = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Email , Private-Key -> Hash Password , IV -> Raw Password

    // Email Ended

    // Number Started

    $data = $num;
    $encrypted_num = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Number , Private-Key -> Hash Password , IV -> Raw Password

    // Number Ended

    setcookie("pr1", $encrypted_unm, 0, "/", "", true);
    setcookie("pr2", $encrypted_email, 0, "/", "", true);
    setcookie("pr3", $encrypted_pwd, 0, "/", "", true);
    setcookie("pr4", $encrypted_num, 0, "/", "", true);

    if ((!isset($_GET['resend'])) && array_key_exists('signup', $_COOKIE) && isset($_COOKIE['signup']) && $_COOKIE['signup'] == "true") {
        echo '<script>storeData("' . $username . '","' . $email . '","' . $pwd . '","' . $num . '");</script>';
        echo '<script>alert("OTP has been sent Already!");sup("' . $_POST['txteid'] . '");</script>';
    } else {

        echo '<script>storeData("' . $username . '","' . $email . '","' . $pwd . '","' . $num . '");</script>';


        $subject = "OTP Verification for OnlineJavaTutorial";

        $randomDigits = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $Message = "Thank You For Sign-up in our Website ,\nFor Security Purposes We need to Verify Your Email , \nYour OTP for Email-Verification is " . $randomDigits;

        $to = $email;
        $body = "Name: $username\nEmail: $email\nMessage:\n$Message";
        $headers = "From: iamdevanshu007@gmail.com";

        // echo '<script>alert("OTP has been sent!");sup('.$_POST['txteid'].');</script>';

        // OTP Started

        $data = $randomDigits;
        $cipher = 'aes-256-cbc';
        $privateKey = md5($_POST['txtpwd']);
        $iv = md5($_POST['txtpwd'], true);
        $encrypted_Data = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
        // Data -> RandomDigits , Private-Key -> Hash Password , IV -> Raw Password

        setcookie("sec", $encrypted_Data, 0, "/", "", true);
        setcookie("sec2", $privateKey, 0, "/", "", true);
        setcookie("sec3", $iv, 0, "/", "", true);

        // OTP Ended

        // try {
        //     echo '<script>alert("Hello");</script>';
        //     mail($to, $subject, $body, $headers);
        // } catch (Exception $e) {
        //     echo '<script>alert("' . $e->getMessage() . '");</script>';
        // }

        if (mail($to, $subject, $body, $headers)) {
            setcookie("signup", "true", 0, "/", "", true);
            echo '<script>alert("OTP has been sent!");sup("' . $_POST['txteid'] . '");</script>';
        } else {
            // If error Exist , "C:\xampp\sendmail" Goto this path and see error.log and degub.log , and check username and password ( Google App Password ) for check)
            echo '<script>alert("There was a Problem in sending you OTP , Please Try again Later!");</script>';
        }
    }
}
?>
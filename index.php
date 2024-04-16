<?php
// include 'assets/php/layout.php';  
$decrypted_UID = null;
if ((array_key_exists('enc0', $_COOKIE)) && (isset($_COOKIE['enc0']))) {

    try {
        $con = mysqli_connect("localhost", "root", "", "javamembers");
    } catch (Exception $e) {
        echo '<script>alert("Sorry for The Inconvience\nBut Unexpectedly Our Servers are Down\nPlease Try Again Later...!!");</script>';
        die("<b><i>Connection failed Because " . mysqli_connect_error() . "</b></i><br/>Exception Occured Beacuse " . $e->getMessage());
    }

    // UID Started

    $cipher = 'aes-256-cbc';
    $base_Password = $_COOKIE['enc3'];
    $raw_Password = base64_decode($base_Password);
    $privateKey = $base_Password;
    $iv = $raw_Password;
    $encrypted_UID = $_COOKIE['enc0'];
    $stringData = $encrypted_UID;

    $decrypted_UID = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted UID ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Password

    // UID Ended

    $selectstatement = mysqli_prepare($con, "select path from tblmembers where uid=?");
    mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
    mysqli_stmt_execute($selectstatement);
    $result = mysqli_stmt_get_result($selectstatement);
    $row = mysqli_fetch_assoc($result);

    if ($row['path'] == "") {
        echo '<script>
        window.onload = function() {
            defaultimg();
        }; 
        </script>';
    } else {
        echo '<script>
        window.onload = function() {
            customimg("' . $row['path'] . '");
        }; 
        </script>';
    }
}

if (isset($_POST['contactSubmit']) && (array_key_exists('enc0', $_COOKIE)) && (isset($_COOKIE['enc0']))) {

    // IV Started

    $cipher = 'aes-256-cbc';
    $base_Password = $_COOKIE['enc3'];
    $raw_Password = base64_decode($base_Password);
    $privateKey = $base_Password;
    $iv = $raw_Password;
    $encrypted_IV = $_COOKIE['enc2'];
    $stringData = $encrypted_IV;

    $decrypted_IV = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted IV ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Password

    // IV Ended

    // Email Stated

    $encrypted_Email = $_COOKIE['enc1'];
    $stringData = $encrypted_Email;
    $iv = $decrypted_IV;

    $decrypted_Email = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted Email ( Login - Cookie ) , Private-Key -> Base Password , IV -> Random (Login)

    // Email Ended

    $username = $_POST['txtunm'];
    $email = $decrypted_Email;
    $subject = $_POST['txtsub'];
    $Message = $_POST['txtmsg'];
    $to = 'iamdevanshu007@gmail.com';
    $body = "Name: $username\nEmail: $email\nMessage:\n$Message";
    $headers = "From: iamdevanshu007@gmail.com";

    if (mail($to, $subject, $body, $headers)) {
        echo '<script>alert("Your Message has been Sent , Thank you For your Feedback!");</script>';
    } else {
        echo '<script>alert("There was a Problem in sending your Message , Please Try again Later!");</script>';
    }
} elseif (isset($_POST['contactSubmit'])) {
    echo '<script>alert("You Have to Login First to Send Queries/Issues with us By Email...!!"); window.location.href="assets/php/login.php";</script>';
}
?>

<script>
    function profile() {
        window.location.href = "assets/php/profile.php";
    }

    function defaultimg() {
        let loginText = document.querySelectorAll(".loginText");
        loginText.forEach(log => {
            log.style.display = "none";
        });
        document.querySelector(".navigation__profile img").style.display = "inline-block";
        document.querySelector('.loginImg').style.display = "inline-block";
        var img = document.getElementById("profile");
        img.src = "assets/img/Default.png";
    }

    function customimg(path) {
        let loginText = document.querySelectorAll(".loginText");
        loginText.forEach(log => {
            log.style.display = "none";
        });
        document.querySelector('.navigation__profile img').style.display = "inline-block";
        document.querySelector('.loginImg').style.display = "inline-block";
        var img = document.getElementById("profile");
        let indexpath = path.substring(6);
        img.src = indexpath;
    }
</script>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/index.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/utils.css">
    <title>Java Tutorial</title>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="allContainer">
        <div class="container responsive">
            <a class="logo" href="">Java Tutorial</a>
            <nav class="nav">
                <table class="Table">
                    <tr>
                        <ul>
                            <li class="navigation"><a href="">Home</a></li>
                            <li class="navigation"><a href="assets/php/01_History.php">Chapters</a></li>
                            <li class="navigation"><a href="assets/php/Quiz.php">Quiz</a></li>
                            <li class="navigation contactLink"><a>Contact-Us</a></li>
                            <li class="navigation__profile"><img onclick="return profile();" title="Profile Page" id="profile" /></li>
                            <li class="navigation"><a class="loginText" href="assets/php/login.php">Login</a></li>
                        </ul>
                    </tr>
                </table>
                <!-- Dialog/Sidebar -->
                <div data-open-modal class="sidebar">
                    <div class="menuToggle"></div>
                </div>
                <dialog data-modal>
                    <div class="modalContainer">
                        <a class="modalContainer__links" href="">Home</a>
                        <a class="modalContainer__links" href="assets/php/01_History.php">Chapters</a>
                        <a class="modalContainer__links" href="assets/php/Quiz.php">Quiz</a>
                        <a class="modalContainer__links contactLink">Contact-Us</a>
                        <a class="modalContainer__links loginImg" href="assets/php/profile.php">Profile</a>
                        <a class="modalContainer__links loginText" href="assets/php/login.php">Login</a>
                    </div>
                </dialog>
            </nav>

            <!-- Content -->
            <section id="hero">
                <div class="Main responsive">
                    <div class="Main__Wrapper">
                        <h1 class="Main__h1">Welcome to Java Tutorial</h1>
                        <a href="assets/php/01_History.php">Get Started</a>
                    </div>
                </div>
            </section>

            <!-- Contact -->
            <form method="post">
                <section id="contact" class="contactSection">
                    <div class="contactSection__Container">
                        <span class="contactSection__Container__Head">Contact Us!</span>
                        <input class="contactSection__Container__Content" type="text" placeholder="Enter Your Name" name="txtunm" />
                        <input class="contactSection__Container__Content" type="text" placeholder="Enter Subject" name="txtsub" />
                        <textarea class="contactSection__Container__Content messageBox" placeholder="Enter Your Message" rows="5" name="txtmsg"></textarea>
                        <button class="contactSection__Container__btn" type="submit" name="contactSubmit">SUBMIT</button>
                    </div>
                </section>
            </form>
        </div>
        <footer class="homeFooter">
            <div class="homeFooter__div">
                <p> <b class="homeFooter__div__logo">&#169;</b> Copyright Under OnlineJavaTutorial.</p>
                <p>All Rights Reserved Inc. <b class="homeFooter__div__link">privacy policy statement</b></p>
            </div>
        </footer>
    </div>
</body>
<script>
    const openButton = document.querySelector("[data-open-modal]")
    const modal = document.querySelector("[data-modal]")
    const firstItem = document.querySelector(".modalContainer__links");

    openButton.addEventListener("click", () => {
        modal.showModal()
    })

    modal.addEventListener("click", e => {
        const dialogDimension = modal.getBoundingClientRect()

        if (
            e.clientX < dialogDimension.left ||
            e.clientX > dialogDimension.right ||
            e.clientY < dialogDimension.top ||
            e.clientY > dialogDimension.bottom
        ) {
            modal.close();
        }
    })

    var links = document.querySelectorAll(".contactLink");
    links.forEach(function(link) {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            var target = document.getElementById("contact");
            target.scrollIntoView({
                behavior: 'smooth',
                block: "end"
            });
        });
    });
</script>

</html>
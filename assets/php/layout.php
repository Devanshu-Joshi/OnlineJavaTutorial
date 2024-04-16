<?php
if ((array_key_exists('enc0', $_COOKIE)) && (isset($_COOKIE['enc0']))) {

    $con = mysqli_connect("localhost", "root", "", "javamembers");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $selectstatement = mysqli_prepare($con, "select path from tblmembers where uid=?");
    mysqli_stmt_bind_param($selectstatement, "s", $_COOKIE['enc0']);
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
?>

<script>
    function profile() {
        window.location.href = "assets/php/profile.php";
    }

    function defaultimg() {
        document.getElementById("log").style.display = "none";
        document.querySelector('.navigation__profile img').style.display = "inline-block";
        var img = document.getElementById("profile");
        img.src = "assets/img/Default.png";
    }

    function customimg(path) {
        document.getElementById("log").style.display = "none";
        document.querySelector('.navigation__profile img').style.display = "inline-block";
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
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/utils.css">
</head>

<body>
    <!-- Navigation Bar -->
    <div class="container responsive">
        <a class="logo" href="">Java Tutorial</a>
        <nav class="nav">
            <table class="Table">
                <tr>
                    <ul>
                        <li class="navigation"><a href="">Home</a></li>
                        <li class="navigation"><a href="assets/php/01_History.php">Chapters</a></li>
                        <li class="navigation"><a href="assets/php/Quiz.php">Quiz</a></li>
                        <li class="navigation"><a href="">About-Us</a></li>
                        <li class="navigation__profile"><img onclick="return profile();" title="Profile Page" id="profile" /></li>
                        <li class="navigation"><a id="log" href="assets/php/login.php">Login</a></li>
                    </ul>
                </tr>
            </table>
        </nav>

        <!-- Sidebar -->

        <div class="sidebar">
            <div class="menuToggle"></div>
        </div>
    </div>

    <script>
        let menuToggle = document.querySelector('.menuToggle');
        let sidebar = document.querySelector('.sidebar');
        menuToggle.onclick = function() {
            sidebar.classList.toggle('active');
        }
    </script>

</body>

</html>
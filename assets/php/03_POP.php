<?php
if (isset($_POST['submitPrevious'])) {
    header("Location: 02_Features.php");
} else if (isset($_POST['submitNext'])) {
    header("Location: 04_Datatypes.php");
}
if ((array_key_exists('enc0', $_COOKIE)) && (isset($_COOKIE['enc0']))) {
    try
    {
        $con = mysqli_connect("localhost", "root", "", "javamembers");
    }
    catch(Exception $e)
    {
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
    // Data -> Encrypted UID ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Passwords

    // UID Ended

    $selectstatement = mysqli_prepare($con, "select path from tblmembers where uid=?");
    mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
    mysqli_stmt_execute($selectstatement);
    $result = mysqli_stmt_get_result($selectstatement);
    $row = mysqli_fetch_assoc($result);
}
?>

<script>
    function profile() {
        window.location.href = "profile.php";
    }

    function defaultimg() {
        var img = document.getElementById("profile");
        img.src = "../img/Default.png";
    }

    function customimg(path) {
        var img = document.getElementById("profile");
        img.src = path;
    }
</script>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/footbtn.css">
    <link rel="stylesheet" href="../css/content.css">
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/utils.css">
    <title>Chapter - 1</title>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="responsive">
        <a class="logo" href="../../">Java Tutorial</a>
        <nav class="nav">
            <table class="Table">
                <tr>
                    <ul>
                        <li class="navigation"><a href="../../">Home</a></li>
                        <li class="navigation"><a href="Quiz.php">Quiz</a></li>
                        <li class="navigation"><a href="">About-Us</a></li>
                        <li class="navigation__profile"><img onclick="return profile();" title="Profile Page" id="profile" /></li>
                        <li class="navigation"><a class="loginText" href="login.php">Login</a></li>
                    </ul>
                </tr>
            </table>
            <!-- Dialog/Sidebar -->
            <div data-open-modal class="sidebar">
                <div class="menuToggle"></div>
            </div>
            <dialog data-modal>
                <div class="modalContainer">
                    <a class="modalContainer__links" href="../../">Home</a></li>
                    <a class="modalContainer__links" href="Quiz.php">Quiz</a></li>
                    <a class="modalContainer__links" href="">About-Us</a></li>
                    <a class="modalContainer__links loginImg" href="profile.php">Profile</a></li>
                    <a class="modalContainer__links loginText" href="login.php">Login</a></li>
                </div>
            </dialog>
        </nav>
        <div class="container">
            <div class="content">
                <h2 class="content__h2">&#9830; Procedure Oriented Programming</h2>
                <br />
                <p>-> Procedure-oriented programming is a programming paradigm that focuses on dividing a program into smaller, reusable functions or procedures.It is also referred to as structured programming.In procedure-oriented programming, a program is divided into functions or procedures, which are reusable blocks of code that perform specific tasks.

                    <br /><br />-> Each procedure is designed to take input, process it, and provide output as necessary.The programming style focuses on a top-down approach, where the problem is broken down into smaller sub-problems and solved one by one.

                    <br /><br />-> Each function or procedure is designed to perform a specific task, and these procedures are combined to solve the overall problem.Some examples of programming languages that support procedure-oriented programming include C, Pascal, and Fortran.

                    <br /><br />-> Procedure-oriented programming has its advantages, such as being simple and easy to understand.However, it can become difficult to manage as programs grow larger and more complex.Also, it doesn't work well in object-oriented programming scenarios, where data and functions are encapsulated within objects.

                <div class="img__container">
                    <img class="img__content" src="../img/Screenshot 2023-05-01 180953.png" />
                </div>

                -> Moreover, Procedure-oriented programming is commonly used in applications that require linear or sequential processing, such as numerical computations, data analysis, and scientific simulations.It is also used in small-scale applications, where simplicity and ease of implementation are the main concerns.

                <br /><br />-> On the other hand, object-oriented programming provides several advantages over procedure-oriented programming.For instance, it promotes code reuse, enhances modularity, and facilitates better code organization.It also supports the development of large-scale applications by providing mechanisms for managing and manipulating complex data structures.

                <br /><br />-> In conclusion, while procedure-oriented programming has its advantages, it is limited in its ability to manage large and complex programs. Object-oriented programming provides a more flexible and robust approach to programming, and it is widely used in modern software development. Ultimately, the choice between procedure-oriented programming and object-oriented programming depends on the nature and requirements of the application being developed.

                <br /><br />-> The way a procedural language interacts with your devices is crucial. When you utilize a procedural programming language, you give your computer explicit instructions and tell it how to achieve its goals using logic and step-by-step procedures. This is a strategy that looks at jobs from the top down. Data is treated differently in procedural languages than processes, which has an impact on how developers use it. C, Java, and Pascal are examples of procedural programming languages.

                <br /><br />-> However, as your career grows and you get more comfortable in your position, you begin to focus on certain areas within your field. Procedural programming is one of the major stumbling blocks. Many different software codes use procedural programming, yet it may not be the best option for every task.

                <br /><br />-> Procedural programming languages are older and easier to understand than other types of computer languages. As a result, many programmers begin their education by practicing in a procedural environment. When dealing with procedural languages, the basic strategy is to look at the complete programme and then split it down into individual procedures. You then break down those processes into smaller sub-procedures, and so on, until the app is broken down into manageable bits.

                <div class="img__container">
                    <img class="img__content" src="../img/procedural_programming.webp" />
                </div>

                -> You may believe that procedural programming is a thing of the past, no longer in use in the commercial world. That is not the case, however. Many vocations necessitate a solid understanding of procedural programming. Some of those jobs can be rather lucrative, so it's not always a smart idea to dismiss procedural programming right once.

                <br /><br />-> Procedural programming is an excellent technique to tackle general programming jobs that don't require a lot of reusable code or real-world objects because it's easy to grasp and use. Many of the apps you develop, on the other hand, don't function well with procedural programming, and it's critical to understand why so you can address each issue properly.

                <br /><br />-> Procedural programming has been around for a long time and shows no signs of going away anytime soon. Our guide walks you through the basics of procedural programming and shows you how it's used by developers.

                <br /><br />-> Because Java is at least partially a procedural language, you'll have no trouble landing a top job if you have strong procedural skills. Web developers frequently employ procedural languages in their work, and you'll be able to locate a variety of server-side applications and back-end platforms that require a motivated coder with procedural programming skills.
                </p>
            </div>
        </div>
        <form method="post">
            <footer class="foot">
                <button type="submit" name="submitPrevious" value="Previous">
                    <- Previous </button>
                        <button type="submit" name="submitNext" value="Next">
                            Next One ->
                        </button>
            </footer>
        </form>
</body>

<script src="../js/profilecontent.js"></script>
<script src="../js/dialog.js"></script>

<?php
if ((array_key_exists('enc0', $_COOKIE)) && (isset($_COOKIE['enc0']))) {
    if ($row['path'] == "") {
        echo '<script>
                defaultimg();
            </script>';
    } else {
        echo '<script>
                defaultimg();
                customimg("' . $row['path'] . '");
            </script>';
    }
}
?>

</html>
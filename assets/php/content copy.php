<?php
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
    <link rel="stylesheet" href="../css/content.css">
    <title>Chapter - 1</title>
</head>

<body>
    <div class="navContainer">
        <a class="logo" href="../../">Java Tutorial</a>
        <nav class="nav">
            <table class="Table">
                <tr>
                    <ul class="navigation">
                        <li><a href="../../">Home</a></li>
                        <li><a href="Quiz.php">Quiz</a></li>
                        <li><a href="">About-Us</a></li>
                        <li><img onclick="return profile();" title="Profile Page" id="profile" /></li>
                    </ul>
                </tr>
            </table>
        </nav>
    </div>
    <div class="container">
        <div class="content__wrappper">
            <h2>&#9830; Procedure Oriented Programming</h2>
            <div class="content">
                <p>-> Procedure-oriented programming is a programming paradigm that focuses on dividing a program into smaller, reusable functions or procedures.It is also referred to as structured programming.In procedure-oriented programming, a program is divided into functions or procedures, which are reusable blocks of code that perform specific tasks.

                    <br /><br />-> Each procedure is designed to take input, process it, and provide output as necessary.The programming style focuses on a top-down approach, where the problem is broken down into smaller sub-problems and solved one by one.

                    <br /><br />-> Each function or procedure is designed to perform a specific task, and these procedures are combined to solve the overall problem.Some examples of programming languages that support procedure-oriented programming include C, Pascal, and Fortran.

                    <br /><br />-> Procedure-oriented programming has its advantages, such as being simple and easy to understand.However, it can become difficult to manage as programs grow larger and more complex.Also, it doesn't work well in object-oriented programming scenarios, where data and functions are encapsulated within objects.

                <div class="img__container">
                    <img src="../img/Screenshot 2023-05-01 180953.png" />
                </div>

                -> Moreover, Procedure-oriented programming is commonly used in applications that require linear or sequential processing, such as numerical computations, data analysis, and scientific simulations.It is also used in small-scale applications, where simplicity and ease of implementation are the main concerns.

                <br /><br />-> On the other hand, object-oriented programming provides several advantages over procedure-oriented programming.For instance, it promotes code reuse, enhances modularity, and facilitates better code organization.It also supports the development of large-scale applications by providing mechanisms for managing and manipulating complex data structures.

                <br /><br />-> In conclusion, while procedure-oriented programming has its advantages, it is limited in its ability to manage large and complex programs. Object-oriented programming provides a more flexible and robust approach to programming, and it is widely used in modern software development. Ultimately, the choice between procedure-oriented programming and object-oriented programming depends on the nature and requirements of the application being developed.

                <br /><br />-> The way a procedural language interacts with your devices is crucial. When you utilize a procedural programming language, you give your computer explicit instructions and tell it how to achieve its goals using logic and step-by-step procedures. This is a strategy that looks at jobs from the top down. Data is treated differently in procedural languages than processes, which has an impact on how developers use it. C, Java, and Pascal are examples of procedural programming languages.

                <br /><br />-> However, as your career grows and you get more comfortable in your position, you begin to focus on certain areas within your field. Procedural programming is one of the major stumbling blocks. Many different software codes use procedural programming, yet it may not be the best option for every task.

                <br /><br />-> Procedural programming languages are older and easier to understand than other types of computer languages. As a result, many programmers begin their education by practicing in a procedural environment. When dealing with procedural languages, the basic strategy is to look at the complete programme and then split it down into individual procedures. You then break down those processes into smaller sub-procedures, and so on, until the app is broken down into manageable bits.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
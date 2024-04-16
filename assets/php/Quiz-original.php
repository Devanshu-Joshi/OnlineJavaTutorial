<?php
if ((!array_key_exists('enc0', $_COOKIE)) || (!isset($_COOKIE['enc0']))) {
    echo '<script>alert("You Have to login first");window.location.href="login.php";</script>';
}

$first = -1;
$second = -1;

if (isset($_POST['submit'])) {
    $btn = $_POST['submit'];
    if ($btn == "Check") {
        if(isset($_POST['op1']))
        {
            $radio1 = $_POST['op1'];
            if ($radio1 == "8") {
                $GLOBALS['first'] = 1;
            } else {
                $GLOBALS['first'] = 0;
            }
        }
        if(isset($_POST['op2']))
        {
            $radio2 = $_POST['op2'];
            if ($radio2 == "int value") {
                $GLOBALS['second'] = 1;
            } else {
                $GLOBALS['second'] = 0;
            }
        }
    }
}

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
        display(' . $first . ',' . $second . ');
    }; 
    </script>';
} 
else {
    echo '<script>
    window.onload = function() {
        customimg("' . $row['path'] . '");
        display(' . $first . ',' . $second . ');
    }; 
    </script>';
}
?>

<script type="text/javascript">
    function display(x, y) {
        if (x == 1) {
            document.getElementById("crct1").style.display = "inline";
        }
        else if(x == 0)
        {
            document.getElementById("crct1").style.display = "inline";
            document.getElementById("crct1").src = "../img/Wrong.png";
        }
        if (y == 1) {
            document.getElementById("crct2").style.display = "inline";
        }
        else if(y == 0)
        {
            document.getElementById("crct1").style.display = "inline";
            document.getElementById("crct2").src = "../img/Wrong.png";
        }
    }
    function profile()
    {
        window.location.href="profile.php";
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
    <link rel="stylesheet" href="../css/Quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&family=Ubuntu&display=swap" rel="stylesheet">
    <title>Quiz</title>
</head>

<body>
    <div class="navContainer">
        <a class="logo" href="../../">Java Tutorial</a>
        <nav class="nav">
            <table class="Table">
                <tr>
                    <ul class="navigation">
                        <li><a href="../../">Home</a></li>
                        <li><a href="#">Chapters</a></li>
                        <li><a href="">About-Us</a></li>
                        <li><img onclick="return profile();" title="Profile Page" id="profile" /></li>
                    </ul>
                </tr>
            </table>
        </nav>
    </div>
    <div class="quizContainer">
        <section class="container">
            <form method="post">
                <span>
                    <hr /><br />
                    <p class="Que">Question : 1</p> <br />
                    <p class="content">&#9679 Number of primitive data types in Java are ? </p> <img src="../img/Correct.png" id="crct1" class="correct" /> <br />
                </span>
                <span class="input">
                    <input type="radio" name="op1" value="6"> &nbsp; six &nbsp; <br />
                    <input type="radio" name="op1" value="7"> &nbsp; seven<br />
                    <input type="radio" name="op1" value="8"> &nbsp; eight<br />
                    <input type="radio" name="op1" value="9"> &nbsp; nine<br />
                </span>
                <br />
                <hr />
                <span>
                    <hr /><br />
                    <p class="Que">Question : 2</p> <br />
                    <p class="content">&#9679 The compareTo() Method returns which Value ? </p> <img src="../img/Correct.png" id="crct2" class="correct" /> <br />
                </span>
                <span class="input">
                    <input type="radio" name="op2" value="True"> &nbsp; True<br />
                    <input type="radio" name="op2" value="False"> &nbsp; False<br />
                    <input type="radio" name="op2" value="int value"> &nbsp; int value<br />
                    <input type="radio" name="op2" value="None"> &nbsp; None<br />
                </span>
                <footer class="foot">
                    <button type="submit" name="submit" value="Previous">
                        Previous
                    </button>
                    <button type="submit" name="submit" value="Check" id="check">
                        Check
                    </button>
                    <button type="submit" name="submit" value="Next">
                        Next
                    </button>
                </footer>
                <br />
                <hr />
            </form>
        </section>
    </div>
</body>

</html>
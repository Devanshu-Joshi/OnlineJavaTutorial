<?php
    if ((!array_key_exists('enc0', $_COOKIE)) || (!isset($_COOKIE['enc0'])))
    {
        echo '<script>alert("You Have to login first");window.location.href="login.php";</script>';
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&family=Ubuntu&display=swap" rel="stylesheet">
    <title>Quiz</title>
</head>
<body>
    <section class="container">
        <form method="post" action="Quiz.php">
            <span>
                <hr/><br/>
                <p class="Que">Question : 1</p> <br/>
                <p class="content">&#9679 Number of primitive data types in Java are ? </p> <br/>
            </span>
            <span class="input">
                <input type="radio" name="op1" id="op1" value="6" checked> &nbsp; six &nbsp; <br/>
                <input type="radio" name="op1" id="op2" value="7"> &nbsp; seven<br/>
                <input type="radio" name="op1" id="op3" value="8"> &nbsp; eight<br/>
                <input type="radio" name="op1" id="op4" value="9"> &nbsp; nine<br/>
            </span>
            <br/><hr/>
            <span>
                <hr/><br/>
                <p class="Que">Question : 2</p> <br/>
                <p class="content">&#9679 The compareTo() Method returns which Value ? </p> <br/>
            </span>
            <span class="input">
                <input type="radio" name="op2" id="op1" value="True" checked> &nbsp; True<br/>
                <input type="radio" name="op2" id="op1" value="False"> &nbsp; False<br/>
                <input type="radio" name="op2" id="op1" value="int value"> &nbsp; int value<br/>
                <input type="radio" name="op2" id="op1" value="None"> &nbsp; None<br/>
            </span>
            <button class="button" type="submit">Next</button>
            <br/><hr/>
        </form>
    </section> 
</body>
</html>
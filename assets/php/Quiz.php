<?php
session_start();
if ((!array_key_exists('enc0', $_COOKIE)) || (!isset($_COOKIE['enc0']))) {
    echo '<script>alert("You Have to login first");window.location.href="login.php";</script>';
}

$first = -1;
$queNo = "?";
$queContent = "Sorry, Question is Loading, Please Wait or Refresh The Page after Some Time...";
$op1 = "Loading...";
$op2 = "Loading...";
$op3 = "Loading...";
$op4 = "Loading...";

if (!isset($_SESSION['trace'])) {
    $_SESSION['trace'] = 1;
}

if (isset($_POST['submitNext']) && $_SESSION['trace'] < 10) {
    $_SESSION['trace'] += 1;
} elseif (isset($_POST['submitPrevious']) && $_SESSION['trace'] > 1) {
    $_SESSION['trace'] -= 1;
}

$trace = $_SESSION['trace'];

try {
    $con = mysqli_connect("localhost", "root", "", "javamembers");
} catch (Exception $e) {
    echo '<script>alert("Sorry for The Inconvience\nBut Unexpectedly Our Servers are Down\nPlease Try Again Later...!!");</script>';
    die("<b><i>Connection failed Because " . mysqli_connect_error() . "</b></i><br/>Exception Occured Beacuse " . $e->getMessage());
}

$selectstatement = mysqli_prepare($con, "select * from tblQuiz where queNo=?");
mysqli_stmt_bind_param($selectstatement, "i", $trace);
mysqli_stmt_execute($selectstatement);
$result = mysqli_stmt_get_result($selectstatement);
$queDetails = mysqli_fetch_assoc($result);

$queNo = $queDetails['queNo'];
$queContent = $queDetails['queContent'];
$queOption = $queDetails['queOption'];
$queAns = $queDetails['queAns'];
$queAns = strval($queAns);
$optArray = explode("`", $queOption);

if (isset($_POST['submitCheck'])) {
    if (isset($_POST['op1'])) {
        $radio1 = $_POST['op1'];
        if ($radio1 == $queAns) {
            $GLOBALS['first'] = 1;
        } else {
            $GLOBALS['first'] = 0;
        }
    }
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
        display(' . $first . ');
    }; 
    </script>';
} else {
    echo '<script>
    window.onload = function() {
        customimg("' . $row['path'] . '");
        display(' . $first . ');
    }; 
    </script>';
}
?>

<script type="text/javascript">
    function display(x) {
        if (x == 1) {
            let btn = document.getElementById("check")
            btn.textContent = "Correct";
            btn.style.backgroundColor = "green";
            btn.style.cursor = "default";
            btn.setAttribute('type', 'button');
        } else if (x == 0) {
            let btn = document.getElementById("check")
            btn.textContent = "Wrong";
            btn.style.backgroundColor = "red";
            btn.style.cursor = "default";
            btn.setAttribute('type', 'button');
        }
    }
</script>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Quiz.css">
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/utils.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&family=Ubuntu&display=swap" rel="stylesheet">
    <title>Quiz</title>
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
                        <li class="navigation"><a href="01_History.php">Chapters</a></li>
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
                    <a class="modalContainer__links" href="../../">Home</a>
                    <a class="modalContainer__links" href="01_History.php">Chapters</a>
                    <a class="modalContainer__links" href="">About-Us</a>
                    <a class="modalContainer__links loginImg" href="profile.php">Profile</a>
                    <a class="modalContainer__links loginText" href="login.php">Login</a>
                </div>
            </dialog>
        </nav>

        <!-- QuizContainer -->
        <div class="quizContainer">
            <section class="container">
                <form method="post">
                    <span>
                        <hr /><br />
                        <p class="Que">Question : <?php echo $queNo; ?></p> <br /><br />
                        <p class="content"><?php echo $queContent; ?></p><br /><br />
                    </span>
                    <span class="input" id="spanClick">
                        <input type="radio" name="op1" value="1" id="1"> &nbsp; <label for="1"> <?php echo $optArray[0]; ?> </label> <br />
                        <input type="radio" name="op1" value="2" id="2"> &nbsp; <label for="2"> <?php echo $optArray[1]; ?> </label> <br />
                        <input type="radio" name="op1" value="3" id="3"> &nbsp; <label for="3"> <?php echo $optArray[2]; ?> </label> <br />
                        <input type="radio" name="op1" value="4" id="4"> &nbsp; <label for="4"><?php echo $optArray[3]; ?> </label> <br />
                    </span>
                    <br />
                    <footer class="foot">
                        <button type="submit" name="submitPrevious" value="Previous">
                            Previous
                        </button>
                        <button type="submit" name="submitCheck" value="Check" title="Select Option and Click to Check Answer" id="check">
                            Check
                        </button>
                        <button type="submit" name="submitNext" value="Next">
                            Next One
                        </button>
                    </footer>
                    <br />
                    <hr />
                </form>
            </section>
        </div>
</body>
<script type="text/javascript">
    document.getElementById("spanClick").addEventListener("click", function() {
        let btn = document.getElementById("check")
        btn.textContent = "Check";
        btn.style.backgroundColor = "#216ce7";
        btn.style.cursor = "pointer";
        btn.setAttribute('type', 'submit');
    });
</script>
<script src="../js/profile.js"></script>
<script src="../js/dialog.js"></script>

</html>
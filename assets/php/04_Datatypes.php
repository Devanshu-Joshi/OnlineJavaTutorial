<?php
if (isset($_POST['submitPrevious'])) {
    header("Location: 03_POP.php");
} else if (isset($_POST['submitNext'])) {
    header("Location: 05_Variables.php");
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
                <h2 class="content__h2">&#9830; Datatypes in Java</h2>
                <br />
                <p>-> Java has two main categories of data types: primitive and reference types.

                    <br /><br />-> Primitive types:<br />
                    boolean: can only have two values, true or false.<br />
                    byte: 8-bit signed integer value.<br />
                    short: 16-bit signed integer value.<br />
                    int: 32-bit signed integer value.<br />
                    long: 64-bit signed integer value.<br />
                    float: 32-bit floating-point value.<br />
                    double: 64-bit floating-point value.<br />
                    char: 16-bit Unicode character.

                    <br /><br />-> Reference types:<br />
                    Arrays: used to store multiple values in a single variable.<br />
                    Class types: an object-oriented concept that allows the creation of objects from classes that define attributes and behaviors.<br />
                    Interface types: used to define a set of methods that a class must implement.<br />
                    Enum types: used to define a fixed set of constants that can be used as values.


                    <br /><br />-> Java is a statically-typed programming language. It means, all variables must be declared before its use. That is why we need to declare variable's type and name.


                    <br /><br />-> Boolean Data Type:<br /> In Primitive , The Boolean data type is used to store only two possible values: true and false. This data type is used for simple flags that track true/false conditions.The Boolean data type specifies one bit of information, but its "size" can't be defined precisely.<br />Example : Boolean one = false

                    <br /><br />-> Byte Data Type :<br />
                    The byte data type is an example of primitive data type. It isan 8-bit signed two's complement integer. Its value-range lies between -128 to 127 (inclusive). Its minimum value is -128 and maximum value is 127. Its default value is 0.
                    The byte data type is used to save memory in large arrays where the memory savings is most required. It saves space because a byte is 4 times smaller than an integer. It can also be used in place of "int" data type.<br />Example : byte a = 10, byte b = -20

                <div class="img__container">
                    <img class="img__content" src="../img/DataTypes.png" />
                </div>

                -> Short Data Type:<br />
                The short data type is a 16-bit signed two's complement integer. Its value-range lies between -32,768 to 32,767 (inclusive). Its minimum value is -32,768 and maximum value is 32,767. Its default value is 0. The short data type can also be used to save memory just like byte data type. A short data type is 2 times smaller than an integer.<br />Example : short s = 10000, short r = -5000


                <br /><br />-> Int Data Type:<br />
                The int data type is a 32-bit signed two's complement integer. Its value-range lies between - 2,147,483,648 (-2^31) to 2,147,483,647 (2^31 -1) (inclusive). Its minimum value is - 2,147,483,648and maximum value is 2,147,483,647. Its default value is 0. The int data type is generally used as a default data type for integral values unless if there is no problem about memory.<br />Example : int a = 100000, int b = -200000

                <br /><br />-> Long Data Type:<br />
                The long data type is a 64-bit two's complement integer. Its value-range lies between -9,223,372,036,854,775,808(-2^63) to 9,223,372,036,854,775,807(2^63 -1)(inclusive). Its minimum value is - 9,223,372,036,854,775,808and maximum value is 9,223,372,036,854,775,807. Its default value is 0. The long data type is used when you need a range of values more than those provided by int.<br />Example : long a = 100000L, long b = -200000L

                <br /><br />-> Float Data Type:<br />
                The float data type is a single-precision 32-bit IEEE 754 floating point.Its value range is unlimited. It is recommended to use a float (instead of double) if you need to save memory in large arrays of floating point numbers. The float data type should never be used for precise values, such as currency. Its default value is 0.0F.<br />Example : float f1 = 234.5f

                <div class="img__container">
                    <img class="img__content" src="../img/Integer_float_data.png" />
                </div>

                -> Double Data Type:<br />
                The double data type is a double-precision 64-bit IEEE 754 floating point. Its value range is unlimited. The double data type is generally used for decimal values just like float. The double data type also should never be used for precise values, such as currency. Its default value is 0.0d.<br />Example : double d1 = 12.3

                <br /><br />-> Char Data Type:<br />
                The char data type is a single 16-bit Unicode character. Its value-range lies between '\u0000' (or 0) to '\uffff' (or 65,535 inclusive). The char data type is used to store characters.<br />Example : char letterA = 'A'<br />
                Why char uses 2 byte in java and what is \u0000 ?<br/>
                It is because java uses Unicode system not ASCII code system. The \u0000 is the lowest range of Unicode system.
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
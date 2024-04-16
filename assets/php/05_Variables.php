<?php
if (isset($_POST['submitPrevious'])) {
    header("Location: 04_Datatypes.php");
} else if (isset($_POST['submitNext'])) {
    header("Location: 06_Array.php");
}
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
                <h2 class="content__h2">&#9830; Variables in Java</h2>
                <br />
                <p>-> In Java, a variable is a named memory location that can hold a value of a specific data type. Variables are used to store and manipulate data in a program.

                    <br /><br />-> To declare a variable in Java, you must specify the variable's data type and a name for the variable. For example, to declare an integer variable called "myNumber," you would use the following code:<br />
                    int myNumber;<br />This declares a variable of type "int" (short for integer) with the name "myNumber."<br />You can also initialize the variable at the time of declaration by assigning a value to it. <br />For example:
                    int myNumber = 10;<br />This declares an integer variable called "myNumber" and initializes it with the value 10.

                <div class="img__container">
                    <img class="img__content" src="../img/variables-in-java.png" />
                </div>

                -> Once you have declared a variable, you can use it in your program by assigning a value to it, reading its value, or performing operations on its value.It's important to note that Java is a strongly typed language, which means that every variable must have a specific data type. Additionally, Java variables are scoped, which means that they are only accessible within the block of code where they are defined.A variable is a container which holds the value while the Java program is executed. A variable is assigned with a data type.Variable is a name of memory location. There are three types of variables in java:<br /> local, instance and static.


                <br /><br />-> Types of Variables
                There are three types of variables in Java:<br />local variable<br />
                instance variable<br />
                static variable

                <br /><br />-> 1) Local Variable
                A variable declared inside the body of the method is called local variable. You can use this variable only within that method and the other methods in the class aren't even aware that the variable exists.<br />A local variable cannot be defined with "static" keyword.


                <br /><br />-> 2) Instance Variable
                A variable declared inside the class but outside the body of the method , constructor on any block, is called an instance variable. It is not declared as static.<br />It is called an instance variable because its value is instance-specific and is not shared among instances.


                <br /><br />-> 3) Static variable
                A variable that is declared as static is called a static variable. It cannot be local. You can create a single copy of the static variable and share it among all the instances of the class. Memory allocation for static variables happens only once when the class is loaded in the memory.

                <div class="img__container">
                    <img class="img__content" src="../img/variablesjpg.jpg" />
                </div>

                -> Example to understand the types of variables in java<br /><br />
                <pre>
                public class A {
                    static int m = 100; // static variable
                    int instanceVariable = 200; // instance variable

                    void method() {
                        int n = 90; // local variable
                    }

                    public static void main(String args[]) {
                        int data = 50; // local variable
                    }
                }
                </pre>
                <br /><br />-> Java Variable Example: Add Two Numbers<br /><br />
                <pre>
                public class Simple{
                    public static void main(String[] args){
                        int a=10;
                        int b=10;
                        int c=a+b;
                        System.out.println(c);
                    }
                }

                Output:
                20
                </pre>
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
<?php
if (isset($_POST['submitPrevious'])) {
    header("Location: 05_Variables.php");
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
                <p>-> In Java, an array is a data structure that stores a fixed-size sequential collection of elements of the same type. Arrays can be one-dimensional, two-dimensional or multi-dimensional, and they are declared using the following syntax:<br />
                    <br />type[ ] arrayName; // For a one-dimensional array
                    <br />type[ ][ ] arrayName; // For a two-dimensional array
                    <br />type[ ][ ][ ] arrayName; // For a three-dimensional array, and so on

                    <br /><br />-> Where "type" specifies the data type of the elements that will be stored in the array, and "arrayName" is the name of the array. <br />Here's an example of how to declare and initialize a one-dimensional array of integers:<br />
                <pre>   int[] numbers = {1, 2, 3, 4, 5};</pre>

                <br /><br />-> In this example, the "numbers" array contains five elements of type "int", with the values 1, 2, 3, 4, and 5. To access a specific element of the array, you can use the index of the element, which starts from 0. <br />For example:<br />int thirdNumber = numbers[2]; // Accesses the third element (index 2) of the array

                <div class="img__container">
                    <img class="img__content" src="../img/Arrays.png" />
                </div>

                -> Arrays in Java are very useful for storing collections of data, and they are used extensively in programming.Normally, an array is a collection of similar type of elements which has contiguous memory location.


                <br /><br />-> Java array is an object which contains elements of a similar data type. Additionally, The elements of an array are stored in a contiguous memory location. It is a data structure where we store similar elements. We can store only a fixed set of elements in a Java array.Array in Java is index-based, the first element of the array is stored at the 0th index, 2nd element is stored on 1st index and so on.

                <br /><br />-> In Java, array is an object of a dynamically generated class. Java array inherits the Object class, and implements the Serializable as well as Cloneable interfaces. We can store primitive values or objects in an array in Java. Like C/C++, we can also create single dimentional or multidimentional arrays in Java.Moreover, Java provides the feature of anonymous arrays which is not available in C/C++.

                <br /><br />-> Advantages: <br />
                Code Optimization: It makes the code optimized, we can retrieve or sort the data efficiently.<br />
                Random access: We can get any data located at an index position.

                <br /><br />-> Disadvantages:<br />
                Size Limit: We can store only the fixed size of elements in the array. It doesn't grow its size at runtime. To solve this problem, collection framework is used in Java which grows automatically.


                <br /><br />-> There are two types of array.<br />
                Single Dimensional Array<br />
                Multidimensional Array

                <div class="img__container">
                    <img class="img__content" src="../img/ArraysinJava.jpg" />
                </div>

                Syntax to Declare an Array in Java:<br />
                dataType[] arr; (or)<br />
                dataType []arr; (or)<br />
                dataType arr[];

                <br /><br />-> Let's see the simple example of java array, where we are going to declare, instantiate, initialize and traverse an array.
                <br /><br />
                <pre>
//Java Program to illustrate how to declare, instantiate, initialize  
//and traverse the Java array.  
class Testarray{  
    public static void main(String args[]){  
        int a[]=new int[5];//declaration and instantiation  
        a[0]=10;//initialization  
        a[1]=20;  
        a[2]=70;  
        a[3]=40;  
        a[4]=50;  
        //traversing array  
        for(int i=0;i&lt;a.length;i++)//length is the property of array {
            System.out.println(a[i]);  
        }
    }
}  

Output:
10
20
70
40
50
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
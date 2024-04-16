<?php
if (isset($_POST['submitPrevious'])) {
    header("Location: 01_History.php");
} else if (isset($_POST['submitNext'])) {
    header("Location: 03_POP.php");
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
    // Data -> Encrypted UID ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Password

    // UID Ended

    $selectstatement = mysqli_prepare($con, "select path from tblmembers where uid=?");
    mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
    mysqli_stmt_execute($selectstatement);
    $result = mysqli_stmt_get_result($selectstatement);
    $row = mysqli_fetch_assoc($result);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/footbtn.css">
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/content.css">
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
                <h2 class="content__h2">&#9830; Ultimate Features of Java</h2>
                <br />
                <p>-> Java, the versatile and widely-used programming language, has been a mainstay in the software development landscape for over two decades. Its popularity can be attributed to its robustness, scalability, and cross-platform compatibility. However, beyond these core attributes, Java boasts a rich set of features that make it a powerful tool for developers. In this blog, we will delve into some of the most prominent features of Java, highlighting their significance and how they contribute to the language's versatility.

                    <br /><br />-> 1. Object-Oriented Programming:<br />
                    Java's foundation lies in its strong support for object-oriented programming (OOP) principles. Encapsulation, inheritance, and polymorphism are all integral to Java's design, enabling developers to build modular, reusable, and maintainable code. OOP allows for better organization of code, easier debugging, and promotes code reusability, which ultimately enhances productivity.

                    <br /><br />-> 2. Platform Independence:<br />
                    Java's "Write Once, Run Anywhere" (WORA) philosophy has been one of its most compelling features. By employing the Java Virtual Machine (JVM), Java code can be executed on any platform that has a compatible JVM installed. This feature has been pivotal in enabling developers to develop applications that can seamlessly run on different operating systems, reducing the need for platform-specific modifications.

                    <br /><br />-> 3. Memory Management and Garbage Collection:<br />
                    Java relieves developers from the burden of manual memory management. It includes an automatic garbage collection mechanism that automatically reclaims memory occupied by objects that are no longer in use. This simplifies memory management, reduces the occurrence of memory leaks and segmentation faults, and enhances the overall stability of Java applications.

                <div class="img__container">
                    <img class="img__content" src="../img/java-features.png" />
                </div>

                -> 4. Exception Handling:<br />
                Exception handling in Java is an essential feature that helps manage errors and handle exceptional scenarios. By employing try-catch blocks, developers can catch and handle exceptions gracefully, preventing application crashes. Java's robust exception handling mechanism promotes code reliability and maintainability, making it easier to identify and fix potential issues.

                <br /><br />-> 5. Multithreading and Concurrency:<br />
                Java provides extensive support for multithreading and concurrency, allowing developers to create highly efficient and responsive applications. By leveraging threads and synchronized constructs, developers can execute multiple tasks concurrently, improving performance and responsiveness. Multithreading is particularly useful in scenarios involving complex computations, network communication, or handling user interfaces.


                <br /><br />-> 6. Generics:<br />
                Java's generic programming feature facilitates the creation of reusable and type-safe code components. Generics enable developers to define classes, interfaces, and methods that can work with different data types while providing compile-time type safety. This feature enhances code flexibility, reduces the chances of runtime errors, and promotes code reuse and maintainability.

                <div class="img__container">
                    <img class="img__content" src="../img/java-security.png" />
                </div>

                -> 7. Annotations:<br />
                Java's annotation feature allows developers to embed metadata within the source code. Annotations provide additional information to the compiler, tools, or runtime environment, enabling them to perform specific actions or generate additional code. Annotations are widely used in frameworks and libraries to configure behaviors, perform validations, and aid in code generation.


                <br /><br />-> 8. Lambda Expressions:<br />
                Introduced in Java 8, lambda expressions revolutionized the way developers write code by providing a concise and functional programming style. Lambdas enable the implementation of functional interfaces, allowing developers to write compact code snippets that are easy to read and maintain. This feature has greatly enhanced Java's expressiveness and opened doors to more streamlined and efficient programming paradigms..

                <br /><br />-> Conclusion:<br />
                Java's rich set of features has played a pivotal role in its enduring popularity and widespread adoption in the software development community. From its support for object-oriented programming to its platform independence and robust exception handling, Java provides developers with a powerful toolkit for building reliable and scalable applications. By leveraging features such as multithreading, generics, annotations, and lambda expressions, developers can unlock Java's full potential and create code that
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
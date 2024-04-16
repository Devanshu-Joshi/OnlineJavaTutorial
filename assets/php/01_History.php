<?php
if (isset($_POST['submitNext'])) {
    header("Location: 02_Features.php");
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
                <h2 class="content__h2">&#9830; History of Java</h2>
                <br />
                <p>-> Java is a high-level, object-oriented programming language that was first released by Sun Microsystems in 1995. The language was designed by James Gosling and his team, with the goal of creating a platform-independent language that could be used to develop software for a wide variety of platforms.

                    <br /><br />-> The name "Java" was chosen because it was the name of the coffee that was popular in the office at the time. Initially, Java was designed as a language for developing applications for consumer electronics devices such as televisions, set-top boxes, and personal digital assistants (PDAs).

                    <br /><br />-> The principles for creating Java programming were "Simple, Robust, Portable, Platform-independent, Secured, High Performance, Multithreaded, Architecture Neutral, Object-Oriented, Interpreted, and Dynamic". Java was developed by James Gosling, who is known as the father of Java, in 1995. James Gosling and his team members started the project in the early '90s.

                    <br /><br />-> However, Java quickly gained popularity as a language for developing web applications. One of the key reasons for its success was the development of the Java Virtual Machine (JVM), which allowed Java code to be executed on any platform that had a JVM installed. This made Java one of the first truly platform-independent programming languages.

                    <br /><br />-> In 1999, Sun Microsystems released Java 2, which included a number of new features such as the Java Development Kit (JDK) and the Java Runtime Environment (JRE). Java 2 also included a number of improvements to the language itself, including support for new data types and new language constructs.

                    <br /><br />-> it was called Oak and was developed as a part of the Green project.Why Java was named as "Oak".Java History from Oak to JavaWhy Oak? Oak is a symbol of strength and chosen as a national tree of many countries like the U.S.A., France, Germany, Romania, etc. In 1995, Oak was renamed as "Java" because it was already a trademark by Oak Technologies.

                <div class="img__container">
                    <img class="img__content" src="../img/Oak-Tree.webp" />
                </div>

                -> Why Java Programming named "Java"? Why had they chose the name Java for Java language? The team gathered to choose a new name. The suggested words were "dynamic", "revolutionary", "Silk", "jolt", "DNA", etc. They wanted something that reflected the essence of the technology: revolutionary, dynamic, lively, cool, unique, and easy to spell, and fun to say.

                <br /><br />-> In 2010, Sun Microsystems was acquired by Oracle Corporation, which took over the development of Java. Oracle has continued to release new versions of Java, with the most recent version, Java 16, released in March 2021. Java remains one of the most popular programming languages in use today, with a wide range of applications in areas such as web development, mobile app development, and enterprise software development.

                <br /><br />-> Java's popularity is due to a number of factors, including its platform independence, its strong support for object-oriented programming, its rich set of libraries and tools, and its wide adoption by the enterprise software development community.

                <br /><br />-> Java has also been used in a number of high-profile projects, including the development of the Android operating system for mobile devices. Android is built on top of a modified version of the Java programming language, and Java is still widely used in the development of Android applications.

                <br /><br />-> Another key factor in Java's success has been the development of the Java Community Process (JCP), which is responsible for developing new standards and specifications for the Java platform. The JCP is made up of a wide range of companies and individuals, and is responsible for driving the evolution of the Java platform.

                <br /><br />-> In recent years, Java has faced increasing competition from other programming languages such as Python, JavaScript, and Go. However, Java's strong support for enterprise software development and its large ecosystem of tools and libraries continue to make it a popular choice for many developers.

                <div class="img__container">
                    <img class="img__content" src="../img/History-of-java.webp" />
                </div>

                -> One of the key features of Java is its strong support for multi-threading, which allows developers to write applications that can take advantage of multi-core processors and improve performance. Java also provides robust security features, including its sandbox model that isolates running code from the host system, which makes it a popular choice for developing secure applications.

                <br /><br />-> In recent years, Oracle's management of the Java platform has come under scrutiny, with concerns raised over the company's licensing policies and its approach to managing the open-source components of the platform. However, the open-source nature of the Java ecosystem has allowed other organizations and communities to take on the development and maintenance of key components, ensuring that the platform remains viable and accessible to developers.

                <br /><br />-> Overall, Java has had a significant impact on the software development industry since its introduction in the mid-1990s. Its continued evolution and popularity suggest that it will remain an important programming language for many years to come.
                </p>
            </div>
        </div>
        <form method="post">
            <footer class="foot">
                <button type="button" style="background: gray;" name="submitPrevious" value="Previous">
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
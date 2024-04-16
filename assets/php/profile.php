<?php
if ((!array_key_exists('enc0', $_COOKIE)) || (!isset($_COOKIE['enc0']))) {
    echo '<script>alert("You Have to login first");window.location.href="login.php";</script>';
}

if (isset($_POST['logout'])) {
    echo '<script>if (confirm("Are You Want to Logout ?")) 
    {
        window.location.href="logout.php";
    }
    </script>';
}
else if(isset($_POST['delete']))
{
    echo '<script>if (confirm("Are You Want to Delete Your Account Permanently ?\nYour all Data will be deleted!"))
    {
        window.location.href="delete.php";
    }
    </script>';
}

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
// Data -> Encrypted UID ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Password

// UID Ended

$selectstatement = mysqli_prepare($con, "select * from tblmembers where uid=?");
mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
mysqli_stmt_execute($selectstatement);
$result = mysqli_stmt_get_result($selectstatement);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $encrypted_IV = $_COOKIE['enc2'];
    $stringData = $encrypted_IV;

    // Login - IV Started

    $decrypted_IV = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted IV ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Password

    // Login - IV Ended

    // Email Started

    $encrypted_Email = $_COOKIE['enc1'];
    $stringData = $encrypted_Email;
    $iv = $decrypted_IV;

    $decrypted_Email = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted Email , Private-Key -> Base Password , IV -> Random ( Cookie )

    // Email Ended

    // iv started

    $encrypted_Base_IV = $row['iv'];
    $encrypted_IV = base64_decode($encrypted_Base_IV);
    $stringData = $encrypted_IV;
    $iv = $raw_Password;
    $decrypted_IV = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted IV , Private-Key -> Base Password , IV -> Raw Password

    if ($decrypted_IV === false) {
        die("Some Unexpected Error , IV Decryption Failed");
    }

    // iv ended

    // username starts

    $encrypted_Base_Username = $row['unm'];
    $encrypted_Username = base64_decode($encrypted_Base_Username);
    $stringData = $encrypted_Username;
    $iv = $decrypted_IV;

    $decrypted_Username = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted Username , Private-Key -> Base Password , IV -> Decrypted Random IV ( From Sign-in )

    if ($decrypted_Username === false) {
        die("Some Unexpected Error , Username Decryption Failed");
    }

    // username ends

    // number starts

    $encrypted_Base_Number = $row['num'];
    $encrypted_Number = base64_decode($encrypted_Base_Number);

    $stringData = $encrypted_Number;

    $decrypted_Number = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
    // Data -> Encrypted Number , Private-Key -> Base Password , IV -> Decrypted Random IV ( From Sign-in )

    if ($decrypted_Number === false) {
        die("Some Unexpected Error , Number Decryption Failed");
    }

    // number ends

    $GLOBALS['unm'] = $decrypted_Username;
    $GLOBALS['eid'] = $decrypted_Email;
    $GLOBALS['num'] = $decrypted_Number;
}

$selectstatement = mysqli_prepare($con, "select path from `tblmembers` where uid=?");
mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
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

if (isset($_FILES['profileimg'])) {
    $fname = $_FILES['profileimg']['name'];
    $ftmp = $_FILES['profileimg']['tmp_name'];
    move_uploaded_file($ftmp, "../../uploads/" . $fname);
    echo '<script>
    window.onload = function() {
        change("' . $fname . '");
    }; 
    </script>';
    $selectstatement = mysqli_prepare($con, "update `tblmembers` set `path` = '../../uploads/" . $fname . "' where uid=?");
    mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
    mysqli_stmt_execute($selectstatement);
}

?>

<script>
    function remove() {
        var img = document.getElementById("imgdisplay");
        let currentUrl = window.location.href;
        let length = currentUrl.length;
        let url = currentUrl.substring(0, length - 15);
        if (img.src != url + "img/Default.png") {
            if (confirm("Are You Want to Remove Your Profile Picture ?")) {
                img.src = "../img/Default.png";
                window.location.href = "image.php"
            }
        } else {
            return false;
        }
    }

    function change(file) {
        img = document.getElementById("imgdisplay");
        img.src = "../../uploads/" + file;
    }

    function defaultimg() {
        var img = document.getElementById("imgdisplay");
        img.src = "../img/Default.png";
    }

    function customimg(path) {
        var img = document.getElementById("imgdisplay");
        img.src = path;
    }
</script>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="../css/profile.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/utils.css">
    <title>Profile Page</title>
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
                        <li class="navigation"><a href="Quiz.php">Quiz</a></li>
                        <li class="navigation"><a href="">About-Us</a></li>
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
                    <a class="modalContainer__links" href="Quiz.php">Quiz</a>
                    <a class="modalContainer__links" href="">About-Us</a>
                </div>
            </dialog>
        </nav>
        <div class="profileContainer">
            <div class="container">
                <h1>Profile</h1>
                <form id="form" method="post" enctype="multipart/form-data">
                    <div class="pic">
                        <img id="imgdisplay" title="Click To Remove" onclick="return remove()" />
                    </div>
                    <div class="upload">
                        <input type="file" name="profileimg" id="profileimg" accept="image/png, image/jpeg" onchange="form.submit()" />
                        <label for="profileimg" title="Click to Change Your Profile Image" id="file"><i id="icon" class='bx bx-upload'></i> Change</label>
                    </div>
                </form>
                <div class="content">
                    <label>Username : </label>
                    <input type="text" id="unm" class="textLabel" value="<?php echo $unm; ?>" readonly required>
                    <label class="content__edit" data-id="unm">Edit</label>

                    <label>E-Mail : </label>
                    <input type="email" id="eid" class="textLabel" value="<?php echo $eid; ?>" readonly required>
                    <label class="content__edit" data-id="eid">Edit</label>

                    <label>Number : </label>
                    <input type="number" id="num" class="textLabel" value=<?php echo $num; ?> readonly required>
                    <label class="content__edit" data-id="num">Edit</label>
                </div>
                <form method="post">
                    <div class="logout">
                        <button type="submit" name="logout">Log-Out</button>
                        <button type="submit" name="delete">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
</body>
<script src="../js/dialog.js"></script>
<script src="../js/edit.js"></script>
<?php echo '<script>adjustSize();</script>'; ?>

</html>
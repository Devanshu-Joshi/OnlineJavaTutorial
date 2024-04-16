<?php
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

    $selectstatement = mysqli_prepare($con, "update `tblmembers` set `path` = NULL where uid=?");
    mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
    mysqli_stmt_execute($selectstatement);
    header('Location: profile.php');
?>
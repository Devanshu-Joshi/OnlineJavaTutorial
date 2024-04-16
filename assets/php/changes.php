<?php
if((isset($_GET['changes']) || array_key_exists('changes',$_GET)) && ((isset($_GET['id'])) || (array_key_exists('id',$_GET))) && ((array_key_exists('enc0', $_COOKIE)) || (isset($_COOKIE['enc0']))))
{
    // echo ("Permission Granted!!!");
    $changes = $_GET['changes'];
    $md5Changes = md5($changes);
    $id = $_GET['id'];

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

    try
    {
        $con = mysqli_connect("localhost", "root", "", "javamembers");
    }
    catch(Exception $e)
    {
        echo '<script>alert("Sorry for The Inconvience\nBut Unexpectedly Our Servers are Down\nPlease Try Again Later...!!");</script>';
        die("<b><i>Connection failed Because " . mysqli_connect_error() . "</b></i><br/>Exception Occured Beacuse " . $e->getMessage());
    }

    $selectstatement = mysqli_prepare($con, "select * from tblmembers where uid=?");
    mysqli_stmt_bind_param($selectstatement, "s", $decrypted_UID);
    mysqli_stmt_execute($selectstatement);
    $result = mysqli_stmt_get_result($selectstatement);
    if (mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_assoc($result);

        if($id == "eid")
        {
            if($row[$id] != $md5Changes)
            {
                $selectstatement = mysqli_prepare($con, "update tblmembers set ".$id." = ? where uid=?");
                mysqli_stmt_bind_param($selectstatement, "ss", $md5Changes , $decrypted_UID);
                mysqli_stmt_execute($selectstatement);
                $result = mysqli_stmt_get_result($selectstatement);

                $encrypted_IV = $_COOKIE['enc2'];
                $stringData = $encrypted_IV;
                $iv = $raw_Password;

                // Login - IV Started

                $decrypted_IV = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
                // Data -> Encrypted IV ( Login - Cookie ) , Private-Key -> Base Password , IV -> Raw Password

                // Login - IV Ended

                // Email Started 

                $iv = $decrypted_IV;
                $data = $changes;

                $encrypted_Email = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
		        // Data -> Email , Private-Key -> Base Password , IV -> Random ( Cookie )

                // Email Ended

                setcookie("enc1",$encrypted_Email, time() + (86400 * 30), "/", "" , true); // 86400 = 1 day

                header("location:profile.php");

            }
            else
            {
                header("location:profile.php");
            }
        }
        else
        {
            // IV Started

            $encrypted_Base_IV = $row['iv'];
            $encrypted_IV = base64_decode($encrypted_Base_IV);
            $stringData = $encrypted_IV;
            $iv = $raw_Password;
            $decrypted_IV = openssl_decrypt($stringData, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
            // Data -> Encrypted IV , Private-Key -> Base Password , IV -> Raw Password
        
            if($decrypted_IV === false)
            {
                die("Some Unexpected Error , IV Decryption Failed");
            }        

            // IV Ended


            // Data started
            $iv = $decrypted_IV;
		    $data = $changes;
		    $encrypted_Data = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv); 
            // Data -> Username/Number , Private-Key -> Base Password , IV -> Random
            $encrypted_Base_Data = base64_encode($encrypted_Data);

            // Data ended

            if($row[$id] != $encrypted_Base_Data)
            {
                $selectstatement = mysqli_prepare($con, "update tblmembers set ".$id." = ? where uid=?");
                mysqli_stmt_bind_param($selectstatement, "ss", $encrypted_Base_Data , $decrypted_UID);
                mysqli_stmt_execute($selectstatement);
                $result = mysqli_stmt_get_result($selectstatement);
                header("location:profile.php");
            }
            else
            {
                header("location:profile.php");
            }
        }
        
    }

}
else
{
    echo '<script>alert("Perimission Not Granted!");window.location.href="../../";</script>';
}
?>
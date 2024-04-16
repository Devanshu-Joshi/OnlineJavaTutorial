    <?php
    if (isset($_COOKIE['pr3']) && isset($_COOKIE['sec2'])) {
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "javamembers";

        try {
            $con = mysqli_connect($server, $username, $password, $database);
        } catch (Exception $e) {
            echo '<script>alert("Sorry for The Inconvience\nBut Unexpectedly Our Servers are Down\nPlease Try Again Later...!!");</script>';
            die("<b><i>Connection failed Because " . mysqli_connect_error() . "</b></i><br/>Exception Occured Beacuse " . $e->getMessage());
        }

        $encrypted_email = $_COOKIE['pr2'];
        $encrypted_unm = $_COOKIE['pr1'];
        $encrypted_num = $_COOKIE['pr4'];
        $encrypted_pwd = $_COOKIE['pr3'];
        $privateKey = $_COOKIE['sec2'];
        $cipher = 'aes-256-cbc';
        $iv = $_COOKIE['sec3'];

        // ---- Decrypting ----

        // Username Started

            $data = $encrypted_unm;
            $decrypted_unm = openssl_decrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
            // Data -> Username , Private-Key -> Hash Password , IV -> Raw Password

        // Username Ended

        // Email Started

            $data = $encrypted_email;
            $decrypted_email = openssl_decrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
            // Data -> Email , Private-Key -> Hash Password , IV -> Raw Password

        // Email Ended

        // Password Started

            $data = $encrypted_pwd;
            $decrypted_pwd = openssl_decrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
            // Data -> Password , Private-Key -> Hash Password , IV -> Raw Password

        // Password Ended

        // Number Started

            $data = $encrypted_num;
            $decrypted_num = openssl_decrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
            // Data -> Number , Private-Key -> Hash Password , IV -> Raw Password

        // Number Ended

        $hash_Email = md5($decrypted_email);
        $raw_Password = md5($decrypted_pwd, true);
        $base_Password = base64_encode($raw_Password);

        // ---- Encrypting ----
        
        $privateKey = $base_Password;
        $cipher = 'aes-256-cbc';
        $iv = openssl_random_pseudo_bytes(16);

        // username

        $data = $decrypted_unm;
        $encrypted_Username = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
        // Data -> Username , Private-Key -> Base Password , IV -> Random
        $encrypted_Base_Username = base64_encode($encrypted_Username);

        // username ended

        // number

        $data = $decrypted_num;
        $encrypted_Number = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
        // Data -> Number , Private-Key -> Base Password , IV -> Random
        $encrypted_Base_Number = base64_encode($encrypted_Number);

        // number ended

        // iv

        $data = $iv;
        $iv = $raw_Password;
        $encrypted_IV = openssl_encrypt($data, $cipher, $privateKey, OPENSSL_RAW_DATA, $iv);
        // Data -> Random IV , Private-Key -> Base Password , IV -> Raw Password
        $encrypted_Base_IV = base64_encode($encrypted_IV);

        // iv ended

        $selectstatement = mysqli_prepare($con, "select * from tblmembers where eid=?");
        mysqli_stmt_bind_param($selectstatement, 's', $hash_Email);
        mysqli_stmt_execute($selectstatement);
        $result = mysqli_stmt_get_result($selectstatement);
        if (mysqli_num_rows($result) == 1) {
            mysqli_close($con);
            echo '<script>alert("E-Mail Already Registered");window.location.href="../html/SignUp.html";</script>';
            $unm1 = "";
            $pwd1 = "";
        } else {
            $sql = "INSERT INTO javamembers.tblmembers(unm, eid, num, pwd, iv) VALUES ('$encrypted_Base_Username', '$hash_Email', '$encrypted_Base_Number', '$base_Password', '$encrypted_Base_IV')";

            if ($con->query($sql)) {
                echo '<script>window.location.href = "Login.php";</script>';
            } else {
                echo '<script>alert("Unexpected Error Occured! Please , Try Again...");';
            }
        }
    }
    else
    {
        echo '<script>alert("Some Internal Error , Please Try Again");</script>';
    }
    ?>





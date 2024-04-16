<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Online Java Tutorial</title>
</head>

<body>
    <script src="script.js"></script>
    <form name="myform" action="index.php" method="post" onsubmit="return validate();">
        <div class="Container">
            <div class="Heading">
                <p>Registration Form</p>
            </div>
            <div>
                <table class="Controls">
                    <tr>
                        <td class="Main">
                            <p>First Name :</p>
                        </td>
                        <td class="Main">
                            <input type="text" id="txtfnm" name="txtfnm" placeholder=" Enter Your First Name" required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>Middle Name :</p>
                        </td>
                        <td class="Main">
                            <input type="text" id="txtmnm" name="txtmnm" placeholder=" Enter Your Middle Name" required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>Last Name :</p>
                        </td>
                        <td class="Main">
                            <input type="text" id="txtlnm" name="txtlnm" placeholder=" Enter Your Last Name" required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>Date of Birth :</p>
                        </td>
                        <td class="Main">
                            <input type="date" id="txtdob" name="txtdob" placeholder=" Enter Your Date-Of-Birth"
                                required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>E-Mail ID :</p>
                        </td>
                        <td class="Main">
                            <input type="email" id="txteid" name="txteid" placeholder=" Enter Your E-Mail" required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>Mobile Number :</p>
                        </td>
                        <td class="Main">
                            <input type="text" id="txtnum" name="txtnum" placeholder=" Enter Your Mobile Number"
                                required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>Qualification :</p>
                        </td>
                        <td class="Main">
                            <input type="text" id="txtqlf" name="txtqlf" placeholder=" Enter Your Qualification">
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>University :</p>
                        </td>
                        <td class="Main">
                            <input type="text" id="txtuni" name="txtuni" placeholder=" Enter Your Universiry">
                        </td>
                    </tr>
                </table>
                <hr />
                <table class="User">
                    <tr>
                        <td class="Main">
                            <p>UserName :</p>
                        </td>
                        <td class="Main">
                            <input type="text" id="txtusr" name="txtusr" placeholder=" Enter Your User-Name" required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                    <tr>
                        <td class="Main">
                            <p>Password :</p>
                        </td>
                        <td class="Main">
                            <input type="password" id="txtpsw" name="txtpsw" placeholder=" Enter Your Password" required>
                        </td>
                        <td class="req">
                            *
                        </td>
                    </tr>
                </table>
                <div class="submitc">
                    <input type="submit" id="btnSubmit" name="submit" />
                </div>
            </div>
        </div>
    </form>
</body>

</html>

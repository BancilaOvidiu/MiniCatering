<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="./css/signup1.css" />
    <title>Create an account</title>
</head>

<body>

    <?php

    $user = $pass = $confpass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = test_input($_POST["user"]);
        $pass = test_input($_POST["pass"]);
        $confpass = test_input($_POST["confpass"]);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "catering";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn)
            die("Eroare la conectare: " . mysqli_connect_error());


        if ($pass == $confpass) {

            $sql1 = "Select * from Utilizatori WHERE Username='$user' ";
            $result = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result) == 0) {

                $sql = "INSERT INTO utilizatori (Username, Parola, Admin)
                        VALUES ('$user','$pass',0)";

                if (mysqli_query($conn, $sql))
                    echo '
                        <script type="text/javascript">
                            window.onload = function () {
                                alert("User added!");
                            }</script>';
                else
                    echo '
                        <script type="text/javascript">
                            window.onload = function () {
                                alert("ERROR");
                            }</script>';
            } else
                echo "<script type='text/javascript'>alert('Username already taken');</script>";
        } else
            echo "
                    <script type='text/javascript'>alert('The Password do not match');</script>";

        mysqli_close($conn);
    }




    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>



    <div id="sign">
        <h2>Create an account</h2>
        <form method="post">
            <input type="text" placeholder="Username" name="user" pattern="\S{5,}" oninvalid="setCustomValidity('Username need to have at least 5 characters!')" oninput="setCustomValidity('')" required />
            <input type="password" placeholder="Create a new password" name="pass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$" oninvalid="setCustomValidity('The password must have at least one small letter, one capital letter and one number! (minimum 6 characters)')" oninput="setCustomValidity('')" required />
            <input type="password" placeholder="Confirm the new password" name="confpass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$" oninvalid="setCustomValidity('The password must have at least one small letter, one capital letter and one number! (minimum 6 characters)')" oninput="setCustomValidity('')" required />
            <input type="submit" value="Sign up" />
            <input type="button" value="Return to the previous menu" onclick="window.location.href='index.html'" />
        </form>
    </div>


</body>

</html>
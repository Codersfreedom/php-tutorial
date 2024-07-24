<?php
require '../config/db.php';
$login = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>

<body>
    
    <div
        style="display:flex;  margin: 50px auto; height: 100vh; width: 100vw; justify-content: center; align-items: center; ">

        <form action='login.php' method="post" style="height: fit-content;">

            <input type="email" name="email" placeholder="Enter your email"><br>
            <input type="password" name="password"><br>
            <button type="submit">Submit</button>



        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $existingEmail = "Select *from student where email ='$email'";
        $existingResult = mysqli_query($conn, $existingEmail);
        $row = mysqli_fetch_assoc($existingResult);
        if (!$existingResult) {
            $error = "user doesn't exists!";
            header("location:login.php?log=$error");
        }

        $decode_password = password_verify($password, $row['password']);
        if (!$decode_password) {
            $error = "Password doesn't match!";
            header("location:login.php?log=$error");
            exit();
        }

        $login = true;
        session_start();
        $_SESSION['logedin'] = true;
        $_SESSION['username'] = $row['name'];
        header("location:home.php");

        if ($login) {
            echo " <h2> " . $_SESSION["username"] . "  </h2>";
        }



    }

    ?>

</body>

</html>
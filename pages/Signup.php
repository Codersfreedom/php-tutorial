<?php 
    require '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
</head>
<body>
    <div style="display:flex; margin: 50px auto; height: 100vh; width: 100vw; justify-content: center; align-items: center; " >
        
            <form action='Signup.php' method="post" style="height: fit-content;" >
                <input type="text" name="name" placeholder="Enter your name"> <br>
                <input type="email" name="email" placeholder="Enter your email"><br>
                <input type="password" name="password"><br>
                <button type="submit">Submit</button>


            </form>
       
    </div>

    <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $existingEmail = "Select *from student where email ='$email'";
            $existingResult = mysqli_query($conn,$existingEmail);
            $num = mysqli_num_rows($existingResult);
            
            if($num >0){
                $error = "user already exists!";
                header("location:Singup.php?log=$error");
            }

            $hashed_password = password_hash($password,PASSWORD_DEFAULT);

            $insertSql = "INSERT INTO `student`(`name`, `email`,`password`) VALUES ('$name','$email','$hashed_password')";
            $result = mysqli_query($conn,$insertSql);
        }

?>

</body>
</html>
<?php
require '../config/db.php';
session_start();
if (!isset($_SESSION['logedin'])) {
    header("location:login.php");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>


<body style="overflow-x:hidden;">
    <header style="display:flex; justify-content:space-between; align-items: center;  padding:5px 10px; ">

        <h2>Welcome to Todo list app</h2>
        <button
                style="font-size:1rem; padding:8px 15px;cursor:pointer;  border-radius:5px;"><a style="text-decoration:none;color:black;" href="logout.php">Logout</a></button>
    </header>

    <div
        style="display:flex; height:100vh; width:100vw; flex-direction:column; justify-content: center; align-items: center; ">

        <form action="home.php" method="post" style="width:50%; display: flex; justify-content: center;  ">
            <input type="text" name="todo" placeholder="Add your task"
                style="width:100%; height:25px; border-radius:5px  ; padding:2px 5px;">
            <button type="submit"
                style="padding:2px 15px; border-radius:5px font-size:1.2rem; cursor:pointer;">Add</button>
        </form>


        <div style=" display:flex; height:50%; width:50%; overflow-y:auto;">
    
            <ul style="font-size:1.5rem; display:flex; flex-direction:column; gap:10px; ">
                <?php

                $sql = "select *from todo";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                        <li style='display:flex; gap:10px'> " . $row['todo'] . "   <button style='padding:5px 10px; border-radius:5px font-size:1.2rem; cursor:pointer;'> <a href='home.php?updateid=".$row['id']."' style='text-decoration:none; color:black; '>Update</a></button> <button type='submit' style='padding:5px 10px; border-radius:5px font-size:1.2rem; cursor:pointer;' > <a style='text-decoration:none; color:black; ' href='home.php?deleteid=".$row['id']."'>Delete</a> </button>   </li>
                        ";
                }
                ?>



            </ul>

        </div>



    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['todo'])) {
            $todo = $_POST['todo'];

            $sql = "Insert into todo(todo) values('$todo')";
            $result = mysqli_query($conn, $sql);
            if($result){
                header("location:home.php");
            }
        }


    }

    if (isset($_GET['deleteid'])) {
        
        $deleteId = $_GET['deleteid'];
         

       
        $sql = "delete from todo where id=$deleteId ";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location:home.php");
        }

    } 



    ?>
</body>

</html>
<?php
require('../config/config.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $user_role = ($_POST ['user_role']);

    if ($name != "" && $email != "" && $username != "" && $password!= "" && $user_role!= "") {
        $select =  "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
        $result = mysqli_query($con, $select); 
        if ($result -> num_rows > 0){
            echo "Username or Email already exists";
            header("Refresh:2; URL=../register.php");

        } else{
            $insert="INSERT INTO users(name, email, username, password, user_role)
            VALUES('$name', '$email', '$username', '$password','$user_role')";
            $result=mysqli_query($con, $insert);
    
            if($result){
                header("Refresh:0; URL=../index.php?success");
            }
            else{
                header("Refresh:0; URL=../register.php?error");
            }
        }

        // $insert= $con->query("INSERT INTO users(name, email,  username, password, user_role)
        // VALUES('$name', '$email', '$username','$password', '$user_role')");
    } else {

        header("Refresh:0; URL=../register.php?empty");
    }
}

?>

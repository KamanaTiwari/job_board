<?php
require("../config/config.php");

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username != "" && $password != ""){
        $select = "SELECT * FROM users WHERE username = '$username' AND password = md5('$password')";
        $result = mysqli_query($con, $select);
        if ($result->num_rows > 0){
            $data = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['user_role'] = $data['user_role'];

            // Redirect based on role
            if ($data['user_role'] == 'admin') {
                header("Refresh:0; url=../admin/dashboard.php?success");
            } else if ($data['user_role'] == 'user') {
                header("Refresh:0; url=../../job_details.php?success");
            } else {
                header("Refresh:0; url=../index.php?error=invalid_role");
            }
        } else {
            header("Refresh:0; url=../index.php?error");
        }
    } else {
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=../index.php?empty\">";
    }
}
?>

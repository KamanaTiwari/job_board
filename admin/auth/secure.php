<?php
session_start();
if(isset($_SESSION['username'])){

}else{
    header("Location:admin/index.php");
}
 ?>
<?php 
require_once 'config.php';

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT `id`,`nama`,`roles`,`password` FROM user
            WHERE `username`='$username'";

  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
  if(!empty($data) && password_verify($password, $data['password'])){
    session_start();
    $_SESSION["id"] = $data['id'];
    $_SESSION["nama"] = $data['nama'];
    $_SESSION["role"] = $data['roles'];

    //cek remember me
    if($_POST['remember'] == "remember"){
      //set cookie
      setcookie('id', $data['id'], time()+3600, '/');
      setcookie('nama', $data['nama'], time()+3600, '/');
      setcookie('role', $data['roles'], time()+3600, '/');
    }

    header("location: /admin/dashboard.php");
  }
}
?>
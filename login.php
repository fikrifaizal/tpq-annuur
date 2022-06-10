<?php 
require_once 'config.php';
session_start();

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $query = "SELECT `nama`, `roles` FROM user
            WHERE `username`='$username' AND `password`='$password'";

  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
  if(!empty($data)){
    $_SESSION["nama"] = $data['nama'];
    $_SESSION["role"] = $data['roles'];

    //set cookie
    setcookie('nama', $data['nama'], time()+3600, '/');
    setcookie('role', $data['roles'], time()+3600, '/');

    header("location: admin/index.php");
  }
}
?>
    
<body>
  <div class="wrapper">
    <div class="text-center mt-4 name">Masjid An-Nuur Minomartani</div>
    <form class="p-3 mt-3" method="post">
      <div class="form-field d-flex align-items-center">
        <span class="far fa-user"></span>
        <input type="text" name="username" id="username" placeholder="Username"/>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" name="password" id="pwd" placeholder="Password"/>
      </div>
      <button class="btn mt-3" type="submit" name="login">Login</button>
    </form>
  </div>
</body>
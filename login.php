<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require('user.php');

if (isset($_POST["email"]) && isset($_POST["password"])) {
  $email = $_POST["email"];
  $pass  = $_POST["password"];

  $user = User::selectByLoginAndPassword($email, $pass);

  if(strcmp($user->getEmail(),"") == 0 ||  strcmp($user->getEmail(),$email) != 0){
    $_SESSION['msg']['reg-err'] = "Wrong username or password";
    header('Location: index.php');
    exit();
  }else{
    $var_user = get_object_vars($user);
    $_SESSION["user"] =  $var_user;
    header('Location: info.php');
    exit();
  }
} else {
  header('Location: index.php');
  exit();
}
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include_once 'header.php';

$user = $_SESSION["user"];

if($user["email"] != ""){
  header('Location: videos.php');
  exit();
}
?>

<body>
  <div class="container">
    <br><br><br><br><br>

    <div class="row">
      <form class="form-signin" method="post" action="login.php">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">

            <h2 class="form-signin-heading">Please sign in</h2>
            <?php
            if ($_SESSION['msg']['reg-err']) {
              echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg']['reg-err'] . '</div>';
              unset($_SESSION['msg']['reg-err']);
              // This will output the registration errors, if any
            }

            if ($_SESSION['msg']['reg-success']) {
              echo '<div class="alert alert-success" role="alert">' . $_SESSION['msg']['reg-success'] . '</div>';
              unset($_SESSION['msg']['reg-success']);
              // This will output the registration success message
            }
            ?>
            <div class="input-group input-group-lg">
              <span class="input-group-addon" id="sizing-addon1">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
              </span>
              <input type="email" id="email" name="email" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
            </div>
            <div class="input-group input-group-lg">
              <span class="input-group-addon" id="sizing-addon1">
                <span class="glyphicon glyphicon-lock"></span>
              </span>
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon1">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-2">
            <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-lg btn-primary btn-block" onclick="window.location = 'newUser.php';
            return false;">New User</button>
          </div>
        </div>
      </form>
    </div>
  </div> <!-- /container -->
</body>
</html>

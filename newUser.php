<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

    <?php include_once 'header.php'; ?>

    <body>

        <div class="container">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form class="form-signin" method="post" action="criarUsuario.php">
                    <h2 class="form-signin-heading">New User</h2>
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
                    ?><br><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </span>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" aria-describedby="sizing-addon1">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                        </span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1">
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                        <input type="password" id="password1" name="password1" class="form-control" placeholder="Password" aria-describedby="sizing-addon1">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1">
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                        <input type="password" id="password2" name="password2" class="form-control" placeholder="Confirm Password" aria-describedby="sizing-addon1">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" name="type" value="0"> 
                            </span>
                            <input type="text" class="form-control" placeholder="Undergraduate Student" disabled>
                    </div>
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" name="type" value="1"> 
                            </span>
                            <input type="text" class="form-control" placeholder="Master degree Student" disabled>
                    </div>
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" name="type" value="2"> 
                            </span>
                            <input type="text" class="form-control" placeholder="Phd Student" disabled>
                    </div>
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" name="type" value="3"> 
                            </span>
                            <input type="text" class="form-control" placeholder="Professor" disabled>
                    </div>
                    <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" name="type" value="4" checked> 
                            </span>
                            <input type="text" class="form-control" placeholder="Other" disabled>
                    </div>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div> <!-- /container -->
    </body>
</html>


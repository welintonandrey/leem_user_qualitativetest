<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["user"])) {
  header('Location: index.php');
  exit();
}

$user = $_SESSION["user"];

require_once 'testeUsuario.php';
require_once 'videoFiltrados.php';
require_once 'videoOriginal.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once 'header.php'; ?>

<body>
  <br><br><br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-12"></div>
    </div>
    <div class="row">
      <center>
        <h1>LEEM Denoising/Deblur Visual Evaluation</h1>
      </center>
    </div>
    <hr><br>

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

    $tu = testeUsuario::selectCurrentTest($user["email"]);
    if($tu->getId() != ""){
    ?>

    <center>
      <div class="row">
        <div class="col-xs-6 col-md-6 col-md-offset-3">
          <div class="thumbnail">
            <div class="caption">
              <h3>Original Video</h3>
            </div>
            <div class="embed-responsive embed-responsive-4by3">
              <video controls poster="">
                <source src="<?php echo videoOriginal::selectById($tu->getVOriginal())->getUrl(); ?>" type="video/mp4">
              </video>
            </div>
          </div>
        </div>
      </div>
    </center>
    <br><hr>
    <center>
      <div style="font-size: 20px;">
        Progress: Test <?php echo (testeUsuario::selectTotalAnswerTestUser($user["email"])+1); ?>
        of <?php echo testeUsuario::selectTotalTestUser($user["email"]); ?>.
      </div>
      <hr><br>
      <div class="row">

          <form class="form-video" method="post" action="saveCaseTest.php">
            <div class="input-group" style="width:100%;">
              <input type="hidden" name="caseTestId" value="<?php echo($tu->getId()); ?>">
              <div class="col-xs-6 col-md-6">
                <div class="thumbnail">
                  <span class="input-group-addon">
                    <input type="radio" name="video" value="<?php echo $tu->getV1(); ?>">
                  </span>
                  <div class="embed-responsive embed-responsive-4by3">
                    <video controls poster="">
                      <source src="<?php echo videoFiltrados::selectById($tu->getV1())->getUrl(); ?>" type="video/mp4">
                        <!--source src="https://s3-us-west-2.amazonaws.com/videoswelinton/BoronSi-Bilateral_CLSF.mp4" type="video/mp4"-->
                      </video>
                    </div>
                    <div class="caption">
                      <center><h3>Video 1</h3></center>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="thumbnail">
                    <span class="input-group-addon">
                      <input type="radio" name="video" value="<?php echo $tu->getV2(); ?>">
                    </span>
                    <div class="embed-responsive embed-responsive-4by3">
                      <video controls poster="">
                        <source src="<?php echo videoFiltrados::selectById($tu->getV2())->getUrl(); ?>" type="video/mp4">
                        </video>
                      </div>
                      <div class="caption">
                        <center><h3>Video 2</h3></center>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6 col-md-6">
                    <div class="thumbnail">
                      <span class="input-group-addon">
                        <input type="radio" name="video" value="<?php echo $tu->getV3(); ?>">
                      </span>
                      <div class="embed-responsive embed-responsive-4by3">
                        <video controls poster="">
                          <source src="<?php echo videoFiltrados::selectById($tu->getV3())->getUrl(); ?>" type="video/mp4">
                          </video>
                        </div>
                        <div class="caption">
                          <center><h3>Video 3</h3></center>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-6 col-md-6">
                      <div class="thumbnail">
                        <span class="input-group-addon">
                          <input type="radio" name="video" value="<?php echo $tu->getV4(); ?>">
                        </span>
                        <div class="embed-responsive embed-responsive-4by3">
                          <video controls poster="">
                            <source src="<?php echo videoFiltrados::selectById($tu->getV4())->getUrl(); ?>" type="video/mp4">
                            </video>
                          </div>
                          <div class="caption">
                            <center><h3>Video 4</h3></center>
                          </div>
                        </div>
                      </div>

                    </div>
                    <br>
                    <div class="col-md-4 col-md-offset-4">
                      <button class="btn btn-lg btn-success btn-block" type="submit">Next</button>
                    </div>
                  </form>
                  <?php
                } else {
                  ?>
                  <div class="row">
                    <center>
                      <div style="font-size: 25px">
                        Thank you for your help.
                      </div>
                      You have answered all the tests.
                    </center>
                  </div>
                  <?php
                }
                ?>
              </div>
            </center>

            <br><br>
          </div> <!-- /container -->
        </body>
        </html>

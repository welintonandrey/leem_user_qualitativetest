<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once 'header.php'; ?>

<body>
  <br><br><br><br>
  <div class="container">
    <div class="row">
      <center>
        <h1>Information</h1>
      </center>
    </div>
    <br>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <p class="text-justify">
          This website aims at obtaining user feedback regarding the performance
          of 3 deblur and 4 denoising methods when applied to LEEM (Low Energy
          Electron Microscopy) videos. In our experiments, we combined these deblur
          and denoising techniques in a way that we obtained 16 different restoration
          results.
        </p>
        <p class="text-justify">
          For each LEEM video, 16 combinations are evaluated in a 5 step process.
          In the first four steps, the user is presented with 4 different restoration
          results and they have to choose the best result among these 4 videos. In the
          last step, the user is presented with the videos that they selected in previous
          steps and they have to select the best one among them.
        </p>
        <br>
        <p class="text-justify">
          In order to avoid any type of bias, the names of the techniques are omitted
          and the order that the videos are displayed is random.
        </p>
        <br>
        <p class="text-justify">
          The user can leave the system at any time and come back to it without
          having to start the test from the beginning.
        </p>
        <br><br>
      </div>

      <?php

      $user = $_SESSION["user"];
      require_once 'testeUsuario.php';

      if (isset($_SESSION["user"])) {
      ?>
      <div class="row">
        <div class="col-md-2 col-md-offset-5">

          <?php
          $awsTest = testeUsuario::selectTotalAnswerTestUser($user["email"]);
          if ($awsTest == 0){
          ?>
            <a class="btn btn-large btn-info btn-block" href="videos.php">Start Test</a>
          <?php
          }
          else{
            ?>
              <a class="btn btn-large btn-success btn-block" href="videos.php">Continue Test</a>
            <?php
          }
          ?>

        </div>
      </div>
      <?php
      }
      ?>
    </div>



  </div> <!-- /container -->
</body>
</html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="Sistema para escolha de videos v1.0">
  <meta name="author" content="Welinton">
  <link rel="icon" href="../../favicon.ico">

  <title>LEEM Denoising/Deblur Visual Evaluation</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.min.js"></script>

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-76042263-1', 'auto');
  ga('send', 'pageview');

  </script>
  <style>
  header.float-header{
    position:fixed;
    background-image: -webkit-linear-gradient(top,#337ab7 0,#265a88 100%);
    background-image: -o-linear-gradient(top,#337ab7 0,#265a88 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,from(#337ab7),to(#265a88));
    background-image: linear-gradient(to bottom,#337ab7 0,#265a88 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7', endColorstr='#ff265a88', GradientType=0);
    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
    background-repeat: repeat-x;
    border-color: #245580;
    width:100%;
    top:0;
    z-index: 10;
  }
  .float-header h1{
    display: inline-block;
    font-style:italic;
    margin-left:45px;
  }
  .logo{
    height: 80px;
  }
  .icons-menu{
    position: absolute;
    top: 30%;
    right: 30px;
    display:inline-block;
    font-size: 30px;
    color: white;
    paddin: 5px
  }
  /* unvisited link */
  a:link {
    color: white;
  }
  /* visited link */
  a:visited {
    color: white;
  }
  /* mouse over link */
  a:hover {
    color: white;
  }
  /* selected link */
  a:active {
    color: white;
  }
  .text-menu{
    position: absolute;
    top: 75%;
    right: 30px;
    display:inline-block;
    font-size: 12px;
    color: white;
  }
  </style>
</head>

<?php
$user = $_SESSION["user"];
?>

<header class="float-header">
  <a href="index.php">
    <img src="/imgs/logo.svg" class="logo" onerror="this.src='/imgs/logo.png'">
  </a>
  <div class="menu">
    <div class="icons-menu">

      <a href="index.php">
        <span class="glyphicon glyphicon-user"></span>
      </a>
      <a href="info.php"  title="Information">
        <span class="glyphicon glyphicon-question-sign"></span>
      </a>

      <?php
      if($user["name"] != ""){
        ?>
        <a href="logout.php" title="Logout">
          <span class="glyphicon glyphicon-log-out"></span>
        </a>
        <?php
      }
      ?>

    </div>
    <?php
    if($user["name"] != ""){
      ?>
      <div class="text-menu">
        Hello, <?php echo $user['name']; ?>.
      </div>
      <?php
    }
    ?>

  </div>
</header>

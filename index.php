<?php
session_name('sess_theconnectedflower');
session_start();

require_once("_config/db.php");
require_once("_config/functions.php");
?>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Type"           content="text/html; charset=UTF-8">
    <meta name="viewport"                     content="width=device-width, user-scalable=no, maximum-scale=1, initial-scale=1.0, maximum-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author"                       content="Fougerolle Gabriel, Requena Lucas, Tabbara Louna">
    <meta name="description"                  content="Website for connected plants" />
    <meta name="Reply-to"                     content="">
    <meta name="Copyright"                    content="Fougerolle Gabriel, Requena Lucas, Tabbara Louna">
    <meta name="Language"                     content="English">

    <!-- Open Graph tags -->
    <meta property="og:type"                  content="website" />
    <meta property="og:url"                   content="connectedplantfrt" />
    <meta property="og:title"                 content="The Connected Flower" />
    <meta property="og:description"           content="Website for connected plants" />
    <meta property="og:image"                 content="" />

    <title>The Connected Flower</title>
    <!-- CSS Styles -->
    <link rel="shortcut icon" href="_assets/images/icons/favicon.ico" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="_assets/css/styles.css"/>
    <script src="https://unpkg.com/popper.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="_assets/js/script.js"></script>
  </head>
  <body<?= isset($_SESSION['user']) ? '' : ' class="bg-green"' ?>>
    <?php
    if(isset($_SESSION['user'])) {
      require_once('views/connected.php');
    }

    else {
      if(isset($_GET['p']) && $_GET['p'] == 'signup') { ?>
        <h1 class="pt-3 font-weight-bold text-center text-white">The Connected Flower</h1>
        <form class="w-50 m-auto text-center" action="controllers/signup.php" method="post">
          <?php if(isset($_GET['e'])) {
            $text = "";
            switch($_GET['e']) {
              case 'alreadyexists':
                $text = "Mail or username already exists.";
                break;
              case 'passmismatch':
                $text = "Passwords must be identical.";
                break;
              case 'emptyinput':
                $text = "You must fill all fields.";
                break;
              default:
                $text = "Error. Please try again.";
                break;
            } ?>
            <p class="alert alert-danger w-50 mx-auto"><?= $text ?></p>
          <?php } ?>
          <legend class="text-center text-white font-weight-bold">Sign up</legend>
          <input class="form-control mb-3" type="mail" name="mail" placeholder="example@abc.xyz">
          <input class="form-control mb-3" type="text" name="username" placeholder="example">
          <input class="form-control mb-3" type="password" name="password" placeholder="password">
          <input class="form-control mb-3" type="password" name="passwordcheck" placeholder="password">
          <button class="btn btn-outline-light d-block mx-auto font-weight-bold mb-3" type="submit">Signup</button>
          <a class="text-white" href="./">Already have an account ? Sign in</a>
        </form>
    <?php
      } else { ?>
        <h1 class="pt-3 font-weight-bold text-center text-white">The Connected Flower</h1>
        <form class="w-50 m-auto text-center" action="controllers/connect.php" method="post">
          <legend class="text-center text-white font-weight-bold">Sign in</legend>
          <input class="form-control mb-3" type="mail" name="mail" placeholder="example@abc.xyz">
          <input class="form-control mb-3" type="password" name="password" placeholder="password">
          <button class="btn btn-outline-light d-block mx-auto font-weight-bold mb-3" type="submit">Login</button>
          <a class="text-white" href="?p=signup">Not registered yet ? Create an account</a>
        </form>
      <?php }
    }
    ?>
  </body>
</html>

<nav class="navbar navbar-expand-lg navbar-dark bg-green fixed-top">
  <a class="navbar-brand font-weight-bold" href="index.php">The Connected Flower</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <div class="d-flex justify-content-between flex-wrap w-100">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?p=plants">My plants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?p=community">Community comments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?p=account">My account</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item text-white">
          <a class="nav-link" href="controllers/disconnect.php">Connected as <?= $_SESSION['user']['username'] ?> <i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid p-3 pt-4r">
  <?php
  if(isset($_GET['p']) && !empty($_GET['p'])) {
    switch($_GET['p']) {
      default:
      case 'home':
        require('connected/home.php');
        break;
      case 'plants':
        require('connected/plants.php');
        break;
      case 'community':
        require('connected/community.php');
        break;
      case 'account':
        require('connected/account.php');
        break;
      case 'addplant':
        require('connected/add_plant.php');
        break;
      case 'addcomment':
        require('connected/add_comment.php');
        break;
    }
  } else {
    require('connected/home.php');
  }
  ?>
</div>

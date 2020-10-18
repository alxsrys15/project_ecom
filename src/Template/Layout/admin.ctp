<?php 
$controller = strtolower($this->request->params['controller']);
?>
<!DOCTYPE html>
<html>
<head>
	<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-custom">
<ul class="nav nav-pills link">
      <li class="nav nav-pills"><a class="nav-link" href="#">Alex</a></li>
        <li class="nav nav-pills">
            <?= $this->Html->link('Users', ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index'], ['class' => $controller === "users" ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav nav-pills">
            <?= $this->Html->link('E-Books', ['prefix' => 'admin', 'controller' => 'Ebooks', 'action' => 'index'], ['class' => $controller === "ebooks" ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav nav-pills">
            <?= $this->Html->link('Packages', ['prefix' => 'admin', 'controller' => 'Packages', 'action' => 'index'], ['class' => $controller === "packages" ? 'nav-link active' : 'nav-link']) ?>
        </li>
        <li class="nav nav-pills">
            <?= $this->Html->link('Feeds', ['prefix' => 'admin', 'controller' => '', 'action' => 'index'], ['class' => $controller === "" ? 'nav-link active' : 'nav-link']) ?>
        </li>

    </ul>
    <ul class="nav navbar-nav ml-auto">
      <li><a class="nav-link" href="">Login</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
          User
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">logout</a>
        </div>
      </li>
    </ul>
</nav>
<main>
    <?= $this->fetch('content') ?>
</main>
    <footer>
    </footer>
</body>
</html>


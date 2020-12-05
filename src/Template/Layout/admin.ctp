<?php 
$controller = strtolower($this->request->params['controller']);
?>
<!DOCTYPE html>
<html>
<head>
	<!-- CSS -->
<title>ECOMMERCE</title>
    <!-- CSS -->
    <?= $this->Html->css('bootstrap.min') ?>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <?= $this->Html->script(['jquery.min', 'bootstrap.bundle']) ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
</head>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
                    Requests
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <?= $this->Html->link('Package Requests', ['prefix' => 'admin', 'controller' => 'PackageRequests', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                    <?= $this->Html->link('Payout Requests', ['prefix' => 'admin', 'controller' => 'PayoutRequests', 'action' => 'index'], ['class' => 'dropdown-item']) ?>
                </div>
            </li>
        </li>

    </ul>
    <ul class="nav navbar-nav ml-auto">
        <?php if (!$Auth->User()): ?>
            <li><?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => $controller === "users" ? 'nav-link active' : 'nav-link']) ?></li>
        <?php else: ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
                    User
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </li>
        <?php endif ?>
    </ul>
</nav>
<div class="container">
    
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page">
          <?php if ($this->request->params['action'] !== "index"): ?>
          <?= $this->Html->link($this->request->params['controller'], ['prefix' => 'admin', 'controller' => $this->request->params['controller'], 'action' => 'index']) ?>
          <?php else: ?>
          <?= $this->request->params['controller'] ?>
          <?php endif ?>
        </li>
        <?php if ($this->request->params['action'] !== "index"): ?>
        <li class="breadcrumb-item" aria-current="page" style="text-transform: capitalize;"><?= $this->request->params['action'] ?></li>
        <?php endif ?>
      </ol>
      
    </nav>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
    <footer>
    </footer>
</body>
</html>


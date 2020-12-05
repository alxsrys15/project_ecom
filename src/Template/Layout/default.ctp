<?php 
$controller = strtolower($this->request->params['controller']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>
        E-coins Store -
        <?= $this->fetch('title') ?>
    </title>
    <!-- CSS -->
    <?= $this->Html->css(['bootstrap.min', 'tree_maker-min']) ?>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <?= $this->Html->script(['jquery.min', 'bootstrap.min', 'https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js', 'https://cdn.jsdelivr.net/npm/sweetalert2@10', 'tree_maker-min']) ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <a href="/" class="navbar-brand">
            <?= $this->Html->image('asdasdecoins.png', ['height' => '40px']) ?>
            Ecoinstore
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?= $this->Html->link('E-Books', ['prefix' => false, 'controller' => 'EBooks', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav nav-pills">
                    <?= $this->Html->link('Market', ['prefix' => false,'controller' => 'Posts', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
            </ul>
        </div>
        <?php if (($controller == "posts" || $controller == "ebooks") && $this->request->params['action'] === "index"): ?>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="s" autocomplete="off">
            </form>
        <?php endif ?>
        <ul class="nav navbar-nav mr-auto">
            <?php if (!$Auth->User()): ?>
                <li><?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => $controller === "users" ? 'nav-link active' : 'nav-link']) ?></li>
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
                        User
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/profile">My Profile</a>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
            <?php endif ?>
        </ul>
    </nav>
    <?= $this->Flash->render() ?>
    <main>
        <?php if ($Auth->User('id') && !$Auth->User('is_active')): ?>
        <div class="alert alert-danger" role="alert" style="position: sticky;">
            Your account is inactive. Please click <a href="#!" data-toggle="modal" data-target="#activationModal">here</a> to activate your account.
        </div>
        <div class="modal fade" id="activationModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Activate account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= $this->Form->create(null, ['url' => ['prefix' => false, 'controller' => 'Users', 'action' => 'activateAccount'], 'id' => 'activate-form']) ?>
                    <div class="modal-body">
                        
                        <?= $this->Form->control('activation_code', ['class' => 'form-control', 'required', 'type' => 'text']) ?>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Activate</button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
        <?php endif ?>
        <?= $this->fetch('content') ?>
    </main>
    <footer>
    </footer>
</body>
</html>


<?php
$controller = $this->request->params['controller'];
$action = $this->request->params['action'];
?>

<div class="list-group">
    <?= $this->Html->link('My Profile', '/profile', ['class' => $controller === "Users" && $action === "profile" ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link('My Package Requests', ['prefix' => 'profile', 'controller' => 'PackageRequests'], ['class' => $controller === "PackageRequests" ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link('My Activation Codes', ['prefix' => 'profile', 'controller' => 'ActivationCodes'], ['class' => $controller === "ActivationCodes" ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action']) ?>
    <?php if ($Auth->User('is_active')): ?>
    
    <?= $this->Html->link('My Network', ['prefix' => 'profile', 'controller' => 'Users', 'action' => 'myNetwork'], ['class' => $action === "myNetwork" ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action']) ?>
    <?= $this->Html->link('My Payouts', ['prefix' => 'profile', 'controller' => 'PayoutRequests'], ['class' => $controller === "PayoutRequests" ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action']) ?>
    <?php endif ?>
</div>
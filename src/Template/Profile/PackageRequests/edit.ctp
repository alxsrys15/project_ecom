<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageRequest $packageRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $packageRequest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $packageRequest->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Package Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="packageRequests form large-9 medium-8 columns content">
    <?= $this->Form->create($packageRequest) ?>
    <fieldset>
        <legend><?= __('Edit Package Request') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('package_id', ['options' => $packages, 'empty' => true]);
            echo $this->Form->control('status_id', ['options' => $statuses, 'empty' => true]);
            echo $this->Form->control('payment_reference');
            echo $this->Form->control('payment_image');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

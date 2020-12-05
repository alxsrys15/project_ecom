<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageRequest $packageRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Package Request'), ['action' => 'edit', $packageRequest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Package Request'), ['action' => 'delete', $packageRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packageRequest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Package Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="packageRequests view large-9 medium-8 columns content">
    <h3><?= h($packageRequest->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $packageRequest->has('user') ? $this->Html->link($packageRequest->user->id, ['controller' => 'Users', 'action' => 'view', $packageRequest->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package') ?></th>
            <td><?= $packageRequest->has('package') ? $this->Html->link($packageRequest->package->name, ['controller' => 'Packages', 'action' => 'view', $packageRequest->package->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $packageRequest->has('status') ? $this->Html->link($packageRequest->status->name, ['controller' => 'Statuses', 'action' => 'view', $packageRequest->status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Reference') ?></th>
            <td><?= h($packageRequest->payment_reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Image') ?></th>
            <td><?= h($packageRequest->payment_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($packageRequest->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($packageRequest->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($packageRequest->modified) ?></td>
        </tr>
    </table>
</div>

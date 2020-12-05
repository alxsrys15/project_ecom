<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Package'), ['action' => 'edit', $package->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Package'), ['action' => 'delete', $package->id], ['confirm' => __('Are you sure you want to delete # {0}?', $package->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Packages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="packages view large-9 medium-8 columns content">
    <h3><?= h($package->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($package->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($package->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qty') ?></th>
            <td><?= $this->Number->format($package->qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($package->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($package->price) ?></td>
        </tr>
    </table>
</div>

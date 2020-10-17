<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EBook $eBook
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit E Book'), ['action' => 'edit', $eBook->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete E Book'), ['action' => 'delete', $eBook->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eBook->id)]) ?> </li>
        <li><?= $this->Html->link(__('List E Books'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New E Book'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eBooks view large-9 medium-8 columns content">
    <h3><?= h($eBook->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($eBook->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author') ?></th>
            <td><?= h($eBook->author) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year Published') ?></th>
            <td><?= h($eBook->year_published) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($eBook->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eBook->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cash Price') ?></th>
            <td><?= $this->Number->format($eBook->cash_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coins Price') ?></th>
            <td><?= $this->Number->format($eBook->coins_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($eBook->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($eBook->modified) ?></td>
        </tr>
    </table>
</div>

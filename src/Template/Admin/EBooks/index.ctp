<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EBook[]|\Cake\Collection\CollectionInterface $eBooks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New E Book'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eBooks index large-9 medium-8 columns content">
    <h3><?= __('E Books') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('author') ?></th>
                <th scope="col"><?= $this->Paginator->sort('year_published') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cash_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coins_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eBooks as $eBook): ?>
            <tr>
                <td><?= $this->Number->format($eBook->id) ?></td>
                <td><?= h($eBook->title) ?></td>
                <td><?= h($eBook->author) ?></td>
                <td><?= h($eBook->year_published) ?></td>
                <td><?= h($eBook->description) ?></td>
                <td><?= $this->Number->format($eBook->cash_price) ?></td>
                <td><?= $this->Number->format($eBook->coins_price) ?></td>
                <td><?= h($eBook->created) ?></td>
                <td><?= h($eBook->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eBook->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eBook->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eBook->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eBook->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

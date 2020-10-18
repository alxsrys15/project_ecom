<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EBook[]|\Cake\Collection\CollectionInterface $eBooks
 */
?>
<?= $this->Html->link('Add new E-Book', ['prefix' => 'admin', 'controller' => 'Ebooks', 'action' => 'add'], ['class' => 'btn btn-primary mb-3']) ?>
<div class="eBooks index large-9 medium-8 columns content">
    <h3><?= __('E Books') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Year Published</th>
                <th scope="col">Cash Price</th>
                <th scope="col">Coins Price</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eBooks as $eBook): ?>
            <tr>
                <td><?= h($eBook->title) ?></td>
                <td><?= h($eBook->author) ?></td>
                <td><?= h($eBook->year_published) ?></td>
                <td><?= $this->Number->format($eBook->cash_price) ?></td>
                <td><?= $this->Number->format($eBook->coins_price) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>', ['prefix' => 'admin', 'controller' => 'Ebooks', 'action' => 'view', $eBook->id], ['class' => 'btn btn-sm', 'escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-edit" aria-hidden="true"></i>', ['prefix' => 'admin', 'controller' => 'Ebooks', 'action' => 'edit', $eBook->id], ['class' => 'btn btn-sm', 'escape' => false]) ?>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev(__('Prev')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next')) ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

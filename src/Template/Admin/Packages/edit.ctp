<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $package->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $package->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Packages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="packages form large-9 medium-8 columns content">
    <?= $this->Form->create($package) ?>
    <fieldset>
        <legend><?= __('Edit Package') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('qty');
            echo $this->Form->control('is_active');
            echo $this->Form->control('price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

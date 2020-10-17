<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EBook $eBook
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List E Books'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="eBooks form large-9 medium-8 columns content">
    <?= $this->Form->create($eBook) ?>
    <fieldset>
        <legend><?= __('Add E Book') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('author');
            echo $this->Form->control('year_published');
            echo $this->Form->control('description');
            echo $this->Form->control('cash_price');
            echo $this->Form->control('coins_price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Comments'), ['controller' => 'PostComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Comment'), ['controller' => 'PostComments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact No') ?></th>
            <td><?= h($user->contact_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activation Token') ?></th>
            <td><?= h($user->activation_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reset Token') ?></th>
            <td><?= h($user->reset_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invite Code') ?></th>
            <td><?= h($user->invite_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coins Balance') ?></th>
            <td><?= $this->Number->format($user->coins_balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Admin') ?></th>
            <td><?= $this->Number->format($user->is_admin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($user->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recruited By') ?></th>
            <td><?= $this->Number->format($user->recruited_by) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Post Comments') ?></h4>
        <?php if (!empty($user->post_comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Post Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->post_comments as $postComments): ?>
            <tr>
                <td><?= h($postComments->id) ?></td>
                <td><?= h($postComments->post_id) ?></td>
                <td><?= h($postComments->user_id) ?></td>
                <td><?= h($postComments->comment) ?></td>
                <td><?= h($postComments->created) ?></td>
                <td><?= h($postComments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostComments', 'action' => 'view', $postComments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostComments', 'action' => 'edit', $postComments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostComments', 'action' => 'delete', $postComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postComments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Posts') ?></h4>
        <?php if (!empty($user->posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Post Images') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->posts as $posts): ?>
            <tr>
                <td><?= h($posts->id) ?></td>
                <td><?= h($posts->user_id) ?></td>
                <td><?= h($posts->post_images) ?></td>
                <td><?= h($posts->title) ?></td>
                <td><?= h($posts->price) ?></td>
                <td><?= h($posts->content) ?></td>
                <td><?= h($posts->created) ?></td>
                <td><?= h($posts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

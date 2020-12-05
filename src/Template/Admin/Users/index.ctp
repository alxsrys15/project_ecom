<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Coins</th>
                <th scope="col">Contact #</th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                
                <td><?= $this->Number->format($user->coins_balance) ?></td>
                <td><?= h($user->contact_no) ?></td>
                <td>
                   <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#resetPasswordModal" data-id="<?= $user->id ?>">Reset Password</a>
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
<div class="modal fade" id="resetPasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset user password?</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, ['action' => 'resetPassword', 'id' => 'reset-password-form']) ?>
                <?= $this->Form->control('id', ['type' => 'hidden', 'id' => 'user-id']) ?>
                <div class="input-group">
                    <input type="text" name="new_password" id="new-password" class="form-control" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-success generate-btn" type="button">Generate</button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="reset-password-form" class="btn btn-primary">Reset</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const generateString = length => {
        let result = "";
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }
    $(document).ready(function () {
        $('#resetPasswordModal').on('show.bs.modal', function (e) {
            const trigger = e.relatedTarget;
            $('#user-id').val($(trigger).data('id'));
            $('#new-password').val(generateString(8));
        });
        $('.generate-btn').on('click', function () {
            $('#new-password').val(generateString(8));
        });
    });
</script>

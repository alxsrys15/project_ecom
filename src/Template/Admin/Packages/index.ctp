<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package[]|\Cake\Collection\CollectionInterface $packages
 */
?>
<?= $this->Html->link('Add new Package', ['prefix' => 'admin', 'controller' => 'Packages', 'action' => 'add'], ['class' => 'btn btn-primary mb-3']) ?>

<div class="packages index large-9 medium-8 columns content">
    <h3><?= __('Packages') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-hoverable">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th>Activation code count</th>
                <th scope="col">Price</th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($packages as $package): ?>
            <tr>
                <td><?= $package->name ?></td>
                <td><?= $package->description ?></td>
                <td><?= $package->qty ?></td>
                <td><?= number_format($package->price, 2) ?></td>
                <td>
                    <?php if ($package->is_active): ?>
                        <?= $this->Html->link('Deactivate', ['action' => 'updatePackage', $package->id], ['class' => 'btn btn-sm btn-danger update']) ?>
                    <?php else: ?>
                        <?= $this->Html->link('Activate', ['action' => 'updatePackage', $package->id, true], ['class' => 'btn btn-sm btn-success update']) ?>
                    <?php endif ?>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('.update').on('click', function (e) {
            e.preventDefault();
            const action = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes'
            }).then(result => {
                if(result.isConfirmed) {
                    window.location.href = action;
                }
            });
        });
    });
</script>

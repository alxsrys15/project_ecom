<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageRequest[]|\Cake\Collection\CollectionInterface $packageRequests
 */
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
            <?= $this->Html->link(__('Buy Package'), ['action' => 'add'], ['class' => 'btn btn-primary mb-3']) ?></li>
            <table class="table">
                <thead>
                    <tr>
                        <td>Package</td>
                        <td>Date</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <thead>
                    <?php if (count($packageRequests) > 0): ?>
                        <?php foreach ($packageRequests as $packageRequest): ?>
                        <tr>
                            <td><?= $packageRequest->package->name ?></td>
                            <td><?= $packageRequest->created->format('Y-m-d h:i:s a') ?></td>
                            <td><?= $packageRequest->status->name ?></td>
                        </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                           <td colspan="20" align="center">No record</td> 
                        </tr>
                    <?php endif ?>
                </thead>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    
                    <?= $this->Paginator->prev('Previous') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('Next')) ?>
                    
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
            </div>
        </div>
    </div>
</div>



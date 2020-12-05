<div class="container mt-5">
	<div class="row">
		<div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
        	<?= $this->Html->link('Request payout', ['action' => 'add'], ['class' => 'btn btn-primary mb-3']) ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payoutRequests as $request): ?>
                    <tr>
                        <td><?= $request->created->format('Y-m-d h:i a') ?></td>
                        <td>P <?= number_format($request->amount, 2) ?></td>
                        <td><?= $request->status->name ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
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


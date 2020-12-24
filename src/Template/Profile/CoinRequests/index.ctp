<div class="container mt-5">
	<div class="row">
		<div class="col-sm-3">
			<?= $this->element('profile_sidebar') ?>
		</div>
		<div class="col-sm-9">
			<table class="table">
				<thead>
					<th>Date</th>
					<th>Coin Amount</th>
					<th>Status</th>
				</thead>
				<tbody>
					<?php if (count($coinRequests) > 0): ?>
						<?php foreach ($coinRequests as $request): ?>
						<tr>
							<td><?= $request->created->format('Y-m-d H:i') ?></td>
							<td><?= $request->amount ?></td>
							<td><?= $request->status->name ?></td>
						</tr>
						<?php endforeach ?>
					<?php else: ?>
					<tr>
						<td align="center" colspan="20">No records found</td>
					</tr>
					<?php endif ?>
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
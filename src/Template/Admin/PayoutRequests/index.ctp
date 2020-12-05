<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
				<thead>
					<tr>
						<th>Date</th>
						<th>User</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($payoutRequests) > 0): ?>
						<?php foreach ($payoutRequests as $request): ?>
						<tr>
							<td><?= $request->created->format('Y-m-d h:i a') ?></td>
							<td><?= $request->user->first_name . ' ' . $request->user->last_name ?></td>
							<td><?= $request->status->name ?></td>
							<td>
								<?php if ($request->status_id === 1): ?>
								<?= $this->Html->link('Accept', ['action' => 'acceptRequest', $request->id], ['class' => 'btn btn-success btn-sm accept-payout']) ?>
								<?php endif ?>
							</td>
						</tr>
						<?php endforeach ?>
					<?php else: ?>
					<tr>
						<td colspan="20">No records found</td>
					</tr>
					<?php endif ?>
				</tbody>
			</table>
			<div class="paginator">
		        <ul class="pagination">
		            <?= $this->Paginator->prev('Previous') ?>
		            <?= $this->Paginator->numbers() ?>
		            <?= $this->Paginator->next('Next') ?>
		        </ul>
		        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="paymentImageModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<?= $this->Html->image('payment_images/', ['class' => 'img-fluid payment-img mx-auto d-block']) ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('.accept-payout').on('click', function (e) {
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
<div class="container mt-5">
	<div class="row">
		<div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
        	<table class="table">
        		<thead>
        			<tr>
        				<th>Activation Code</th>
        				<th>Used?</th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php if (count($activationCodes) > 0): ?>
        				<?php foreach ($activationCodes as $code): ?>
        				<tr>
        					<td><?= $code->code ?></td>
        					<td>
        						<span style="color: <?= $code->is_used ? 'red' : 'green'; ?>"><?= $code->is_used ? 'YES' : 'NO' ?></span>
        					</td>
        				</tr>
        				<?php endforeach ?>
        			<?php else: ?>
        				<tr>
                           <td colspan="20" align="center">No record</td> 
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
<div class="container mt-5">
	<div class="row">
		<div class="col-sm-6">
			<div class="col-sm-12">
				<?php foreach ($post->images as $image): ?>
					<?= $this->Html->image('market_images/'.$image, ['class' => 'mr-3', 'style' => 'height: 100px; width: 100px']) ?>
				<?php endforeach ?>
			</div>
			<div class="col-sm-12">
				<p>Price: P <?= number_format($post->price, 2) ?></p>
				<p><?= $post->content ?></p>
			</div>
		</div>
		<div class="col-sm-6">
			<?php if ($Auth->User('is_active')): ?>
				<?= $this->Form->create(null, ['url' => ['action' => 'postComment']]) ?>
				<?= $this->Form->control('post_id', ['type' => 'hidden', 'value' => $post->id]) ?>
				<?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => $Auth->User('id')]) ?>
				<div class="col-sm-12">
					<label for="comment" class="col-form-label">Add Comment</label>
					<?= $this->Form->control('comment', ['type' => 'textarea', 'required', 'class' => 'form-control', 'label' => false]) ?>
				</div>
				<div class="col-sm-12">
					<button class="btn btn-primary mb-3" type="submit">Add comment</button>
				</div>
				<?= $this->Form->end() ?>
			<?php endif ?>
			<?php foreach ($post_comments as $comment): ?>
				<div class="media">
					<?= $this->Html->image('profile_images/'.$comment->user->avatar_image, ['class' => 'mr-3', 'style' => 'height: 64px; width: 64px']) ?>
	  				<div class="media-body">
	    				<h5 class="mt-0"><?= $comment->user->first_name . ' ' . $comment->last_name ?></h5>
	    				<small><?= $comment->created->format('Y-m-d h:i a') ?></small>
	    				<p>
	    					<?= $comment->comment ?>
	    				</p>
	  				</div>
				</div>
			<?php endforeach ?>
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
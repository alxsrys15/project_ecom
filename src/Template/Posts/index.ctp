

<style type="text/css">
	.card{
		-moz-box-shadow:    inset 0 0 15px #D3D3D3;
   		-webkit-box-shadow: inset 0 0 15px #D3D3D3;
		box-shadow:          0 0 15px #D3D3D3;
	}
	.image{
		margin-top: 25%;
		height: auto;
	}
	IMG.image{
		display: block;
    	margin-left: auto;
    	margin-right: auto;
    	border: 1px solid #ddd;
  		border-radius: 4px;
    	box-shadow: 0 0 15px #D3D3D3; 
	}
	.header{
		position: absolute;
		left: 0;
		background-color: #007bff;
		padding-right:5px;
		width: 100%;
	}
</style>
<div class="container mt-3">
	<?php if ($Auth->User('is_active')): ?>
		<?= $this->Html->link('Add Post', ['controller' => 'Posts', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
	<?php endif ?>
	<?php if (count($posts) > 0): ?>
		<div class="row row-cols-3 row-cols-md-3">
			<?php foreach ($posts as $post): ?>
			<?php $user_avatar = $post->user->avatar_image ? 'profile_images/'.$post->user->avatar_image : 'default_profile.png'  ?>
			<div class="col mb-4">
				<div class="card">
					<div class="header col-12 p-2">
						<?= $this->Html->image($user_avatar, ['style' => ['height: 30px; width: 30px']]) ?>
						<label><?= $post->user->first_name . ' ' . $post->user->last_name ?></label>
					</div>
					<?= $this->Html->image('market_images/'.$post->images[0], ['class' => 'image rounded', 'style' => ['height: 200px; width: 200px']]) ?>
					
					<div class="card-body">
						<h5 class="card-title"><?= $post->title ?></h5>
						<p class="card-text">P <?= number_format($post->price, 2) ?></p>
						<?= $this->Html->link('View', ['action' => 'view', $post->id], ['class' => 'btn btn-primary']) ?>
					</div>
					<div class="card-footer text-muted">
	    				<?= $post->created->timeAgoInWords() ?>
	  				</div>
				</div>
			</div>
		<?php endforeach ?>
		</div>
		<div class="paginator">
	        <ul class="pagination">
	            <?= $this->Paginator->prev('Previous') ?>
	            <?= $this->Paginator->numbers() ?>
	            <?= $this->Paginator->next(__('Next')) ?>
	        </ul>
	    </div>
	<?php else: ?>
		<div class="row">
			<div class="col-sm-12">
				<p class="text-center">No post found</p>
			</div>
		</div>
	<?php endif ?>
	
</div>
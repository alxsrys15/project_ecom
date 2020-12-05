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
		background-color: lightblue;
		padding-right:5px;
		width: 100%;
	}
</style>
<div class="container mt-5">
	<?php if (count($eBooks) > 0): ?>
		<div class="row row-cols-3 row-cols-md-3">
			<?php foreach ($eBooks as $eBook): ?>
			<div class="col mb-4">
				<div class="card">
					<?= $this->Html->image('ebook_images/'.$eBook->cover_images, ['class' => 'card-img-top']) ?>
					<div class="card-body">
						<h5 class="card-title"><?= $eBook->title ?></h5>
						<?= $this->Html->link('View', ['action' => 'view', $eBook->id], ['class' => 'btn btn-primary']) ?>
					</div>
					<div class="card-footer text-muted">
	    				<?= $eBook->created->timeAgoInWords() ?>
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
				<p class="text-center">No E-books found</p>
			</div>
		</div>
	<?php endif ?>
</div>
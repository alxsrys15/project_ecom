<div class="container mt-5">
	<div class="row">
		<div class="col-sm-6">
			<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicator">
				<ol class="carousel-indicators">
    				<?php if (count($eBook->images) > 0): ?>
						<?php foreach ($eBook->images as $k => $image): ?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?= $k ?>" class="<?= $k === 0 ? 'active' : '' ?>"></li>
						<?php endforeach ?>
					<?php else: ?>

					<?php endif ?>
				</ol>
				<div class="carousel-inner">
					<?php if (count($eBook->images) > 0): ?>
						<?php foreach ($eBook->images as $k => $image): ?>
							<div class="<?= $k === 0 ? 'carousel-item active' : 'carousel-item' ?>">
								<?= $this->Html->image('ebook_images/'.$image, ['class' => 'd-block w-100']) ?>
							</div>
						<?php endforeach ?>
					<?php else: ?>

					<?php endif ?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    				<span class="sr-only">Previous</span>
  				</a>
  				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    				<span class="carousel-control-next-icon" aria-hidden="true"></span>
    				<span class="sr-only">Next</span>
  				</a>
			</div>
		</div>
		<div class="col-sm-6">
			<h5><p class="title">Title: <?= $eBook->title ?></p></h5>
			<p>Author: <?= $eBook->author ?></p>
			<p>Year: <?= $eBook->year_published ?></p>
			<p>
				Description: <?= $eBook->description ?>
			</p>
			<?php if ($Auth->User('is_active')): ?>
				<?= $this->Html->link('<i class="fa fa-download"></i>Download', ['action' => 'download', $eBook->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
			<?php endif ?>
		</div>
	</div>
</div>
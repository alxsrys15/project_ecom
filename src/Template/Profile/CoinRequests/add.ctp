<div class="container mt-5">
	<div class="row">
		<div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
        	<h5 class="title">Add Coins</h5>
        	<p>Note: 1 Coin is equivalent to <?= $setting->value ?> Peso</p>
        	<?= $this->Form->create(null, ['action' => 'add', 'enctype' => 'multipart/form-data', 'id' => 'pr-form']) ?>
        	<div class="row">
        		<div class="col-sm-6">
        			<div class="col-sm-12">
        				<?= $this->Form->control('amount', ['type' => 'number', 'min' => 1, 'class' => 'form-control', 'required' => true]) ?>
        			</div>
        			<div class="col-sm-12">
        				<?= $this->Form->control('payment_reference', ['class' => 'form-control']) ?>
        			</div>
        			<div class="col-sm-12">
        				<label for="customFile" class="col-form-label">Payment Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="payment_image" accept="image/*" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
        			</div>
        			<div class="col-sm-12 mt-3">
        				<button type="submit" class="btn btn-primary">Add Coins</button>
        			</div>
        		</div>
        	</div>

        	<?= $this->Form->end() ?>
        </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		bsCustomFileInput.init();
	});
</script>
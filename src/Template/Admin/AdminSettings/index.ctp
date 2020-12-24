<div class="row">
	<div class="col-sm-4">
		<?= $this->Form->create(null, ['url' => ['action' => 'edit', $adminSetting->id]]) ?>
		<div class="col-sm-12">
			<label for="title" class="col-form-label"><?= $adminSetting->label ?></label>
            <?= $this->Form->control('value', ['class'=> 'form-control', 'label' => false, 'required' => true, 'type' => 'number', 'value' => $adminSetting->value]) ?>
		</div>
		<div class="col-sm-4">
			<button class="btn btn-primary">Save</button>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>
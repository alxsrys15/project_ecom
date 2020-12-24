<div class="container mt-5">
	<div class="row">
		<div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
        	<?= $this->Form->create() ?>
            <p>Note: 1 Coin is equivalent to <?= $setting->value ?> Peso</p>
            <h5 class="title">Coins balance: P <?= number_format($user->coins_balance) ?></h5>
            <?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => $user->id]) ?>
            <div class="col-sm-6">
                <?= $this->Form->control('amount', ['type' => 'number', 'max' => $user->coins_balance, 'class' => 'form-control']) ?>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
	</div>
</div>


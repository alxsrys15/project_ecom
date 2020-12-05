<style type="text/css">
    .separator {
        display: flex;
        align-items: center;
        text-align: center;
    }
    .separator::before, .separator::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #000;
    }
    .separator::before {
        margin-right: .25em;
    }
    .separator::after {
        margin-left: .25em;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" style="background-color: #007bff"><h4 class="text-white">Login</h4></div>

                <div class="card-body">
                    <?= $this->Form->create() ?>
                    <div class="form-group">
                    	<label for="email" class="col-md-4 col-form-label">E-Mail Address</label>
                    	<div class="col-md-12">
                    		<?= $this->Form->input('email', ['class' => 'form-control', 'label' => false, 'type' => 'email', 'autocomplete' => 'off' , 'required']) ?>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<label for="password" class="col-md-4 col-form-label">Password</label>
                    	<div class="col-md-12">
                    		<?= $this->Form->input('password', ['class' => 'form-control', 'label' => false, 'type' => 'password', 'autocomplete' => 'off', 'required']) ?>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-12">
                    		<?= $this->Form->button('LOGIN', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) ?>
                    	</div>
                    </div>
                    <div class="separator">OR</div>
                    <?= $this->Form->end() ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <?= $this->Html->link('Become a member', '/register', ['class' => 'btn btn-light btn-block']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$profile_url = $user->avatar_image ? 'profile_images/'.$user->avatar_image : 'default_profile.png'
?>
<div class="modal fade" id="changePassModal">
    <div class="modal-dialog">
        <?= $this->Form->create(null, ['url' => ['action' => 'changePassword', $Auth->User('id')], 'id' => 'changepass-form']) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="current-pass" class="col-form-label">Current Password</label>
                        <?= $this->Form->control('current_pass', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'required']) ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="password1" class="col-form-label">New Password</label>
                        <?= $this->Form->control('password1', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'required']) ?>
                        <div class="invalid-feedback">
                            Passwords do not match.
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="password2" class="col-form-label">Confirm New Password</label>
                        <?= $this->Form->control('password2', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'required']) ?>
                        <div class="invalid-feedback">
                            Passwords do not match.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <?= $this->element('profile_sidebar') ?>
        </div>
        <div class="col-sm-9">
            <?= $this->Form->create(null, ['enctype' => 'multipart/form-data', 'action' => '/profile']) ?>
            <div class="row">
                <div class="col-sm-6">
                    
                    <?php if ($user->is_active): ?>
                    <div class="col-sm-12">
                        <h4 class="title">COINS: <?= $user->coins_balance ?></h4>
                    </div>
                    <div class="col-sm-12">
                        <?= $this->Html->link('Add coins', ['controller' => 'CoinRequests', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="invite-code" class="col-form-label">Invite Code</label>
                        <?= $this->Form->control('invite_code', ['class'=> 'form-control', 'label' => false, 'required' => true, 'value' => $user->invite_code, 'readonly']) ?>
                    </div>
                    <?php endif ?>
                    <div class="col-sm-12">
                        <label for="first-name" class="col-form-label">First Name</label>
                        <?= $this->Form->control('first_name', ['class'=> 'form-control', 'label' => false, 'required' => true, 'value' => $user->first_name]) ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="last-name" class="col-form-label">Last Name</label>
                        <?= $this->Form->control('last_name', ['class'=> 'form-control', 'label' => false, 'required' => true, 'value' => $user->last_name]) ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="email" class="col-form-label">Email</label>
                        <?= $this->Form->control('email', ['class'=> 'form-control', 'label' => false, 'readonly' => true, 'value' => $user->email]) ?>
                    </div>
                    <div class="col-sm-12">
                        <label for="contact-no" class="col-form-label">Contact #</label>
                        <?= $this->Form->control('contact_no', ['class'=> 'form-control', 'label' => false, 'value' => $user->contact_no]) ?>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2">
                                <button class="btn btn-primary">Save</button>
                            </div>
                            <div class="col-sm-8">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#changePassModal">Change Password</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-sm-6" style="padding-top: 10px">
                    <div class="row">
                        <div class="col-sm-12">
                            <?= $this->Html->image($profile_url, ['class' => 'img-thumbnail mx-auto d-block', 'id' => 'avatar', 'style' => ['height: 200px']]) ?>
                            <button class="mx-auto d-block btn-sm btn btn-primary mt-2 open-uploader" type="button">Change</button>
                        </div>
                        <?= $this->Form->control('avatar_image', ['type' => 'file', 'class' => 'd-none', 'label' => false, 'accept' => 'image/*']) ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function readURL (input, uploader) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
    }
    $(document).ready(function () {
        $('.open-uploader').on('click', function () {
            $('#avatar-image').trigger('click');
        });

        $('#avatar-image').on('change', function () {
            readURL(this, $(this));
        });
    });
    $('#changepass-form').on('submit', function () {
        const pass1 = $('#password1').val();
        const pass2 = $('#password2').val();
        if (pass1 !== pass2) {
            $('.invalid-feedback').show();
            $('#password1, #password2').addClass('is-invalid');
            return false;
        }
    });
    $('#changePassModal').on('hidden.bs.modal', function () {
        $('#changepass-form').trigger('reset');
        $('#password1, #password2').removeClass('is-invalid');
        $('.invalid-feedback').hide();
    });
</script>